$('a[id="invoice"]').addClass("active");
$("#update").hide();

var url = "http://localhost/First_Project/invoice/";

// add new clone
$("#add-more").on("click", function () {
  $(this)
    .parent()
    .siblings(".add-new")
    .find(".clone:first")
    .clone()
    .appendTo(".add-new")
    .find("input[type='text'],input[type='number'],input[type='hidden']")
    .val("");
});

//deleting clone div
$(document).on("click", ".delete-item", function () {
  if ($(".clone").length > 1) {
    if ($(this).prev() != "") {
      var div = $(this).parent("div");
      div.remove();
      total_amount();
    }
  }
});

// geting current date...........................
function invoice_date() {
  let d = new Date();
  $("#invoice_date2").val(
    `${d.getDate() > 9 ? d.getDate() : "0" + d.getDate()}/${
      d.getMonth() + 1 > 9 ? d.getMonth() + 1 : "0" + (d.getMonth() + 1)
    }/${d.getFullYear()}`
  );
}

invoice_date();

// geting client detail.............
$(document).on("keyup", ".clients", function () {
  const value = $(this).val();
  if(value==""){
    $("#inputphone").val("");
    $("#inputemail").val("");
    $("#inputAddress").val("");
    $(".clientId").val("");
  }

  $(".clients").autocomplete({
    minLength: 1,
    source: function (request, response) {
      $.ajax({
        url: url + "invoice_backend.php",
        data: {
          name: request.term,
          action: "getclientdata",
        },
        type: "post",
        
        success: function (data) {
          var parsedData = JSON.parse(data);
          var suggestions = parsedData.output.map((item) => ({
            label: item.name,
            value: item.name,
            phone: item.phone,
            email: item.email,
            address: item.address,
            clientId: item.id,
          }));

          response(suggestions);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", error);
          response([]);
        },
      });
    },
    select: function (event, ui) {
      $("#inputphone").val(ui.item.phone);
      $("#inputemail").val(ui.item.email);
      $("#inputAddress").val(ui.item.address);
      $(".clientId").val(ui.item.clientId);
    },
  });
});

// geting items......................
$(document).on("keyup", ".inputitem", function () {
  var value = $(this).val().trim();
  if(value==""){
    $(this).parents(".clone").find(".price").val("");
      $(this).parents(".clone").find(".item_id").val("");
      $(this).parents(".clone").find(".Item").val("");
      $(this)
      .parents(".clone")
      .find(".Amount")
      .val("");
      total_amount();
     
  }

  let items = [];
  $(".item_id").each(function () {
    if (!$(this).val() == "") {
    items.push($(this).val());
    }
  });
  let set_of_items = new Set(items);
  let items_array = [...set_of_items];

  $(".inputitem").autocomplete({
    minLength: 1,

    source: function (request, response) {
      $.ajax({
        url: url + "invoice_backend.php",
        data: {
          value: value,
          action: "getitemmane",
          items_id: items_array,
        },
        type: "post",
        success: function (data) {
          var parsedData = JSON.parse(data);
          var suggestions = parsedData.output.map((item) => ({
            label: item.name,
            value: item.itemName,
            itemPrice: item.itemPrice,
            id: item.id,
          }));

          response(suggestions);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", error);
          response([]);
        },
      });
    },
    select: function (event, ui) {
      $(this).parents(".clone").find(".price").val(ui.item.itemPrice);
      $(this).parents(".clone").find(".item_id").val(ui.item.id);
      
        $(this).parents(".clone").find(".Item").val(1);
        var quantity = 1;
      // amount();
      var price = $(this).parents(".clone").find(".price").val();
      $(this).parents(".clone") .find(".Amount").val(quantity * price);
      // console.log($("..Amount").val());
       total_amount();
     
    },

 
  }
 );
  
   
});





// calculate total amount..................
function total_amount() {
  let Total_amount = 0;
  $(".Amount").each(function () {
    let amount = parseFloat($(this).val()) || 0;
    Total_amount += amount;
  });
  $("#total-amount").val(Total_amount.toFixed(2));
}

