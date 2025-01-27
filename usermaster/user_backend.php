<?php

session_start();



class User_master
{

    private $con;

   

    public function __construct()
    {
        include("../dbcon.php");
        $this->con = $con;
        

    }

    function logIn()
    {
   
        $status = '';
        $error="";
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,3}$/", $email)) {
            $error=  "entered email is invalid"; 
         } else if (!preg_match("/^(?=.*[A-Z])(?=.*[^%!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", $password)) {
             $error= "entered password is invalid"; }
        

        $sql = "select * from user_master where email='$email' and password='$password'";

        $result = $this->con->query($sql);

        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['username'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                
                $status = 200;
            }
        } else {

            $status = 400;
        }

      echo  json_encode(['status' => $status,'error'=>$error]);
    }

    function adduser()
    {

        $status='';
        $error='';
        $email = $_POST["email"];
        $password = $_POST["password"];
        $name = $_POST['Name'];
        $phone = $_POST['phone'];


        if (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,3}$/", $email)) {
           $error=  "entered email is invalid";
        } else if (!preg_match("/^(?=.*[A-Z])(?=.*[^%!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/", $password)) {
            $error= "entered password is invalid";
        } else if (!preg_match("/^[0-9]{10,12}$/", $phone)) {
            $error=  "entered phone number is invalid";
        } else if (!preg_match("/^[a-zA-Z\s.]+$/", $name)) {
            $error=  "entered name is invalid";
        }

        if (isset($_POST['id'])) {

            $id = $_POST['id'];
            $sql = "update  user_master
        set name='$name',
        email='$email',
        phone='$phone',
        password='$password' where id='$id'";


            if (!empty($email && $password && $name && $phone)) {
                if (mysqli_query( $this->con, $sql) == true) {


                    $status = 400;
                }
            }
        } else  if (!empty($email && $password && $name && $phone)) {
            $sql = "insert into user_master(name,email,phone,password)values('$name','$email','$phone','$password')";
            
            if (mysqli_query($this->con, $sql) == true) {

                $status = 400;
            } else {
                $error ="plz fill your unique email and phone";
            }
        }

        echo json_encode(['status' => $status, 'error' => $error]);
    }


    function getdata()
    {
        

        $id = $_POST['id'];


        $sql = "select * from user_master where id='{$id}'";

        $result = $this->con->query($sql);
        $data = $result->fetch_assoc();
        print_r(json_encode($data));
    }



    function deletedata()
    {
        $status='';
        $error='';
        $id = $_POST['id'];
        if( $_SESSION['id']==$id){
          $error="you can not delete logged user";
        }
        
        else{
            $sql = "delete from user_master where id='$id'";
         
            if (mysqli_query($this->con, $sql) == false) {
    
                $error = $this->con->error;
            } else {
                $status = 200;
            }
        }
       

        echo json_encode(['status' => $status, 'error' => $error]);
    }
}

$user = new User_master();


if ($_POST['action'] == "add") {
    $user->adduser();
} else if ($_POST['action'] == "getdata") {
    $user->getdata();
} else if ($_POST['action'] == "delete") {

    $user->deletedata();
}
else if ($_POST['action'] == "logIn") {

    $user->logIn();
}