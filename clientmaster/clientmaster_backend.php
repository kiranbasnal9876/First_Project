<?php


class client_master{

    private $con;
    public function __construct(){
        
        include("../dbcon.php");
        $this->con=$con;
}


function get_destrict(){

    $id=$_POST['id'];

    $sql="select * from district_master where state_id={$id}";

    $result = $this->con->query($sql);

    while($data= $result->fetch_array()){

        echo "<option value='$data[0]'>$data[1]</option>";
    }

}



function insertdata(){

    $status="";

    $columns=[];
    $values=[];

    foreach($_POST as $key => $value){
        if($value!=""){
      $columns[]=$key;
      $values[]=$value;
      
    }
}
    $colmnList=implode(",",$columns);
    $valueList= "'".implode("','",$values)."'";

    $sql="insert into client_master( $colmnList) values ($valueList)";
    
    $this->con->query($sql);
    $status=400;
        
    json_encode(['status'=>$status]);

     

}



function getdata(){

    $id=$_POST['id'];

    $sql="select *
FROM client_master AS U JOIN
district_master AS D ON U.district_id=D.district_id
JOIN state_master AS S ON d.state_id=S.state_id where id={$id}";

$result=$this->con->query($sql);

$data = $result->fetch_assoc();
print_r(json_encode($data));

}



function deletedata()
{
    $status='';
    $error='';
    $id = $_POST['id'];

    $sql = "delete from client_master where id='$id'";

    if (mysqli_query($this->con, $sql) == false) {

        $error = $this->con->error;
    } else {
        $status = 400;
    }

    json_encode(['status' => $status, 'error' => $error]);
}


}



$obj= new client_master();


if(isset($_POST['action'])&& $_POST['action']=='getdestrict'){

    $obj->get_destrict();
}

else if(isset($_POST['action'])&& $_POST['action']=='getdata'){
    $obj->getdata();
   
}

else if(isset($_POST['action'])&& $_POST['action']=='delete'){
    $obj->deletedata();

}
else if(isset($_POST['action'])&& $_POST['action']=='insert'){
    $obj->insertdata();

}





 


?>