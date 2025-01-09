$('a[id="invoice"]').addClass("active");

$("#add-more").on("click", function () {

   $(this).parent().siblings('.add-new').find('.clone:first').clone().appendTo('.add-new').find("input[type='text'],select").val("");

});

$(document).on("click", "#delete-item", function () {
  if ($(this).prev() != "") {
    var div = $(this).parent("div");
    div.remove();
  }
});

var d = new Date();

$("#invoice_date").val(`${d.getDate()}/${d.getMonth() + 1}/${d.getFullYear()}`);

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
          action: "getdata",
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
    },
  });
});

function total_amount() {
  let Total_amount = 0;
  $(".Amount").each(function () {
    let amount = parseFloat($(this).val()) || 0;
    Total_amount += amount;
  });
  $("#total-amount").val(Total_amount);
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
      $(".invoic").val(100 + data.invoice_id + 1);
    },
  });
});

// insert data ........................
$("#invoice_submit").on("click", function () {
  var total_amount = $("#total-amount").val();
  var formdata = new FormData(form);
  var itemformdata = new FormData(client_invoice);
 
  formdata.append("action", "add");
  formdata.append("total", total_amount);
  // formdata.append("itemdata", itemformdata);
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

  // var row = $("#row").val();

  loaddata("", "");
});

// selecting row.........................................
$("#row").on("change", function () {
  var row = $(this).val();
  $("#row_no").val(row);

  loaddata("", "");
});
