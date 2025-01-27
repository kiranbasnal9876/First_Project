<?php
include("../dbcon.php");

// print_r($_POST);
$output="";
$limit='';
$page='';
$pages='';
$sort='';
$offset='';

if($_POST['id'] != ""){
$id=$_POST['id'];
}
else{
$id="";
}
if(isset($_POST['name'])){
$name=$_POST['name'];
}
else{
$name="";
}

if(isset($_POST['phone'])){
$phone=$_POST['phone'];
}
else{
$phone="";
}
if(isset($_POST['email'])){
$email=$_POST['email'];
}
else{
$email="";
}

if(isset($_POST['address'])){
$address=$_POST['address'];
}
else{
$address="";
}



if(isset($_POST['row'])){
    $limit=$_POST['row'];
}
else{
    $limit=2;
}

if(isset($_POST['page'])){

    $page=$_POST['page'];

}
else{
    $page=1;
}


$sql1="select *
FROM client_master AS CM JOIN
district_master AS DM ON CM.district_id=DM.district_id
JOIN state_master AS SM ON CM.state_id=SM.state_id where id like '%$id%' && name like '%$name%' && email like '%$email%' && phone like '%$phone%' && concat(state_name,district_name,address,pincode)  like '%$address%'   ";

// echo $sql1;

$result1=$con->query($sql1);


$total_page= ceil($result1->num_rows/$limit);





for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $class = "active";
    } else {
        $class = "";
    }
    $pages .= "<li class='{$class}' id='{$i}'>{$i}</li>";
   
}

$offset=($page-1)*$limit;


if (isset($_POST['colname'])) {

    
    if(empty($_POST['colname'])){
        $sort="";
    }
    else{
        $sort = "order by {$_POST['colname']} {$_POST['order']}";
    }
    
    }

$sql="select *
FROM client_master AS CM JOIN
district_master AS DM ON CM.district_id=DM.district_id
JOIN state_master AS SM ON CM.state_id=SM.state_id where  id like '%$id%' && name like '%$name%' && email like '%$email%' && phone like '%$phone%' &&  concat(state_name,district_name,address,pincode)  like '%$address%' {$sort} limit {$offset},{$limit}";




$result=$con->query($sql);


if($result->num_rows>0){
$offset+=1;
    while($row=$result->fetch_assoc()){

        $output .= "<tr><td>{$offset}</td><td>{$row['id']}</td><td class='edit-btn bold' data-id={$row['id']}>{$row['name']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td> {$row['state_name']},{$row['district_name']},{$row['address']},{$row['pincode']}</td>
   <td><button  class='btn  edit-btn p-0' data-id={$row['id']} ><img src='../images/edit (1).svg' ></button></td><td><button  class=' btn  p-0 delete-btn' data-id={$row['id']} ><img src='../images/trash (1).svg' ></button></td></tr>";
             $offset++;
        }
    }

    echo json_encode(['table'=>$output,'page'=>$pages]);

?>