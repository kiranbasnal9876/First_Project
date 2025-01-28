
<?php
class invoice_pdf {

    private $con;
    public $name = "";
    public $phone = "";
    public $address = "";
    public $email = "";
    public $invoice_no = "";
    public $invoice_date = "";
    public $total_amount = "";
    public $items = "";

    function __construct() {
        include("../dbcon.php");
        $connection = new dbcon();
        $this->con = $connection->con;
    }

    function data() {
        
        if (isset($_GET['id'])) {
            $id = $_GET['id']; 

            
            $sql = "SELECT * FROM invoice_master AS IVM 
                    JOIN client_master AS CM ON IVM.client_id = CM.id 
                    WHERE IVM.id = '$id'";

            $result = $this->con->query($sql);

            if ($result && $result->num_rows > 0) {
         
                $data = $result->fetch_assoc();
                $this->name = $data['name'];
                $this->phone = $data['phone'];
                $this->address = $data['address'];
                $this->email = $data['email'];
                $this->invoice_no = $data['invoice_no'];
                $this->invoice_date = $data['invoice_date'];
                $this->total_amount = $data['total_amount'];
            } else {
                echo "Invoice data not found.";
                return;
            }

            // Query to fetch invoice items
            $sql2 = "SELECT * FROM invoice_itemlist 
                     JOIN item_master ON invoice_itemlist.item_id = item_master.id 
                     WHERE invoice_itemlist.invoice_id = '$id'";

            $result2 = $this->con->query($sql2);
            if ($result2 && $result2->num_rows > 0) {
                while ($data2 = $result2->fetch_assoc()) {
                    // Append each item to the items string
                    $this->items .= "<tr>
                        <td>{$data2['itemName']}</td>
                        <td>{$data2['itemPrice']}</td>
                        <td>{$data2['quantity']}</td>
                        <td>{$data2['amount']}</td>
                    </tr>";
                }
            } else {
                $this->items = "<tr><td colspan='4'>No items found for this invoice.</td></tr>";
            }
        } else {
            echo "Invoice ID is missing.";
        }
    }
}

$obj = new invoice_pdf();
$obj->data();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .header {
            text-align: center;
            padding-bottom: 50px;
        }

        .items_table {
            width: 700px;
            margin-top: 20px;
            text-align: center;
            border: 2px solid black;
            border-collapse: collapse;
        }

        .th {
            background-color: gray;
            border: 1px solid black;
        }

        .amount_details {
            margin-left: 500px;
            margin-top: 30px;
        }

        p {
            text-align: center;
        }

        small {
            /* color: lightblue; */
            margin: 5px;
        }

        img {
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
                    <span>419, 4th Floor, M3M Urbana, Sector 67,</span><br>
                    <span>Gurugram, Haryana 122018</span>
                </td>
            </tr>

            <tr>
                <td style="width: 550px;">
                    <div>
                        <span><b>Customer:</b></span><br>
                        <span>Name:</span><small><?php echo $obj->name; ?></small><br>
                        <span>Email:</span><small><?php echo $obj->email; ?></small><br>
                        <span>Mobile Number:</span><small><?php echo $obj->phone; ?></small><br>
                        <span>Address:</span><small><?php echo $obj->address; ?></small>
                    </div>
                </td>
                <td>
                    <div>
                        <h2>INVOICE</h2>
                        <span>Invoice No:</span><span><?php echo $obj->invoice_no; ?></span><br>
                        <span>Date:</span><small><?php echo $obj->invoice_date; ?></small>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

    <table class="items_table">
        <tbody>
            <tr class="th">
                <td>Item</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>SubTotal</td>
            </tr>
            <?php echo $obj->items; ?>
        </tbody>
    </table>

    <div class="amount_details">
        <span><b class="Total-amount">Subtotal amount:</b><small><?php echo $obj->total_amount; ?></small></span><br>
        <span><b class="Total-amount">Total amount:</b><small><?php echo $obj->total_amount; ?></small></span>
    </div>

    <p>THANK YOU</p>

    <?php include("../footer.php"); ?>

</body>
</html>
