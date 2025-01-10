$('a[id="invoice"]').addClass("active");
$("#update").hide();
$("#add-more").on("click", function () {

   $(this).parent().siblings('.add-new').find('.clone:first').clone().appendTo('.add-new').find("input[type='text'],input[type='number'],input[type='hidden']").val("");

});

$(document).on("click", ".delete-item", function () {

  if($(".clone").length>1){
    if ($(this).prev() != "") {
      var div = $(this).parent("div");
      div.remove();
    }
  }
});

var d = new Date();


$("#invoice_date").val(`${d.getFullYear()}/${d.getMonth() + 1}/${d.getDate()}`);

var url = "http://localhost/First_Project/invoice/";

$(document).on("keyup", ".clients", function () {
  const value = $(this).val();

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
            clientId:item.id,
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

function total_amount() {
  let Total_amount = 0;
  $(".Amount").each(function () {
    let amount = parseFloat($(this).val()) || 0;
    Total_amount += amount;
  });
  $("#total-amount").val(Total_amount.toFixed(2));
}

$(document).on("keyup", ".inputitem", function () {
  var value = $(this).val();

  // $this=$(this)

  $(".inputitem").autocomplete({
    minLength: 1,
    source: function (request, response) {
      $.ajax({
        url: url + "invoice_backend.php",
        data: {
          value: value,
          action: "getitemmane",
        },
        type: "post",
        success: function (data) {
          var parsedData = JSON.parse(data);
          var suggestions = parsedData.output.map((item) => ({
            label: item.name,
            value: item.itemName,
            itemPrice: item.itemPrice,
            id:item.id,
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

    },
  });

  $(".Item").on("input", function () {
    total_amount();
    var item = $(this).val();

    var price = $(this).parents(".clone").find(".price").val();

    $(this)
      .parents(".clone")
      .find(".Amount")
      .val(item * price);
  });
});

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
      console.log(data);
      $(".invoic").val("100" +(Number(data.invoice_id)+1));
    },
  });
});

// insert data ........................
$("#invoice_submit").on("click", function () {
  var formdata = new FormData(form);

  formdata.append("action", "add");
  $.ajax({
    url: url + "invoice_backend.php",
    data: formdata,
    type: "POST",
    dataType: "json",
    contentType: false,
    processData: false,
    success: function (data) {
      if (data.status == 400) {
        alert("data is successfully inserted");
        $("#formdata").trigger("reset");
        // loaddata("", "");
        var editBtn = document.querySelector("#home-tab");
        var tab = new bootstrap.Tab(editBtn);
        tab.show();
      } else {
        alert(data.error);
      }
    },
  });
});

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
  loaddata("", "");
});

// selecting row.........................................
$("#row").on("change", function () {
  var row = $(this).val();
  $("#row_no").val(row);

  loaddata("", "");
});

// filter data.................
$("#filter_form").on("input", function () {
  loaddata("","");
});

// reset filter data
$("#reset").on("click", function () {
  // $(".filter-div").trigger("reset");
  
   $("[type!='hidden']").val("");
   loaddata("","");
});


//deleting data from database
$(document).on("click", ".delete-btn", function () {
  if (confirm("are u sure")) {
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
      success: function(data) {
        if (data.status == 400){
          loaddata("","");
        } 
        else if(data.error !=""){
          alert(data.error);
        }
        
      },
    });
  }
});



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
    success: function (data){
      
      var inputs = $("#formdata").find("input");
      
      
      for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        const inputName = input.name;
        if (data.output1[inputName]) {
          input.value = data.output1[inputName];
        }
      }
      // console.log(data.output2[0].itemName);
      for(let i=0;i<data.output2.length;i++){
        if(i > 0){
          $("#add-more").trigger("click"); 
        }
        console.log("data.output2[i]",data.output2[i])
        var currentClone = $('.clone').eq(i)
        currentClone.find('.inputitem').val(data.output2[i].itemName)
        currentClone.find('.item_id').val(data.output2[i].item_id)
        currentClone.find('.Item').val(data.output2[i].quentity)
        currentClone.find('.price').val(data.output2[i].itemPrice)
        currentClone.find('.Amount').val(data.output2[i].amount)

      }  
      var editBtn = document.querySelector("#profile-tab");
      var tab = new bootstrap.Tab(editBtn);
      tab.show();
      $("#invoice_submit").hide();
      $("#update").show();
    },
  });
});