<?php
session_start();
if (isset($_SESSION['username'])) {
   header("Location:http://localhost/First_Project/usermaster/usermaster.php");
}
?>

<?php include("../header.php"); ?>

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
                   
                    <input type="email"  id="inputemail" maxlength="30" placeholder="Enter email" name="email">
                   <span></span>
                </div>
                <div>
                    <input type="password" id="inputPassword"  placeholder="Enter password" name="password">
                   <span></span>
                </div>
                <button type="button" id="login-btn">login</button>
                <span id="log-wrong"></span>
            </form>
            </div>
            <div>
                <img src="../images/log-in2.jpg" alt="">
            </div>
            </div>
        </div>
    </div>

    </div>


    <?php include("../footer.php"); ?>