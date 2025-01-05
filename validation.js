


$("input").on("input", function () {
  var value = $(this).val().trim();
  var error = $(this).next();

  if ($(this).attr("type") === "email") {
    var Validemail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,3}$/;

    if (Validemail.test(value)) {
      error.text("");
    } else if (value ==="") {
      error.text("");
    } else {
      error.text("invalid email");
    }
  } 
  
  else if($(this).attr("type")==='password'){
    var validPassword =
    /^(?=.*[A-Z])(?=.*[^%!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/;

  if (validPassword.test(value)) {
    error.text("");
  } else if (value == "") {
    error.text("");
  } else {
    error.text("atlest 1 digit 1 upper case 1 specialchar");
  }

  }
  
  else if($(this).attr("name")==='name'){

    var Validname = /^[a-zA-Z\s.]+$/;
 
  if (Validname.test(value)) {
    error.text("");
  } else if (value == "") {
    error.text("");
  } else {
    error.text("only charecter are allowed");
  }
  }

  else if($(this).attr("name")==='phone'){

    let validPhone = /^[0-9]{10,12}$/;
  
    if (validPhone.test(value)) {
      error.text("");
    } else if (value == "") {
      error.text("");
    } else {
      error.text("atleast 10 digit");
    }
  }
  
  else {
    if (value !== "") {
      error.text("");
    }
  }
});

$("select").on("change", function () {
  var select = $(this).val();
  var error = $(this).next();
  if (select != "") {
    error.text("");
  }
});


var formvalidate = true;

function validate(e) {
  $("input[type!='hidden']").each(function () {
    if ($(this).val() == "") {
      $(this).next().text("all field are required");
    }
  });
}

// validate function when updating data

function updatevalidation(e) {
  $("input:not([type='hidden']):not([type='password'])").each(function () {
    if ($(this).val() == "") {
      $(this).next().text("all field are required");
    }
  });
}

// only numeric
$(document).on("input", ".numeric", function () {
  this.value = this.value.replace(/\D/g, "");
});


function validateClient() {
  $("#formdata")
    .find("select,input")
    .each(function () {
      if ($(this).attr("type") !== "hidden" && $(this).val() == "") {
        $(this).next().text("all field are required");

        formvalidate = false;
      }
    });
}
