<?php include("../header.php"); ?>
<?php
// session_start();
// if (empty($_SESSION['username'])) {
//     header("Location:http://localhost/First_Project/login-2-main/login2.php");
// }
?>

<body>

    <div class="main-container-wrapper">

        <div class="main-nav-bar">
            <?php include_once("../navbar.php") ?>
        </div>

        <div class="detail-container">
            <div class="sidebar">
                <?php include_once("../sidebar.php") ?>
            </div>
            <div class="content">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Invoice</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add Invoice</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="client-master">

                            <div class="row  input-div ">
                                <form name="getformdata" class="filter-div" id="filter_form">
                                    <div class="col-1">
                                        <label for="id">Invoice No:</label>
                                        <input type="text" class="form-control numeric" name="invoice_no">
                                    </div>
                                    <div class="col-1.5">
                                        <label for="name">Client Name:</label>
                                        <input type="text" class="form-control" Name='name'>
                                    </div>
                                    <div class="col-1.5">
                                        <label for="phone">Phone:</label>
                                        <input type="text" class="form-control numeric" name="phone">
                                    </div>
                                    <div class="col-1.5">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control " name="email">
                                    </div>
                                    <div class="col-1.5">
                                        <label for="invoice_date">Invoice Date</label>
                                        <input type="date" class="form-control " name="invoice_date" id='invoice_date'>
                                    </div>

                                    <div class="col-1">
                                        <button type="button" class=" mt-3" id="reset">Reset</button>
                                    </div>
                                    <input type="hidden" id="page_no" value="1" name="page">
                                    <input type="hidden" id="row_no" value="2" name="row">
                                </form>
                            </div>


                            <div class="getlist invoice_list">

                                <div class="pagination">
                                    <div class="selectrow">

                                        <select id='row'>

                                            <option value='2'>2</option>
                                            <option value='3'>3</option>
                                            <option value='10'>10</option>
                                        </select>
                                    </div>
                                    <div class='page'>
                                    </div>
                                </div>
                                <div class="list">


                                    <table class='table table-bordered'>

                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <!-- <th><img class='asc' id='id' src='../images/arrow-up (1).svg'><img class='desc' id='id' src='../images/arrow-down.svg'>Invoice Id</th> -->
                                                <th><img class='asc' id='name' src='../images/arrow-up (1).svg'><img class='desc' id='name' src='../images/arrow-down.svg'>Invoice No</th>
                                                <th><img class='asc' id='phone' src='../images/arrow-up (1).svg'><img class='desc' id='phone' src='../images/arrow-down.svg'>Invoice Date</th>
                                                <th><img class='asc' id='email' src='../images/arrow-up (1).svg'><img class='desc' id='email' src='../images/arrow-down.svg'>client Name</th>
                                                <th>address</th>
                                                <th><img class='asc' id='state_name' src='../images/arrow-up (1).svg'><img class='desc' id='state_name' src='../images/arrow-down.svg'>Client Email</th>
                                                <th><img class='asc' id='district_name' src='../images/arrow-up (1).svg'><img class='desc' id='district_name' src='../images/arrow-down.svg'>Client Phone</th>
                                                <th>Total</th>
                                                <th>PDF</th>
                                                <th>Email</th>

                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody'>
                                            <tr>
                                                <td>{$offset}</td>
                                                <td>{$row['invoice_no']}</td>
                                                <td>$date</td>
                                                <td class='edit-btn' data-id={$row['invoice_id']}>{$row['name']}</td>
                                                <td>{$row['address']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['phone']}</td>
                                                <td>₹{$row['total_amount']}</td>
                                                <td><a href='http://localhost/First_Project/invoice/pdf.php?id={$row[' invoice_id']}'><i class='bi bi-file-earmark-pdf-fill text-danger pdf'></i></a></td>
                                                <td data-bs-toggle='modal' data-bs-target='#staticBackdrop'><i data-bs-toggle="modal" data-bs-target="#exampleModal" class='bi bi-envelope-fill text-primary'></i></td>
                                                <td><button class='btn  edit-btn p-0' data-id={$row['invoice_id']}><img src='../images/edit (1).svg'></button></td>
                                                <td><button class=' btn  p-0 delete-btn' data-id={$row['invoice_id']}><img src='../images/trash (1).svg'></button></td>
                                            </tr>
                                        </tbody>

                                    </table>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <!-- <div class="pagination"> -->

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form class="" id="formdata" name="form">
                            <div class="add-invoice">


                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="invoice" class="form-label">Invoice No:</label>
                                        <input type="text" class="form-control invoic" name="invoice_no" id="invoice" maxlength="15" readonly>
                                        <input type="hidden" class="invoice_id" name="invoice_id" value="">
                                    </div>
                                    <div class="col-3">
                                        <label for="invoice_date" class="form-label">Invoice Date:</label>
                                        <input type="text" class="form-control" name="invoice_date" id="invoice_date2" readonly>

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <label for="client_name" class="form-label ">Client Name:</label>
                                        <input type="text" class="form-control clients" name="name" id="client_name" maxlength="12" autocomplete="off">
                                        <input type="hidden" class="clientId" name="client_id" value="">
                                    </div>


                                    <div class="col-md-3">
                                        <label for="inputphone" class="form-label">Phone:</label>
                                        <input type="text" class="form-control numeric" id="inputphone" maxlength="12" name="phone" readonly>

                                    </div>

                                    <div class="col-md-3">
                                        <label for="inputemail" class="form-label ">Email:</label>
                                        <input type="email" class="form-control " id="inputemail" name="email" maxlength="20" readonly>

                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputAddress" class="form-label">Address:</label>
                                        <input type="text" class="form-control" id="inputAddress" name="address" maxlength="50" readonly>

                                    </div>


                                </div>








                            </div>
                            <div class="add-invoice  add-new row">


                                <div class="clone-row row clone">
                                    <!-- <form action="" class="row" id="" name="client_invoice"> -->
                                    <div class="col-3">
                                        <label for="input" class="form-label">Item Name:</label>

                                        <input type="text" class="form-control inputitem" id="input" maxlength="20">
                                        <input type="hidden" class="item_id" name="item_id[]">
                                    </div>
                                    <div class="col-md-3 price">
                                        <label for="inputprice" class="form-label">Item Price:</label>
                                        <input type="text" class="form-control price right" id="inputprice" maxlength="10" oninput="amount()" readonly>

                                    </div>
                                    <div class="col-2">
                                        <label for="item" class="form-label">Quantity:</label>
                                        <input type="number" class="form-control Item right" name="quantity[]" id="item" maxlength="20" minlength="1" value="0">
                                    </div>
                                    <div class="col-md-2 price">
                                        <label for="amount" class="form-label">Amount:</label>
                                        <input type="text" class="form-control Amount right" name="amount[]" id="" readonly>

                                    </div>
                                    <button type="button" class="m-4 bg-danger delete-item"><i class="bi bi-x-lg text-light"></i></button>



                                </div>

                            </div>
                            <div class="add-more ">
                                <button type="button" class="btn bg-primary text-light" id="add-more">Add More</button>
                                <div>
                                    <label for="">Total Amount</label>
                                    <input type="text" class="form-control right" id="total-amount" name="total_amount" readonly>
                                </div>
                            </div>
                            <button type="button" class=" btn bg-theme text-light" id="invoice_submit">Submit</button>
                            <button type="button" class=" btn bg-theme text-light" id="update">Update</button>

                        </form>
                    </div>

                </div>

                <!-- Button trigger modal -->

                <?php include("../footer.php"); ?>