// total_amount();
// calculate amount...................
function amount() {
  $(".Item ").on("input", function () {
    var item = $(this).val();

    var price = $(this).parents(".clone").find(".price").val();

    $(this)
      .parents(".clone")
      .find(".Amount")
      .val(item * price);
      total_amount();
  });
}

amount();






// invoice number
$("#profile-tab").on("click", function () {
  $.ajax({
    url: url + "invoice_backend.php",
    type: "post",
    data: {
      action: "get_invoiceNo",
    },
    success: function (data) {
      data = JSON.parse(data);
    
      $(".invoic").val("100" + (Number(data.id) + 1));
      invoice_date();
    },
  });
});

// insert data ........................
$("#invoice_submit").on("click", function () {
  // debugger;
  var formdata = new FormData(form);

  formdata.append("action", "add");
  validate();
  if(checkvalidate){
  $.ajax({
    url: url + "invoice_backend.php",
    data: formdata,
    type: "POST",
    dataType: "json",
    contentType: false,
    processData: false,
    success: function (data) {
      if (data.status == 200) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "data is inserted successfully",
          showConfirmButton: false,
          timer: 1500
        });
        $("#formdata").trigger("reset");
        $("#formdata input[type='hidden']").val("");
        loaddata("", "");
        var editBtn = document.querySelector("#home-tab");
        var tab = new bootstrap.Tab(editBtn);
        tab.show();
      } else {
        Swal.fire({
          icon: "error",
          title: "somthing wrong",
          text: data.error,
          
        });
        
      }
    },
  });
}
});

// geting data from server.............................................

function loaddata(order, colname) {
  var form = new FormData(getformdata);

  form.append("order", order);
  form.append("colname", colname);
  $.ajax({
    url: url + "paggination.php",
    data: form,

    processData: false,
    contentType: false,
    type: "post",
    datatype: "json",

    success: function (data) {
      data = JSON.parse(data);

      $("tbody").html(data.table);
      $(".page").html(data.page);
    },
  });
}

loaddata("", "");

// pagination code.................

$(document).on("click", ".page li", function () {
  page_id = $(this).attr("id");
  $("#page_no").val(page_id);

  // var row = $("#row").val();

  loaddata("", "");
});

// selecting row.........................................
$("#row").on("change", function () {
  var row = $(this).val();
  $("#row_no").val(row);
  $("#page_no").val(1);
  loaddata("", "");
});

// searching data from database

$("#filter_form").on("input", function (){
  let cr_page= $("#page_no").val(); 
  $("#page_no").val(1);
 loaddata("","");
$("#page_no").val(cr_page);
});

$("#reset").on("click", function (){

setTimeout(function(){
  loaddata("","");
},100);
   
});
// data shorting...................................................


// sorting on click
let sort = "ASC";
$(document).on("click", ".changeIcon", function () {

  if(sort == "ASC"){
    sort = "DESC";
  }
  else{
    sort = "ASC";
  }

  

  var colname = $(this).attr("id");
  var page_no = $("#page_no").val();
  var row = $("#row").val();
  loaddata(sort, colname);

});

// icon changind of sort

$(document).on("click" , '.changeIcon' , function(){


  let icon = $(this).find("i");

    if ($(".changeIcon").find("i").hasClass('bi-arrow-up')) {

      $(".changeIcon").find("i").removeClass('bi-arrow-up');
      icon.addClass('bi-arrow-up')

    }
    else if ($(".changeIcon").find("i").hasClass('bi-arrow-down')) {

      $(".changeIcon").find("i").removeClass('bi-arrow-down');
      icon.addClass('bi-arrow-down')

    }

    if (icon.hasClass('')) {
      icon.addClass('bi-arrow-up');
    }
    else if (icon.hasClass('bi-arrow-up')) {
      icon.removeClass('bi-arrow-up').addClass('bi-arrow-down');
    }
    else {
      icon.removeClass('bi-arrow-down').addClass('bi-arrow-up');
    }
  

})




