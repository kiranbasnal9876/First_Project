var url = "http://localhost/First_Project/clientmaster/";
$("#update").hide();
// selecting district.........................................
$("#inputState").on("change", function (e) {
  var id = $(this).val();

  $.ajax({
    url: url + "clientmaster_backend.php",
    type: "post",
    data: {
      id: id,
      action: "getdestrict",
    },
    dataType: "html",
    success: function (data) {
      $("#option").after(data);
    },
  });
});

// geting data from server.............................................

function loaddata(page_id, order, colname, row) {
  $.ajax({
    url: url + "paggination.php",
    data: {
      page: page_id,
      limit: row,
      order: order,
      colname: colname,
    },
    type: "post",
    datatype: "json",

    success: function (data) {
      data = JSON.parse(data);

      $("tbody").html(data.table);
      $(".page").html(data.page);
    },
  });
}

loaddata();

// pagination code.................

$(document).on("click", ".page li", function () {
  page_id = $(this).attr("id");
  $("#page_no").val(page_id);

  var row = $("#row").val();

  loaddata(page_id, "", "", row);
});

// selecting row.........................................
$("#row").on("change", function () {
  var row = $(this).val();
  var page_id = $("#page_no").val();
  loaddata(page_id, "", "", row);
});

// data shorting...................................................

$(document).on("click", ".asc", function () {
  var colname = $(this).attr("id");
  var page_no = $("#page_no").val();
  var row = $("#row").val();
  loaddata(page_no, "ASC", colname, row);
});

$(document).on("click", ".desc", function () {
  var colname = $(this).attr("id");
  var page_no = $("#page_no").val();
  var row = $("#row").val();
  loaddata(page_no, "DESC", colname, row);
});

//insert data in database.......................................
$("#submit").on("click", function () {
  validateClient();
  var formdata = new FormData(form);;

  if (formvalidate) {
    $.ajax({
      url: url + "clientmaster_backend.php",
      data:formdata,
        
      type: "POST",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 400) {
          alert("data is successfully inserted");
          $("#formdata").trigger("reset");
          loaddata();
          var editBtn = document.querySelector("#home-tab");
          var tab = new bootstrap.Tab(editBtn);
          tab.show();
        }
      },
    });
  }
});

// getting-data for edit..................

$(document).on("click", ".edit-btn", function () {
  var id = $(this).data("id");
  $.ajax({
    url: url + "clientmaster_backend.php",
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
      debugger
      $('#inputState').trigger("change");
      setTimeout(() => {
        $('#inputCity').val(data.district_id)
      }, 100);
      var editBtn = document.querySelector("#profile-tab");
      var tab = new bootstrap.Tab(editBtn);
      tab.show();
      $("#submit").hide();
      $("#update").show();
    },
  });
});

// deleting data.................................

$(document).on("click", ".delete-btn", function () {
  if (confirm("are u sure")) {
    var id = $(this).data("id");
    var page_no = $("#page_no").val();
    $.ajax({
      url: url + "clientmaster_backend.php",
      data: {
        id: id,
        action: "delete",
      },
      type: "post",
      dataType: "json",
      success: function (data) {
        if (data.status == 400) {
          loaddata(page_no);
        } else {
          alert(data.error);
        }
      },
    });
  }
});


$("#update").on("click",function(){

  validateClient();
  var formdata = new FormData(form);;

  if (formvalidate) {
    $.ajax({
      url: url +"update.php",
      data:formdata, 
      type: "POST",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status == 400) {
          alert("data is successfully updated");
          $("#formdata").trigger("reset");
          loaddata();
          var editBtn = document.querySelector("#home-tab");
          var tab = new bootstrap.Tab(editBtn);
          tab.show();
        }
      },
    });
  }

})