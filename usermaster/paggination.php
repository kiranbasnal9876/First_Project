<?php


include("../dbcon.php");

class user_paggination{

    private $con;
function __construct()
{
    $this->con=new dbcon();
}

    function data(){
        $limit ="";
$output = "";
$page = "";
// $search = "";
$sort = "";
$pages="";

if (isset($_POST['page'])) {
    $page = $_POST['page'];
   
} else {
    $page = 1;
}

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

$sql1 = "select * from user_master where  id like '%{$id}%' && name LIKE '%{$name}%' && phone like'%{$phone}%' && email like '%{$email}%' '{$sort}' ";

$records = $this->con-query($sql1) ;

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

$sql = "select*from user_master  where  id like '%{$id}%' && name LIKE '%{$name}%' && phone like '%{$phone}%' && email like '%{$email}%'  $sort limit {$offset},{$limit}";

$result = mysqli_query($con, $sql);



    if ($result->num_rows > 0) {
        $offset += 1;
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr><td>{$offset}</td><td>{$row['id']}</td><td class='edit-btn bold' data-id={$row['id']}>{$row['name']}</td><td>{$row['phone']}</td><td>{$row['email']}</td>
    <td><button  class='btn  edit-btn p-0' data-id={$row['id']} ><img src='../images/edit (1).svg' ></button></td><td><button  class=' btn  p-0 delete-btn' data-id={$row['id']} ><img src='../images/trash (1).svg' ></button></td></tr>";
            $offset++;
        }
    }




    }
}

$obj = new user_paggination();
$obj->data();

// $limit ="";
// $output = "";
// $page = "";
// // $search = "";
// $sort = "";
// $pages="";

// if (isset($_POST['page'])) {
//     $page = $_POST['page'];
   
// } else {
//     $page = 1;
// }

// if($_POST['id'] != ""){
//     $id=$_POST['id'];
//     }
//     else{
//     $id="";
//     }
//     if(isset($_POST['name'])){
//     $name=$_POST['name'];
//     }
//     else{
//     $name="";
//     }
    
//     if(isset($_POST['phone'])){
//     $phone=$_POST['phone'];
//     }
//     else{
//     $phone="";
//     }
//     if(isset($_POST['email'])){
//     $email=$_POST['email'];
//     }
//     else{
//     $email="";
//     }
    

// //  echo $_POST['colname'];
// //  echo $_POST['order'];
// if (isset($_POST['colname'])) {

    
// if(empty($_POST['colname'])){
//     $sort="";
// }
// else{
//     $sort = "order by {$_POST['colname']} {$_POST['order']}";
// }

// }


// if (isset($_POST['row'])) {
//     $limit = $_POST['row'];
    
// }
// else{
//     $limit = 2;
// }

// $sql1 = "select * from user_master where  id like '%{$id}%' && name LIKE '%{$name}%' && phone like'%{$phone}%' && email like '%{$email}%' '{$sort}' ";

// $records = mysqli_query($con, $sql1);

// $total_records = mysqli_num_rows($records);

// $total_page = ceil($total_records / $limit);






// //total pages

// for ($i = 1; $i <= $total_page; $i++) {
//     if ($i == $page) {
//         $class = "active";
//     } else {
//         $class = "";
//     }
//     $pages .= "<li class='{$class}' id='{$i}'>{$i}</li>";
// }







// $offset = ($page - 1) * $limit;

// $sql = "select*from user_master  where  id like '%{$id}%' && name LIKE '%{$name}%' && phone like '%{$phone}%' && email like '%{$email}%'  $sort limit {$offset},{$limit}";

// $result = mysqli_query($con, $sql);



//     if ($result->num_rows > 0) {
//         $offset += 1;
//         while ($row = $result->fetch_assoc()) {
//             $output .= "<tr><td>{$offset}</td><td>{$row['id']}</td><td class='edit-btn bold' data-id={$row['id']}>{$row['name']}</td><td>{$row['phone']}</td><td>{$row['email']}</td>
//     <td><button  class='btn  edit-btn p-0' data-id={$row['id']} ><img src='../images/edit (1).svg' ></button></td><td><button  class=' btn  p-0 delete-btn' data-id={$row['id']} ><img src='../images/trash (1).svg' ></button></td></tr>";
//             $offset++;
//         }
//     }



echo json_encode(['table'=>$output,'page'=>$pages]) ;

