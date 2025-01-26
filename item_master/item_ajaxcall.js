
url="http://localhost/First_Project/item_master/";
$('a[id="itemmaster"]').addClass('active');
$("#update").hide();

let image = $("#pic");
      if (image.attr("src")==""&& $("#submit").text() =="Add") {
        $("#show-img").hide();
      } 
      else{
        $("#show-img").show();
      }

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
  $("#page_no").val(1);
  loaddata("","");
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

  console.log(sort);

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



    // insert data...............
    $("#submit").on("click", function () {
      
      validate();
    
      var formdata = new FormData(form);
      formdata.append("action","add");
        
      if (checkvalidate) {
        $.ajax({
         
          url: url +"itemmaster_backend.php",
          data: formdata,
          type: "POST",
          dataType: "json",
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status == 200) {
            //   <div class="alert alert-success" role="alert">
            //   data inserted  successfully
            //  </div>
              $("#formdata").trigger("reset");
              $("#inputd").val("");
              loaddata("", "");
              var editBtn = document.querySelector("#home-tab");
              var tab = new bootstrap.Tab(editBtn);
              tab.show();
            }
            else{
              // <div class="alert alert-danger" role="alert">
              // data not inserted successfully
              //  </div>
            }
          },
        });
      }
    });


// delete btn..........
    
$(document).on("click", ".delete-btn", function () {
  if (confirm("are u sure")) {
    var id = $(this).data("id");
    // var page_no = $("#page_no").val();
    $.ajax({
      url: url +"itemmaster_backend.php",
      data: {
        id: id,
        action: "delete",
      },
      type: "post",
      dataType: "json",
      success: function(data) {
        if (data.status == 200){
          loaddata("","");
        } else {
          alert(data.error);
        }
        
      },
    });
  }
});



//getdata------

$(document).on("click", ".edit-btn", function () {
  var id = $(this).data("id");
  $.ajax({
    url: url +"itemmaster_backend.php",
    type: "post",
    data: {
      id: id,
      action: "getdata",
    },
    dataType: "json",
    success: function (data) {
      var inputs = $("#formdata").find("input,select");
      for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        const inputName = input.name;
        if (data[inputName]) {
          input.value = data[inputName];
        }
      }
      $("#pic").attr(
        "src",
          data.itemPath
      );
      $("#inputd").text(data.itemD);
        $("#show-img").show();
       
      var editBtn = document.querySelector("#profile-tab");
      var tab = new bootstrap.Tab(editBtn);
      tab.show();
      $("#submit").hide();
      $("#update").show();
    },
  });
});
//update data---------
$("#update").on("click", function () {
  validate();
  var formdata = new FormData(form);
  formdata.append("action","add");
  if (checkvalidate) {
    $.ajax({
      url: url +"itemmaster_backend.php",
      data: formdata,
      type: "POST",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          // <div class="alert alert-success" role="alert">
          //  values updated successfully
          // </div>
          $("#formdata").trigger("reset");
          $("#inputd").val("");
          loaddata("","");
          var editBtn = document.querySelector("#home-tab");
          var tab = new bootstrap.Tab(editBtn);
          tab.show();
          $("#show-img").hide();
          $("#submit").show();
          $("#update").hide();
        }
        else{
     
        }
      },
    });
  }
});



function imgDicShow(){
  $("#show-img").show();
}





$("#home-tab").on("click",function(){
  $("#formdata").trigger("reset");
  $("textarea").val("");
  $("#show-img").hide();
  $("#update").hide();
        $("#submit").show();
})