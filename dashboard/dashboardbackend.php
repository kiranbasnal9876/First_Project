<?php
 class getdata{
    
  private $con;
    
  function __construct()
  {  
      include("../dbcon.php");
      $connection = new dbcon();
      $this->con=$connection->con;
  }
  
 
  function get_records(){

      $sql="select id from user_master";
  
    $data= $this->con->query($sql);
    
    // $result=$data->fetch_assoc();
    // print_r($result);

    $userdata="<h6 class='card-title'>USERS({$data->num_rows})</h6>";

      $sql2="select id from client_master";
  
    $data1=  $this->con->query($sql2);

      $clientdata="<h6 class='card-title'>CLIENTS({$data1->num_rows})</h6>";

      $sql3="select id from  item_master";
  
    $data2=  $this->con->query($sql3);
      $itemdata="<h6 class='card-title'>ITEMS({$data2->num_rows})</h6>";


      $sql4="select sum(total_amount) as total_amount from invoice_master";

   $result= $this->con->query($sql4);
  
   if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $invoice= $row["total_amount"];
    }
} 

      $totalinvoice="<h6 class='card-title'>Total Invoice=$invoice</h6>";

     $sql5="select itemName , sum(amount) as items_total_amount from item_master join invoice_itemlist on item_master.id=invoice_itemlist.item_id group by itemName";
     $items_amount=[];
     $items=[];
    $result2= $this->con->query($sql5);
    if ($result2->num_rows > 0) {
      // output data of each row
      while($row1 = $result2->fetch_assoc()) {
       array_push($items_amount, $row1["items_total_amount"]); 
       array_push($items, $row1["itemName"]); 
      }

  } 

      
echo json_encode(['userdata'=>$userdata,'clientdata'=>$clientdata,'itemdata'=>$itemdata,'total_invoice'=>$totalinvoice,'items'=>$items,'item_amount'=>$items_amount]);

  }
    
 }


 $obj= new getdata();
 $obj->get_records();

?>