<?php

include("../dbcon.php");
$name=$_POST['name'];

$email=$_POST['email'];

$phone=$_POST['phone'];

$district_id=$_POST['district_id'];
$state_id=$_POST['state_id'];
$id=$_POST['id'];
$address=$_POST['address'];
$pincode=$_POST['pincode'];

$sql="update  user_master
        set name='$name',
        email='$email',
        phone='$phone',
        address='$address',
        state_id='$state_id',
        district_id='$district_id',
        pincode='$pincode'
         where id='$id'";


if($con->query($sql)){
    echo json_encode(['status'=>400]);
}



?>