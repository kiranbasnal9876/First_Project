<?php


class invoice
{

    private $con;
    public function __construct()
    {

        include("../dbcon.php");
        $this->con = $con;
    }

    function getclient()
    {
        $name = $_POST['name'];
       
        $option = [];
        if ($name != "") {
            $sql = "select * from client_master where name like '%$name%'";

            $result = $this->con->query($sql);

            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    $option[] = $data;
                }
            } else {
                $option = ['no result found'];
            }
        }
        echo json_encode(['output' => $option]);
    }

    // geting last invoice number.......................................
    function invoice_no()
    {
        $sql = "SELECT invoice_id FROM invoice_master ORDER BY invoice_id DESC LIMIT 1";
        $result = $this->con->query($sql);
        echo json_encode($result->fetch_assoc());
    }

    function getitem()
    {
        
        $itemname = $_POST['value'];

        $strId = "";

        if(isset($_POST['items_id'])){


            $arrId = $_POST['items_id'];
    
            $strId = implode(" ," ,$arrId);
    
            if(empty(trim($strId))){
                $strId ="";
            }
            else{
                $strId = "and id not in ($strId)";
            }

        }



        
        $option = [];
        if ($itemname != "") {
            $sql = "select * from item_master where itemName like '%$itemname%' $strId";
          
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    $option[] = $data;
                }
            }
        }
        echo json_encode(['output' => $option]);
    }

    // insert data in database......................................
    function insertdata()
    {
        $status = "";
        $error = "";
        $values=[];
        $invoice=array(
       $_POST['invoice_no'],
       date('Y-m-d', strtotime($_POST["invoice_date"])),
       $_POST['client_id'],
      $_POST['total_amount']);

        foreach ($invoice as $key => $value) {
            if ($value != "") {
                $values[] = $value;
            }
        }
        $valueList = "'" . implode("','", $values) . "'";
        $sql = "insert into invoice_master(invoice_no,invoice_date,client_id,total_amount )values($valueList)";
        if ($this->con->query($sql)) {
            $status = 400;
        } else {
            $error = $this->con->error;
        }
        
        if($status==400){
            $last_id = $this->con->insert_id;
           $item_id=$_POST['item_id'];
           $quantity=$_POST['quantity'];
           $amount=$_POST['amount'];

        for($i=0;$i<count($item_id);$i++){
        if($quantity[$i]!="" && $item_id[$i]!=""){
            $sql2="insert into invoive(invoice_id,item_id,quantity,amount)values($last_id,$item_id[$i],$quantity[$i],$amount[$i])";
            
            if($this->con->query($sql2)){
                $status=400;
            }
            $error=$this->con->error;
          
           }
           else{
            $error="plz select Quentity";
           }
        }

        }
        echo  json_encode(['status' => $status, 'error' => $error]);

    }


//updating data//
function update(){
    $error = "";
    $status="";
    $client_id = $_POST['client_id'];
    $invoice_id= $_POST['invoice_id'];
    
 $total_amount=$_POST['total_amount'];

   
    $sql ="update  invoice_master
     set client_id='$client_id',
      total_amount='$total_amount'
      where invoice_id='$invoice_id'";


    if ($this->con->query($sql)) {
        $status=400;
    } else {

        $error = $this->con->error;
    }
    
        if($status==400){
            $sql1 = "delete from invoive  where invoice_id='$invoice_id'";
          
            if( $this->con->query($sql1)){
                $invoice_id= $_POST['invoice_id'];
                $item_id=$_POST['item_id'];
                $quantity=$_POST['quantity'];
                $amount=$_POST['amount'];
     
             for($i=0;$i<count($item_id);$i++){
             if($quantity[$i]!="" && $item_id[$i]!=""){
                 $sql2="insert into invoive(invoice_id,item_id,quantity,amount)values($invoice_id,$item_id[$i],$quantity[$i],$amount[$i])";
                 
                 if($this->con->query($sql2)){
                     $status=400;
                 }
                 else{
                    $error="items not updated";
                 }
                }
            
            }
                  
        }
       }
    

    echo  json_encode(['status' => $status, 'error' => $error]);
}

//deleting data
    
    function deletedata()
    {
        $status = '';
        $error = '';
        $invoice_id= $_POST['invoice_no'];

        $sql2 = "delete from invoive  where invoice_id='$invoice_id'";
       
      
        if ($this->con->query($sql2)) {
            $status = 400;
        } else {
            $error = $this->con->error;
        }
      
       if($status==400){
        
        $sql = "delete from invoice_master  where invoice_id='$invoice_id'";
        $this->con->query($sql);
       }


     echo   json_encode(['status' => $status, 'error' => $error]);
    }

    function getdata()
    {
        $status = '';
        $error = '';
        $id = $_POST['id'];
       $items=[];
        $sql = "select * FROM invoice_master AS IVM JOIN client_master as CM on IVM.client_id=CM.id WHERE  invoice_id='$id'";
       if($this->con->query($sql)){
           $result=$this->con->query($sql);
   
           $data=$result->fetch_assoc();
           $status=400;
       }
       else{
        $error=$this->con->error;
       }
     if($status==400){
       
        $sql2="select * from invoive   JOIN item_master  ON invoive.item_id=item_master.id  where invoive.invoice_id='$id'";
        $result=$this->con->query($sql2);
        while ($data2=$result->fetch_assoc()) {
            $items[]=$data2;
        }
        
     }
    
     echo   json_encode(['status' => $status, 'error' => $error,'output1'=>$data,'output2'=>$items]);
    }


}




$obj = new invoice();


if (isset($_POST['action'])  && $_POST['action'] == "add") {
    $obj->insertdata();
} else if (isset($_POST['action'])  && $_POST['action'] == "getclientdata") {
    $obj->getclient();
} else if (isset($_POST['action'])  && $_POST['action'] == "getitemmane") {
    $obj->getitem();
} else if (isset($_POST['action'])  && $_POST['action'] == "get_invoiceNo") {
    $obj->invoice_no();
}

else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $obj->deletedata();
}

else if (isset($_POST['action']) && $_POST['action'] == 'getdata') {
    $obj->getdata();
} 
else if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $obj->update();
} 