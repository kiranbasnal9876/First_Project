<?php

$servername = "localhost"; 
    $username = "root";
    $password = "";
    $database = "Project_data";

    $con = new mysqli($servername, $username, $password, $database);


    if ($con->connect_error) {
      // exit(''); 

       // diff b/n exit or die 
       // die;
      die("Connection failed: " . $con->connect_error);
    } 
    ?>