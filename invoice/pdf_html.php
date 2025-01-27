<?php
include("../dbcon.php");

if(isset($_GET['id'])){
  
  $name="";
  $phone="";
  $address="";
  $email="";
  $invoice_no="";
  $invoice_date="";
  $total_amount="";
  $id = $_GET['id'];
  $items="";

  $sql = "select * FROM invoice_master AS IVM JOIN client_master as CM on IVM.client_id=CM.id WHERE IVM.id='$id'";
 if($con->query($sql)){
    $result=$con->query($sql);

     $data=$result->fetch_assoc();
     $name=$data['name'];
  $phone=$data['phone'];
  $address=$data['address'];
  $email=$data['email'];
  $invoice_no=$data['invoice_no'];
  $invoice_date=$data['invoice_date'];
  $total_amount=$data['total_amount'];
 }


}



$sql2="select * from invoice_itemlist   JOIN item_master  ON invoice_itemlist.item_id=item_master.id  where invoice_itemlist.invoice_id='$id'";
$result=$con->query($sql2);
while ($data2=$result->fetch_assoc()) {
  $items.="<tr>
<td>{$data2['itemName']}</td>
<td>{$data2['itemPrice']}</td>
<td>{$data2['quantity']}</td>
<td>{$data2['amount']}</td>
</tr>";

}
  
?>
 
 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .header {
      text-align: center;
      padding-bottom: 50px;

    }

    .items_table {
      /* border: 1px solid black; */
      width: 700px;
      margin-top: 20px;
    text-align: center;
    border: 2px solid black;
    border-collapse: collapse;
  
    }
    .th{
        background-color: gray;
        border: 1px solid black;
       
      }
    .amount_details{
      margin-left: 500px;
      margin-top: 30px;
    
    }
    p{
      text-align: center;
    }
    small{
      color: light gray;
      margin: 2px;
    }
    img{
      height: 30px;
    }  
  </style>
</head>

<body>

  <table>
    <tbody>
      <tr>
        <td colspan="2" class="header">          
          <img src="../images/sansoftwares_logo.png"><br>
          <b>SAN Software Pvt Ltd</b><br>
          <span>419, 4th Floor, M3M Urbana, Sector 67,
          
          </span><br>
          <span>Gurugram, Haryana 122018</span>
        </td>
      </tr>
     
          <tr>
        <td style='width: 550px;'>
          <div>
            <span><b>Costomer:</b></span><br>
            <span >Name:</span><small ><?php echo $name?></small><br>

            <span>Email:</span><small><?php echo $email?></small><br>
            <span>Mobile Number:</span><small><?php echo $phone?></small><br>
            <span>Address:</span><small><?php echo $address?></small>
          </div>
        </td>
        <td>
          <div>
            <h2>INVOICE</h2>
            <span>Invoice No:</span><span><?php echo $invoice_no?></span><br>
            <span>Date:</span><small ><?php echo $invoice_date?></small>
        </td>

      </tr>

  
    </tbody>
  </table>
  <table class="items_table" >
    <tbody>
      <tr class="th">
        <td>Item</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>SubTotal</td>
      </tr>
      <?php echo $items ?>
    </tbody>
  </table>

  <div class="amount_details">
  <span ><b class="Total-amount">subtotal amount:</b><small><?php echo $total_amount?></small></span><br>

  <span><b  class="Total-amount">total amount:</b><small><?php echo $total_amount?></small></span>
  </div>
 <p>THANK YOU</p>



 <?php include("../footer.php"); ?>