<?php


class invoice
{
    private $con;
    
    function __construct()
    {  
        include("../dbcon.php");
        $connection = new dbcon();
        $this->con=$connection->con;
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
        $sql = "SELECT id FROM invoice_master ORDER BY id DESC LIMIT 1";
        $result = $this->con->query($sql);
        echo json_encode($result->fetch_assoc());
    }

    function getitem()
    {

        $itemname = $_POST['value'];

        $strId = "";

        if (isset($_POST['items_id'])) {


            $arrId = $_POST['items_id'];

            $strId = implode(" ,", $arrId);

            if (empty(trim($strId))) {
                $strId = "";
            } else {
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
        $values = [];
        $invoice = array(
            $_POST['invoice_no'],
            date('Y-m-d', strtotime($_POST["invoice_date"])),
            $_POST['client_id'],
            $_POST['total_amount']
        );

        foreach ($invoice as $key => $value) {
            if ($value != "") {
                $values[] = $value;
            }
        }
        $valueList = "'" . implode("','", $values) . "'";
        if (!empty(trim($_POST['client_id']))) {

            $sql = "insert into invoice_master(invoice_no,invoice_date,client_id,total_amount )values($valueList)";
            if ($this->con->query($sql)) {
                $status = 200;
            }
        } else {
            $error = "Client details are required";
        }

        if ($status == 200) {
            $last_id = $this->con->insert_id;
            $item_id = $_POST['item_id'];
            $quantity = $_POST['quantity'];
            $amount = $_POST['amount'];
            
            for ($i = 0; $i < count($item_id); $i++) {
                if ($quantity[$i] != "" && $item_id[$i] != "") {
                    $sql2 = "insert into invoice_itemlist(invoice_id,item_id,quantity,amount)values($last_id,$item_id[$i],$quantity[$i],$amount[$i])";

                    if ($this->con->query($sql2)) {
                        $status = 200;
                    }
                } else {
                    $error = "plz select Quantity";
                }
            }
        }
        echo  json_encode(['status' => $status, 'error' => $error]);
    }


    //updating data//
    function update()
    {
        $error = "";
        $status = "";
        $client_id = $_POST['client_id'];
        $invoice_id = $_POST['id'];

        $total_amount = $_POST['total_amount'];

        if($client_id !== null && $invoice_id !== null && $total_amount !== null){

            $sql = "update  invoice_master
         set client_id='$client_id',
          total_amount='$total_amount'
          where id='$invoice_id'";
          $this->con->query($sql);
            $status = 200;
        }
        
        
        else{
            $error = "All fields are required";
        }

        if ($status == 200) {
            $sql1 = "delete from invoice_itemlist where invoice_id='$invoice_id'";
        //    echo $sql1;
            if ($this->con->query($sql1)) {
                $invoice_id = $_POST['id'];
                
                $item_id = $_POST['item_id'];
                $quantity = $_POST['quantity'];
                $amount = $_POST['amount'];

                for ($i = 0; $i < count($item_id); $i++) {
                    if ($quantity[$i] == "" && $item_id[$i] == "") {
                        $error = "all items field are required";
                        echo  json_encode([ 'error' => $error]);
                        die;
                    }
                        $sql2 = "insert into invoice_itemlist(invoice_id,item_id,quantity,amount)values($invoice_id,$item_id[$i],$quantity[$i],$amount[$i])";
              
                        if ($this->con->query($sql2)){
                            $status = 200;
                        } 
                    
                }

                echo  json_encode(['status' => $status, 'error' => $error]);
            }
        }


       
    }

    //deleting data

    function deletedata()
    {
        $status = '';
        $error = '';
        $invoice_id = $_POST['invoice_no'];

        $sql2 = "delete from invoice_itemlist  where id='$invoice_id'";


        if ($this->con->query($sql2)) {
            $status = 200;
        } else {
            $error = $this->con->error;
        }

        if ($status == 200) {

            $sql = "delete from invoice_master  where id='$invoice_id'";
            $this->con->query($sql);
        }


        echo   json_encode(['status' => $status, 'error' => $error]);
    }

    function getdata()
    {
        $status = '';
        $error = '';
        $id = $_POST['id'];
        $items = [];
        $data="";
        $sql = "select * FROM invoice_master AS IVM JOIN client_master as CM on IVM.client_id=CM.id WHERE IVM.id='$id'";
        if ($this->con->query($sql)) {
            $result = $this->con->query($sql);

            $data = $result->fetch_assoc();
            $status = 200;
        } else {
            $error = $this->con->error;
        }
        if ($status == 200) {

            $sql2 = "select * from invoice_itemlist   JOIN item_master  ON invoice_itemlist.item_id=item_master.id  where invoice_itemlist.invoice_id='$id'";
            // echo $sql2;
            $result = $this->con->query($sql2);
            while ($data2 = $result->fetch_assoc()) {
                $items[] = $data2;
            }
            
        }

        echo   json_encode(['status' => $status, 'error' => $error, 'output1' => $data, 'output2' => $items]);
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
} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $obj->deletedata();
} else if (isset($_POST['action']) && $_POST['action'] == 'getdata') {
    $obj->getdata();
} else if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $obj->update();
} 
// else if (isset($_POST['action']) && $_POST['action'] == 'invoice_details') {
//     $obj->getInvoiceDetail();
// } 
