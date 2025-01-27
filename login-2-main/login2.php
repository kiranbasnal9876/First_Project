
<?php
session_start();
if (isset($_SESSION['username'])) {
   header("Location:".$url."dashboard/dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Layout</title>
    <link rel="stylesheet" href="../assetes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../assetes/css/jquery-ui.css">
    <link rel="stylesheet" href="../assetes/css/bootsrap_icon.css">
    <link rel="stylesheet" href="../responsive.css">
</head>


<body>

    <div class="login-page-wrapper">

    <div class="login-container">
        <div class="login-main">
            <div class="my-logo">
                <img src="../images/sansoftwares_logo.png" alt="">
            </div>
            <div class="log-div">
            <div>
            <div class="login-text">
                <p>Login in</p>
            </div>
            <form>
                <div class="email-input">
                   
                    <input type="email"  class="" id="inputemail" maxlength="30" placeholder="Enter email" name="email" value="kiran@gmail.com">
                   
                </div>
                <div>
                    <input type="password"  class="" id="inputPassword"  placeholder="Enter password" name="password" value="12345">
                 
                </div>
                <div id="log-wrong" style="color: red;"></div>
                <button type="button" id="login-btn">login</button>
                
            </form>
            </div>
            <div>
                <img src="../images/log-in2.jpg" alt="">
                <!-- <img src="../logout.php" alt=""> -->
            </div>
            </div>
        </div>
    </div>

    </div>


    <?php include("../footer.php"); ?>