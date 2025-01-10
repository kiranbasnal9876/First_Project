<?php


class client_master
{

    private $con;
    public function __construct()
    {

        include("../dbcon.php");
        $this->con = $con;
    }


    function get_destrict()
    {

        $id = $_POST['id'];

        $sql = "select * from district_master where state_id={$id}";

        $result = $this->con->query($sql);

        while ($data = $result->fetch_array()) {

            echo "<option value='$data[0]'>$data[1]</option>";
        }
    }



    // data insert and update....................

    function insertdata()
    {

        $status = "";
        $error = "";

        if ($_POST['id']!='') {

            $name = $_POST['name'];

            $email = $_POST['email'];

            $phone = $_POST['phone'];

            $district_id = $_POST['district_id'];
            $state_id = $_POST['state_id'];
            $id = $_POST['id'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];

            $sql = "update  client_master
             set name='$name',
             email='$email',
             phone='$phone',
             address='$address',
             state_id='$state_id',
             district_id='$district_id',
             pincode='$pincode'
              where id='$id'";


            if ($this->con->query($sql)) {
                $status=400;
            } else {

                $error = $this->con->error;
            }

            echo  json_encode(['status' => $status, 'error' => $error]);
     } 


        else {
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

            $sql = "insert into client_master( $colmnList) values ($valueList)";
          
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
        FROM client_master AS CM JOIN
        district_master AS DM ON CM.district_id=DM.district_id
        JOIN state_master AS SM ON DM.state_id=SM.state_id where id={$id}";

        $result = $this->con->query($sql);

        $data = $result->fetch_assoc();
        print_r(json_encode($data));
    }



    function deletedata()
    {
        $status = '';
        $error = '';
        $id = $_POST['id'];

        $sql = "delete from client_master where id='$id'";

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


if (isset($_POST['action']) && $_POST['action'] == 'getdestrict') {

    $obj->get_destrict();
} 
else if (isset($_POST['action']) && $_POST['action'] == 'getdata') {
    $obj->getdata();
} 
else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $obj->deletedata();
}
 else if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $obj->insertdata();
}
