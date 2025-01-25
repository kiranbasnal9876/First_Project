var url="http://localhost/First_Project/";
$("#login-btn").on("click", function () {
    validate();
    if(checkvalidate){
        
    let email = $("#inputemail").val().trim();
  
    let password = $("#inputPassword").val().trim();
    

    $.ajax({
      url: url + "usermaster/user_backend.php",
      type: "post",
      data: {
        email,
        password,
        action:"logIn"
      },

      success: function (data) {
        let dataNew = JSON.parse(data)
        if (dataNew.status == 400) {
          
           $("input").addClass("border-danger");
          $("#log-wrong").text("email or password is wrong");
        } 
        else if (dataNew.status == 200) {
          debugger
          window.location.href=url+"dashboard/dashboard.php";
        }
      },
    });
}
  });
  