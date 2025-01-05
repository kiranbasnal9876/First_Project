$("#login-btn").on("click", function () {
    validate();
    if(formvalidate){
        
    let email = $("#inputemail").val().trim();
  
    let password = $("#inputPassword").val().trim();
    

    $.ajax({
      url: "usermaster/user_backend.php",
      type: "post",
      data: {
        email,
        password,
      },
      success: function (data) {
        if (data == 400) {
          $("input").addClass("border-danger");
          $("#log-wrong").text("email or password not matching");
        } else if (data == 200) {
          window.location.href = "http://localhost/First_Project/usermaster/usermaster.php";
        }
      },
    });
}
  });
  