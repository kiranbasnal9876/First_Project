<?php
 class getdata{
    
    private $con;
    public function __construct()
    {

        include("../dbcon.php");
        $this->con = $con;
    }
 
  function get_records(){

      $sql="select id from user_master";
  
    $data= $this->con->query($sql);
    
    // $result=$data->fetch_assoc();
    // print_r($result);

    $userdata="<h5 class='card-title'>USERS({$data->num_rows})</h5>";

      $sql2="select id from client_master";
  
    $data1=  $this->con->query($sql2);

      $clientdata="<h5 class='card-title'>CLIENTS({$data1->num_rows})</h5>";

      $sql3="select id from  item_master";
  
    $data2=  $this->con->query($sql3);
      $itemdata="<h5 class='card-title'>ITEMS({$data2->num_rows})</h5>";


      $sql4="select sum(total_amount) as total_amount from invoice_master";

   $result= $this->con->query($sql4);
  
   if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $invoice= $row["total_amount"];
    }
} 

      $totalinvoice="<h5 class='card-title'>Total Invoice=$invoice</h5>";
      
echo json_encode(['userdata'=>$userdata,'clientdata'=>$clientdata,'itemdata'=>$itemdata,'total_invoice'=>$totalinvoice]);

  }
    
 }


 $obj= new getdata();
 $obj->get_records();

?>