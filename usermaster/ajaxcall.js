
$('a[id="usermaster"]').addClass('active');
$("#update-btn").hide();


// login//---------------



//  getting data from database ...............................

function loaddata(page, search,order,colname,row) {
  $.ajax({
    url: "http://localhost/First_Project/usermaster/paggination.php",
    data: {
      page_no: page,
      search: search,
      colname:colname,
      order:order,
      row:row
    },
    type: "post",
    datatype: "json",
  
    success: function (data) {
      
      data=JSON.parse(data);
      $("#tbody").html(data.table);
      $(".page").html(data.page);
    },
  });
}

loaddata();

//paggination code

$(document).ready(function () {
  $(document).on("click", ".page li", function () {
    page_id = $(this).attr("id");
    $("#page_no").val(page_id);
        
 var row= $("#row").val();
  
    loaddata(page_id,'','','',row);
  });

});

// selecting rows....................................................
$(document).ready(function(){
  $(document).on("click","#row",function(){
    var row =$(this).val();
   
   
    loaddata(1,'','','',row);
  })
});



// live search.......................

  $(document).on("keyup", ".search", function () {
    var search = $(this).val();
    var page_no=$("#page_no").val();
    loaddata(page_no, search);
  });




//data shorting.......................................................

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
  loaddata(page_no, '', sort, colname, row);
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
// reset data from live search.....................

$("#reset").on("click", function () {
  $("input").val("");
 
  loaddata();
});



// insert data in databse........................

$("#insert-btn").on("click", function () {
 
  validate();
  var password = document.getElementById("inputPassword").value;
  var Name = document.getElementById("Name").value;
  var email = document.getElementById("inputemail").value;
  var phone = document.getElementById("Phone").value;

  if (
    $("#log_er1").text()=="" &&
    $("#log_er2").text()=="" &&
    $("#log_er").text()=="" &&
    $("#log_er3").text()==""
  ) 
  {
    
    $.ajax({
      url: "http://localhost/First_Project/usermaster/user_backend.php",

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
      url: "http://localhost/First_Project/usermaster/user_backend.php",
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
    url: "user_backend.php",
    type: "post",
    dataType: "json",
    data: {
      id: id,
      action:'getdata'
    },
    success: function (data) {
      $("#Name").val(data.create_by);
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
    url: "http://localhost/First_Project/usermaster/user_backend.php",
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
