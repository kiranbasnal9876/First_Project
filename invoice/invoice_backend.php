<?php


class invoice
{

    private $con;
    public function __construct()
    {

        include("../dbcon.php");
        $this->con = $con;
    }

   function getclient(){
    $output="";
    $name=$_POST['name'];
    $sql="select name from client_master where name like '%$name%'";
    $result=$this->con->query($sql);
    
     if($result->num_rows>0){
        while($data = $result->fetch_assoc()){
            $output .="<li>{$data['name']}</li>";
        }
     }

     else{
        $output .="no result found";
     }

     echo json_encode(['output'=>$output]);

   }


   function getdata(){
    
    $name=$_POST['name'];
    $sql="select * from client_master where name = '$name'";
//    echo $sql;
    $result=$this->con->query($sql);
    
    $output=$result->fetch_assoc();
    print_r(json_encode($output));
   }

   function getitem(){
   
    $sql="select itemName from item_master";

    $result=$this->con->query($sql);
   $data=$result->fetch_assoc();
   print_r($data);
    //  if($result->num_rows> 0 ){
    //     while($data = $result->fetch_assoc()){
    //         $output .="<li>{$data['itemName']}</li>";
    //     }
    //  }

    //  else{
    //     $output .="no result found";
    //  }

    //  echo json_encode(['output'=>$output]);

   }

   function getitemdata(){
    
    $name=$_POST['name'];
    $sql="select itemPrice from item_master where itemName = '$name'";
//    echo $sql;
    $result=$this->con->query($sql);
    
    $output=$result->fetch_assoc();
    print_r(json_encode($output));
   }

}

$obj = new invoice();
 $obj->getitem();

// if($_POST['action']=="getclientdata"){
//     $obj->getclient();
// }
// else if($_POST['action']=="getdata"){
//     $obj->getdata();
// }
// else if($_POST['action']=="getitemdata"){
//     $obj->getitem();
// }
// else if($_POST['action']=="itemdata"){
//     $obj->getitemdata();
// }

?>