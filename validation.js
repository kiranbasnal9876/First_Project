


$(document).on("input ","input", function () {
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




var checkvalidate=true;
function validate() {

  $("input[type!='hidden'],textarea,select").each(function () {
    // debugger;
    if ($(this).val() == "") {
    $name=  $(this).prev("label").text();
  
    
      $(this).next("span").text($name.slice(0,-1)+" is required");
      checkvalidate=false;
    }
    else{
       checkvalidate=true;
    }
  });
}

// validate function when updating data


function updatevalidation(e) {
  let checkvalidate = true;  
  
  $("input:not([type='hidden']):not([type='password']):not([type='file'])").each(function () {
    if ($(this).val() == "") {
      $(this).next().text("This field is required");
      checkvalidate = false; 
      return false;  
    } else {
      $(this).next().text(""); 
    }
  });
  
  return checkvalidate; 
}

// only numeric
$(document).on("input", ".numeric", function () {
 
  this.value = this.value.replace(/\D/g,"");
});

$(document).on("input", ".price", function () {
  if (this.value !== undefined && this.value !== null) {
 
      this.value = this.value.replace(/[^0-9\.]/g, "")   
    .replace(/(\..*)\./g, "$1"); 
  }
});





$(".sidebar_slide").click(function(){

  if($(this).hasClass("slide")){

      $(this).removeClass("slide").addClass("noSlide");
      $(".sidebar-div").find("span").hide();
      $(".sidebar").css("flex","0.2");
  }
  else{

    $(this).removeClass('noSlide').addClass("slide");
    $(".sidebar-div").find("span").show();
    $(".sidebar").css("flex","1.2");
  }

})

