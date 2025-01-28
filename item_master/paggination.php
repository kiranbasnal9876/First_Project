<?php

class item_paggination {

    private $con;
      
  function __construct()
  {  
      include("../dbcon.php");
      $connection = new dbcon();
      $this->con=$connection->con;
  }
  
      function data(){
$output="";
$limit='';
$page='';
$pages='';
$sort='';
$offset='';

if(isset($_POST['id'])){
$id=$_POST['id'];
}
else{
$id="";
}
if(isset($_POST['itemName'])){
$itemName=$_POST['itemName'];
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
FROM item_master 

 where  itemName like '%$itemName%'";



$result1=$this->con->query($sql1);


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
FROM item_master d where  itemName like '%$itemName%'    {$sort} limit {$offset},{$limit}";




$result=$this->con->query($sql);


if($result->num_rows>0){
$offset+=1;
    while($row=$result->fetch_assoc()){

        $output .= "<tr><td>{$offset}</td>
        <td class='edit-btn bold' data-id={$row['id']}>{$row['itemName']}</td>
        <td class='right'>{$row['itemPrice']}</td><td class='formate-td'>{$row['itemD']}</td>
        <td><img class='item-image' src='{$row["itemPath"]}' width='60px' hight='800px' ></td>
        <td><button  class='btn  edit-btn p-0' data-id={$row['id']} ><img src='../images/edit (1).svg' ></button></td>
        <td><button  class=' btn  p-0 delete-btn' data-id={$row['id']} ><img src='../images/trash (1).svg' ></button></td>
        </tr>";
             $offset++;
        }
    }

    echo json_encode(['table'=>$output,'page'=>$pages]);
}
}

$obj = new item_paggination();

$obj->data();
?>