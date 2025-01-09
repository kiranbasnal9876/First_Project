
$('a[id="itemmaster"]').addClass('active');
$("#update").hide();
let image = $("#pic");
      if (image.attr("src")==""&& $("#submit").text() =="Add") {
        $("#show-img").hide();
      } 
      else{
        $("#show-img").show();
      }

url="http://localhost/First_Project/item_master/";
function loaddata(order,colname) {
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
  loaddata("", "");
});

// searching data from database

$("#filter_form").on("input", function () {
  loaddata("","");
});

$("#reset").on("click", function () {
  // $(".filter-div").trigger("reset");
  
   $("[type!='hidden']").val("");
   loaddata("","");
});

$(document).on("click", ".asc", function () {

  var colname = $(this).attr("id");
  var page_no = $("#page_no").val();
  var row = $("#row").val();
  loaddata("ASC", colname);
});

$(document).on("click", ".desc", function () {
  var colname = $(this).attr("id");
  var page_no = $("#page_no").val();
  var row = $("#row").val();
  loaddata("DESC", colname);
});

    // insert data...............
    $("#submit").on("click", function () {
      validateClient()
      var formdata = new FormData(form);
      formdata.append("action","add");
        
      if (formvalidate) {
        $.ajax({
         
          url: url +"itemmaster_backend.php",
          data: formdata,
          type: "POST",
          dataType: "json",
          contentType: false,
          processData: false,
          success: function (data) {
            if (data.status == 400) {
              alert("data is successfully inserted");
              $("#formdata").trigger("reset");
              loaddata("", "");
              var editBtn = document.querySelector("#home-tab");
              var tab = new bootstrap.Tab(editBtn);
              tab.show();
            }
            else{
              alert(data.error);
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
  validateClient();
  var formdata = new FormData(form);
  formdata.append("action","add");
  if (formvalidate) {
    $.ajax({
      url: url +"itemmaster_backend.php",
      data: formdata,
      type: "POST",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 400) {
          alert("data is successfully updated");
          $("#formdata").trigger("reset");
          loaddata("","");
          var editBtn = document.querySelector("#home-tab");
          var tab = new bootstrap.Tab(editBtn);
          tab.show();
          $("#show-img").hide();
          $("#submit").show();
          $("#update").hide();
        }
        else{
          alert(data.error);
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
  $("#update").hide();
        $("#submit").show();
})