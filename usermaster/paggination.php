<?php

include("../dbcon.php");

$limit ="";
$output = "";
$page = "";
$search = "";
$sort = "";
$pages="";

if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
   
} else {
    $page = 1;
}

if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = "";
}

//  echo $_POST['colname'];
//  echo $_POST['order'];
if (isset($_POST['colname'])) {

    
if(empty($_POST['colname'])){
    $sort="";
}
else{
    $sort = "order by {$_POST['colname']} {$_POST['order']}";
}

}


if (isset($_POST['row'])) {
    $limit = $_POST['row'];
    
}
else{
    $limit = 2;
}

$sql1 = "select * from user_master where  id  like '%{$search}%' or name LIKE '%{$search}%' or phone like '%{$search}%' or email like '%{$search}%' '{$sort}' ";

$records = mysqli_query($con, $sql1);

$total_records = mysqli_num_rows($records);

$total_page = ceil($total_records / $limit);






//total pages

for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $class = "active";
    } else {
        $class = "";
    }
    $pages .= "<li class='{$class}' id='{$i}'>{$i}</li>";
}







$offset = ($page - 1) * $limit;

$sql = "select*from user_master  where  id  like '%{$search}%' or name LIKE '%{$search}%' or phone like '%{$search}%' or email like '%{$search}%'  $sort limit {$offset},{$limit}";

$result = mysqli_query($con, $sql);



    if ($result->num_rows > 0) {
        $offset += 1;
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr><td>{$offset}</td><td>{$row['id']}</td><td class='edit-btn' data-id={$row['id']}>{$row['name']}</td><td>{$row['phone']}</td><td>{$row['email']}</td>
    <td><button  class='btn  edit-btn p-0' data-id={$row['id']} ><img src='../images/edit (1).svg' ></button></td><td><button  class=' btn  p-0 delete-btn' data-id={$row['id']} ><img src='../images/trash (1).svg' ></button></td></tr>";
            $offset++;
        }
    }



echo json_encode(['table'=>$output,'page'=>$pages]) ;

