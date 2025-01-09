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
        $name=$_POST['name'];
        // echo $name;die;
        $option = [];
        if($name!=""){
        $sql = "select * from client_master where name like '%$name%'";

        $result = $this->con->query($sql);
        //    $data=$result->fetch_assoc();

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

function invoice_no(){
   $sql = "SELECT invoice_id FROM invoice_master ORDER BY invoice_id DESC LIMIT 1";
   
   $result=$this->con->query($sql);
   
   echo json_encode($result->fetch_assoc());
}
   
    function getitem()
    {
        $itemname=$_POST['value'];
         $option = [];
         if($itemname !=""){
        $sql = "select * from item_master where itemName like '%$itemname%'";

        $result = $this->con->query($sql);
        //    $data=$result->fetch_assoc();

        if ($result->num_rows > 0) {
         while($data = $result->fetch_assoc()){
                $option[] = $data;
            }}
       
        }
        echo json_encode(['output' => $option]);
    }


function insertdata(){
    $status="";
    $error="";
    $columns = [];
    $values = [];

    foreach ($_POST as $key => $value) {
        if ($value != "") {
            $columns[] = $key;
            $values[] = $value;
        }
    }

    array_pop($columns);
    array_pop($values);
    $colmnList = implode(",", $columns);
    $valueList = "'" . implode("','", $values) . "'";

    $sql = "insert into invoice_master( $colmnList) values ($valueList)";
  
    if ($this->con->query($sql)) {
        $status = 400;
    } else {
        $error = $this->con->error;
    }

     echo  json_encode(['status' => $status, 'error' => $error]);
}
}




$obj = new invoice();


if (isset($_POST['action'])  && $_POST['action'] == "add") {
     $obj->insertdata();
} else if (isset($_POST['action'])  && $_POST['action'] == "getdata") {
    $obj->getclient();
} else if (isset($_POST['action'])  && $_POST['action'] == "getitemmane") {
    $obj->getitem();
} 
else if (isset($_POST['action'])  && $_POST['action'] == "get_invoiceNo") {
     $obj->invoice_no();
}