//deleting data from database
$(document).on("click", ".delete-btn", function () {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
    var id = $(this).data("id");
    // var page_no = $("#page_no").val();
    $.ajax({
      url: url + "invoice_backend.php",
      data: {
        invoice_no: id,
        action: "delete",
      },
      type: "post",
      dataType: "json",
      success: function (data) {
        if (data.status == 200) {
          Swal.fire({
            title: "Deleted!",
            text: "Your data has been deleted.",
            icon: "success",
           
          });
          loaddata("", "");
        } else if (data.error != "") {
          
          Swal.fire({
            title: "Not Deleted!",
            text: "not deleted",
            icon: "warning"
          });
        }
      },
    });
  }
});

});

// geting data for edit
$(document).on("click", ".edit-btn", function () {
  var id = $(this).data("id");
  $.ajax({
    url: url + "invoice_backend.php",
    type: "post",
    data: {
      id: id,
      action: "getdata",
    },
    dataType: "json",
    success: function (data) {
      var inputs = $("#formdata").find("input");

      for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        const inputName = input.name;
        if (data.output1[inputName]) {
          input.value = data.output1[inputName];
        }
        invoice_date();
      }
      // console.log(data.output2[0].itemName);
      for (let i = 0; i < data.output2.length; i++) {
        if (i > 0) {
          $("#add-more").trigger("click");
        }
        console.log("data.output2[i]", data.output2[i]);
        var currentClone = $(".clone").eq(i);
        currentClone.find(".inputitem").val(data.output2[i].itemName);
        currentClone.find(".item_id").val(data.output2[i].item_id);
        currentClone.find(".Item").val(data.output2[i].quantity);
        currentClone.find(".price").val(data.output2[i].itemPrice);
        currentClone.find(".Amount").val(data.output2[i].amount);
        currentClone.find(".invoice_id").val(data.output2[i].invoice_id);

      }
      
      var editBtn = document.querySelector("#profile-tab");
      var tab = new bootstrap.Tab(editBtn);
      tab.show();
      $("#invoice_submit").hide();

      $("#update").show();
    },
  });
});
amount();
// update data

$("#update").on("click", function () {
  var formdata = new FormData(form);
  formdata.append("action", "update");

  $.ajax({
    url: url + "invoice_backend.php",
    data: formdata,
    type: "POST",
    dataType: "json",
    contentType: false,
    processData: false,
    success: function (data) {
      if (data.status == 200) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "data is updated successfully",
          showConfirmButton: false,
          timer: 1500
        });
        loaddata("", "");
        $("#formdata").trigger("reset");
        $(".delete-item").trigger("click");
        $("#update").hide();
        $("#invoice_submit").show();
        
        var editBtn = document.querySelector("#home-tab");
        var tab = new bootstrap.Tab(editBtn);
        tab.show();
      } else {
        Swal.fire({
          title: "Not inserted",
          text: data.error,
          icon: "warning"
        });
      }
    },
  });
});


$("#home-tab").on("click", function () {
  $("#formdata").trigger("reset");
  $(".delete-item").trigger("click");
  $("#update").hide();
  $("#invoice_submit").show();
  $(" #formdata input,select").next("span").text("");
});

// open email model...........
$(document).on("click",".email",function(){

 $("#invoice_no_for_pdf").val($(this).attr('id')); 
})

// for sending mail.................
$("#send_email").on("click",function(){

  let emaildata = new FormData(email_form);

  $.ajax({
    url: url + "send_email.php",
    data:emaildata,
    type:"post",
    processData: false,
    contentType: false,
    dataType: "json",
//     beforeSend:function(){
// $("#send_email").html(`<button class="btn btn-primary" type="button" disabled>
//   <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
//   Loading...
// </button>`);
//     },
    success: function(data){
      if (data.success!=''){
        $("#close").trigger("click");
        Swal.fire({
          title: "sent email!",
          text: data.success,
          icon: "success",
         
        });
   
      $("#email-model-form").trigger("reset");
      
      } else if(data.error !="") {
        Swal.fire({
          title: "Not sent",
          text: "something wrong",
          icon: "warning"
        });
      
      }
    },

  })
})



