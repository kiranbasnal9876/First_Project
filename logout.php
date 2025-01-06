<?php 
session_start();
session_unset();
session_destroy();
header("Location:http://localhost/First_Project/login-2-main/login2.php");
 ?>