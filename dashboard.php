<?php
session_start();
if (empty($_SESSION['username'])) {
   header("Location:http://localhost/First_Project/login-2-main/login2.php");
}
?>