<?php


class client_master
{

    private $con;
    public function __construct()
    {

        include("../dbcon.php");
        $this->con = $con;
    }

function insertdata()
    {

        $status = "";
        $error = "";
        
        $itemName = $_POST['itemName'];

        $itemPrice = $_POST['itemPrice'];

        $itemD = $_POST['itemD'];
        
        $path=$_FILES['fileUpload']['name'];
        $new_item="";
    if(isset($path)){

        $file='folder/'.$path;
        $new_item=", itemPath=".$file;
    }
    else{
        $new_item="";
    }
       

        if ($_POST['id']!='') {

            $id = $_POST['id'];
           

            $sql = "update  item_master
             set itemName='$itemName',
             itemPrice='$itemPrice',
             itemD='$itemD'
             $new_item
            
              where id='$id'";
           

            if ($this->con->query($sql)) {
                $status=400;
            } else {

                $error = $this->con->error;
            }

            echo  json_encode(['status' => $status, 'error' => $error]);
     } 


        else {

           
            move_uploaded_file($_FILES['fileUpload']['tmp_name'],$file);
           
            $sql = "insert into item_master( itemName,itemPrice,itemD,itemPath) values ( '{$itemName}','{$itemPrice}','{$itemD}','{$file}')";
      
          
            if ($this->con->query($sql)) {
                $status = 400;
            } else {
                $error = $this->con->error;
            }

             echo  json_encode(['status' => $status, 'error' => $error]);
        }

      
    }



    function getdata()
    {

        $id = $_POST['id'];

        $sql = "select *
        FROM item_master where id={$id}";

        $result = $this->con->query($sql);

        $data = $result->fetch_assoc();
        print_r(json_encode($data));
    }

    
    function deletedata()
    {
        $status = '';
        $error = '';
        $id = $_POST['id'];

        $sql = "delete from item_master where id='$id'";

        $this->con->query($sql);

        if ($this->con->error){
            $error = $this->con->error;
        } else {
            $status = 200;
        }

     echo   json_encode(['status' => $status, 'error' => $error]);
    }


}

    $obj = new client_master();


  if (isset($_POST['action']) && $_POST['action'] == 'getdata') {
    $obj->getdata();
} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $obj->deletedata();
} else if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $obj->insertdata();
}
