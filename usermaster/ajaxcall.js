
$('a[id="usermaster"]').addClass('active');
$("#update-btn").hide();
var url = "http://localhost/First_Project/usermaster/";

// login//---------------



//  getting data from database ...............................
// $("#tbody").html(data.table);
// $(".page").html(data.page);

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
    datatype: "html",

    success: function (data) {
      data = JSON.parse(data);

      $("#tbody").html(data.table);
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
  // var page_no = $("#page_no").val();
  // var row = $("#row").val();
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



// insert data in databse........................

$("#insert-btn").on("click", function () {
 
  validate();
  var password = document.getElementById("inputPassword").value;
  var Name = document.getElementById("Name").value;
  var email = document.getElementById("inputemail").value;
  var phone = document.getElementById("Phone").value;

  if (checkvalidate) 
  {
    
    $.ajax({
      url: url+"/user_backend.php",

      data: {
        password: password,
        Name: Name,
        email: email,
        phone: phone,
        action:'add'
      },
      type: "post",
      dataType: "json",
      success: function (data) {
        
        if (data.status == 400) {
          alert("successfully inserted");
          $("input").val("");
          loaddata();
          var editBtn = document.querySelector("#home-tab");
          var tab = new bootstrap.Tab(editBtn);
          tab.show();
        } else {
          alert(data.error);
        }
      }

   
    });
  }

});

// delete data from database........................................

$(document).on("click", ".delete-btn", function () {
  if (confirm("are u sure")) {
    var id = $(this).data("id");
    var page_no=$("#page_no").val();
    $.ajax({
      url: url+"user_backend.php",
      data: {
        id: id,
        action:'delete',

      },
      type: "post",
      dataType: "json",
      success: function (data) {
        if (data.status == 200) {
          loaddata(page_no);
        } 
        else {
          alert(data.error);
        }

        
      },
    });
    
  }
});

// edit data.............................

$(document).on("click", ".edit-btn", function () {
  let id = $(this).data("id");

  $.ajax({
    url: url+"user_backend.php",
    type: "post",
    dataType: "json",
    data: {
      id: id,
      action:'getdata'
    },
    success: function (data) {
      $("#Name").val(data.name);
      $("#Phone").val(data.phone);
      $("#inputemail").val(data.email);
      
      $("#pass").val(data.PASSWORD);
     
      $("#id").val(data.id);
      $("#update-btn").show();
      $("#insert-btn").hide();
      var editBtn = document.querySelector("#profile-tab");
      var tab = new bootstrap.Tab(editBtn);
      tab.show();
    },
  });
});

// update data..............................

$("#update-btn").on("click", function () {
  var password = document.getElementById("inputPassword").value;

  if(password==''){
  password=$("#pass").val();
   
  }
  updatevalidation();
  var Name = document.getElementById("Name").value;
  var email = document.getElementById("inputemail").value;
  var phone = document.getElementById("Phone").value;
  var id = document.getElementById("id").value;
  
  $.ajax({
    url: url+"user_backend.php",
    type: "post",
    dataType: "json",
    data: {
      password: password,
      Name: Name,
      email: email,
      phone: phone,
      id: id,
       action:'add'
    },

    success: function (data) {
      if (data.status == 400) {
        alert("data is updated");
        $("#update-btn").hide();
        $("#insert-btn").show();
        $("input").val("");
        loaddata();
        var editBtn = document.querySelector("#home-tab");
        var tab = new bootstrap.Tab(editBtn);
        tab.show();

      }
    },
  });
});


$("#home-tab").on("click",function(){
  $("input").val("");
  $("#update-btn").hide();
        $("#insert-btn").show();
})
