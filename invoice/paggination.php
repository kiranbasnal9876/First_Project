

<?php
include("../dbcon.php");

// print_r($_POST);
$output = "";
$limit = '';
$page = '';
$pages = '';
$sort = '';
$offset = '';

if (isset($_POST['invoice_no'])) {
    $invoice_no = $_POST['invoice_no'];
} else {
    $invoice_no = "";
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = "";
}

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
} else {
    $phone = "";
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = "";
}


if (isset($_POST['row'])) {
    $limit = $_POST['row'];
} else {
    $limit = 2;
}
if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else {
    $page = 1;
}

if (isset($_POST['invoicedate'])) {

    $invoiceDate = $_POST['invoicedate'];
} else {
    $invoiceDate = "";
}



$sql1 = "select * FROM invoice_master as IVM JOIN client_master as CM
 ON IVM.client_id=CM.id where invoice_no like '%$invoice_no%' && name like '%$name%' && email like '%$email%' && phone like '%$phone%'  && invoice_date like '%$invoiceDate%' ";



$result1 = $con->query($sql1);


$total_page = ceil($result1->num_rows / $limit);

for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $class = "active";
    } else {
        $class = "";
    }
    $pages .= "<li class='{$class}' id='{$i}'>{$i}</li>";
}

$offset = ($page - 1) * $limit;


if (isset($_POST['colname'])) {


    if (empty($_POST['colname'])) {
        $sort = "";
    } else {
        $sort = "order by {$_POST['colname']} {$_POST['order']}";
    }
}

$sql = "select * FROM invoice_master as IVM JOIN client_master as CM
 ON IVM.client_id=CM.id where invoice_no like '%$invoice_no%' && name like '%$name%' && email like '%$email%' && phone like '%$phone%'  && invoice_date like '%$invoiceDate%'  {$sort} limit {$offset},{$limit}";




$result = $con->query($sql);


if ($result->num_rows > 0) {
    $offset += 1;
    while ($row = $result->fetch_assoc()) {
    $date=  date('d-m-Y', strtotime($row['invoice_date']));
 $output .= "<tr><td>{$offset}</td><td>{$row['invoice_no']}</td><td>$date</td><td class='edit-btn' data-id={$row['invoice_id']}>{$row['name']}</td><td>{$row['address']}</td><td>{$row['email']}</td><td>{$row['phone']}</td>
<td>₹{$row['total_amount']}</td> <td><i class='bi bi-file-earmark-pdf-fill text-danger'></i></td>
<td><i class='bi bi-envelope-fill text-primary'></i></td><td><button  class='btn  edit-btn p-0' data-id={$row['invoice_id']} ><img src='../images/edit (1).svg'></button></td><td><button  class=' btn  p-0 delete-btn' data-id={$row['invoice_id']} ><img src='../images/trash (1).svg' ></button></td></tr>";
        $offset++;
    }
}
echo json_encode(['table' => $output, 'page' => $pages]);
?> 