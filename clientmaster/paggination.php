<?php

$output="";
$limit='';
$page='';
$pages='';
$sort='';
$offset='';
include("../dbcon.php");


if(isset($_POST['limit'])){
    $limit=$_POST['limit'];
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


$sql1="select * from client_master";

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
FROM client_master AS U JOIN
district_master AS D ON U.district_id=D.district_id
JOIN state_master AS S ON d.state_id=S.state_id {$sort} limit {$offset},{$limit}";


 

$result=$con->query($sql);


if($result->num_rows>0){
$offset+=1;
    while($row=$result->fetch_assoc()){

        $output .= "<tr><td>{$offset}</td><td>{$row['id']}</td><td class='edit-btn' data-id={$row['id']}>{$row['name']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td>{$row['address']}</td>
    <td>{$row['state_name']}</td><td>{$row['district_name']}</td><td>{$row['pincode']}</td><td><button  class='btn  edit-btn p-0' data-id={$row['id']} ><img src='../images/edit (1).svg' ></button></td><td><button  class=' btn  p-0 delete-btn' data-id={$row['id']} ><img src='../images/trash (1).svg' ></button></td></tr>";
             $offset++;
        }
    }

    echo json_encode(['table'=>$output,'page'=>$pages]);

?>