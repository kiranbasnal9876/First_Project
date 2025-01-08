$("#add-more").on("click", function () {
  $(".append").append(` <div class="next row">
                          <div class="col-2 ">
                                    <label for="input" class="form-label">Item Name:</label>
                                    <input type="text" class="form-control inputitem" name="itemname" id="input" maxlength="20">


                                </div>
                                <div class="col-md-2 price">
                                    <label for="inputprice" class="form-label ">Item Price:</label>
                                    <input type="text" class="form-control price" name="itemPrice" id="inputprice" maxlength="10">

                                </div>
                                <div class="col-2">
                                    <label for="item" class="form-label">Quantity:</label>
                                    <input type="number" class="form-control Item" name="itemName" id="item" maxlength="20">

                                </div>
                                <div class="col-md-2 price">
                                    <label for="amount" class="form-label  ">Amount:</label>
                                    <input type="text" class="form-control Amount" name="itemPrice" id="amount" maxlength="20">

                                </div>

                                <button class="m-4" id=""><img src="../images/trash-2.svg"></button>


                                </div>`);

  //  if($(this).prev().attr("id")==append){
  //   prev().clone().appendTo("#append");
  //  }
  //  else{
  // var clone=$(".append").clone();
  // clone.find('.append').removeClass('append');
  // clone.appendTo(".append");
  //  }
});

$(document).on("click", "#delete-item", function () {
  var div = $(this).parent("div");
  div.remove();
});

var date = new Date();

$("#invoice_date").val(date);

var url = "http://localhost/First_Project/invoice/";

$(document).on("input", ".clients", function () {
  var value = $(this).val();

  $.ajax({
    url: url + "invoice_backend.php",
    data: {
      name: value,
      action: "getdata",
    },
    type: "post",
    success: function (data) {
      var data = JSON.parse(data);
      //   console.log(data.phone);
      var name = [];
      data.output.map((e) => {
        name.push(e.name);
      })

      $(".clients").autocomplete({
        source: name,
        select: function () {
          $("#inputphone").val(data.output[0].phone);
          $("#inputemail").val(data.output[0].email);
          $("#inputAddress").val(data.output[0].address);
        },
      });
    },
  });
});

$(document).on("keyup",".inputitem", function () {
  var value = $(this).val();
  $.ajax({
    url: url +"invoice_backend.php",
    data: {
      value: value,
      action: "getitemmane",
    },
    type: "post",
    success: function (data) {
      var value = JSON.parse(data);
      var name = [];
      value.output.map((e) => {
        name.push(e.itemName);
      });
      //    $(document).on('focus', '.inputitem', function() {
      //     $(this).autocomplete({
      //         source: name,
      //     });
      // });
     
      $(".inputitem").autocomplete({
        source: name,
        select: function () {
     $(".price").val(value.output[0].itemPrice);
        },
      });

       $(".Item").on("click", function () {
        var item = $(this).val();
        var price = $(".price").val();
       $(".Amount").val(item * price);
       });
    },
})
});

$("#profile-tab").on("click",function(){
$.ajax({
  url: url +"invoice_backend.php",
  type:"post",
  data:{
    action:"get_invoiceNo"
  },
  dataType:"json",
  success:function(data){
   $("#invoice").val(100+Number(data.invoice_id)+1);
  }
})

});

// insert data ........................
$("#invoice_submit").on("click",function(){

    var formdata = new FormData(form);
    formdata.append("action","add");
   
      $.ajax({
        url: url +"invoice_backend.php",
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
          }
          else{
            alert(data.error);
          }
        },
      });
    }
)

