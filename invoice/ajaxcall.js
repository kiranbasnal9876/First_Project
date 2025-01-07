$("#add-more").on("click", function () {
  $(".append").append(` <div class="next row">
                           <div class="col-2 ">
                                <label for="input" class="form-label">Item Name:</label>
                                <input type="text" class="form-control inputitem" name="itemname" id="input" maxlength="20">
                                
                                <div id="items"></div>
                            </div>
                            <div class="col-md-2 price">
                                <label for="inputprice" class="form-label ">Item Price:</label>
                                <input type="text" class="form-control price" name="itemPrice" id="inputprice" maxlength="10">
                                
                            </div>
                            <div class="col-2">
                                <label for="item" class="form-label">Quantity:</label>
                                <input type="number" class="form-control" name="itemName" id="item" maxlength="20">
                               
                            </div>
                            <div class="col-md-2 price">
                                <label for="amount" class="form-label  ">Amount:</label>
                                <input type="text" class="form-control " name="itemPrice" id="amount" maxlength="20">
                                
                                </div>
                              
                               

                                    <button id="delete-item" class="m-4"><img src="../images/trash (1).svg"></button>
                                </div>`);
});

$(document).on("click", "#delete-item", function () {
  var div = $(this).parent("div");
  div.remove();
});

var date = new Date();

$("#invoice_date").val(date);

var url = "http://localhost/First_Project/invoice/";

// $(document).on("keyup", "#client_name", function () {
//   var name = $(this).val();
//   if (name != "") {
//     $.ajax({
//       url: url + "invoice_backend.php",
//       data: {
//         name: name,
//         action: "getclientdata",
//       },
//       type: "post",
//       success: function (data) {
//         var output = JSON.parse(data);
//         $("#clients").html(output.output);
//       },
//     });
//   }
// });

// $(document).on("click", "#clients li", function () {
//   var value = $(this).text();
//   $("#client_name").val(value);
//   $("#clients").hide();

//   if ($("#client_name").val() != "") var name = $("#client_name").val();
//   if (name != "") {
//     $.ajax({
//       url: url + "invoice_backend.php",
//       data: {
//         name: name,
//         action: "getdata",
//       },
//       type: "post",
//       success: function (data) {
//         data = JSON.parse(data);
//         //   console.log(data.phone);
//         $("#inputphone").val(data.phone);
//         $("#inputemail").val(data.email);
//         $("#inputAddress").val(data.address);
//       },
//     });
//   }
// });

// //set item data

// $(".inputitem").on("keyup", function () {
//   var name = $(this).val();
//   if (name != "") {
//     $.ajax({
//       url: url + "invoice_backend.php",
//       data: {
//         name: name,
//         action: "getitemdata",
//       },
//       type: "post",
//       success: function (data) {
//         var output = JSON.parse(data);
//         $("#items").html(output.output);
//       },
//     });
//   }
// });

// $(document).on("click", "#items li", function () {
//   var value = $(this).text();
//   $("#inputitem").val(value);
//   $("#items").hide();

//   if ($("#inputitem").val() != "") var name = $("#inputitem").val();
//   if (name != "") {
//     $.ajax({
//       url: url + "invoice_backend.php",
//       data: {
//         name: name,
//         action: "itemdata",
//       },
//       type: "post",
//       success: function (data) {
//         data = JSON.parse(data);
//         console.log(data);
//         $("#inputprice").val(data.itemPrice);
//       },
//     });

//     $("#item").on("click", function () {
//       var item = $(this).val();
//       var price = $("#inputprice").val();
//       $("#amount").val(item * price);
//     });
//   }
// });

$( ".inputitem" ).autocomplete({
    source:"invoice_backend.php",
  });