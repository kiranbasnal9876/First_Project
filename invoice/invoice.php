<?php include("../header.php"); ?>


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
                                        <input type="number" class="form-control numeric" name="invoice_no">
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
                                        <input type="date" class="form-control " name="invoice_date" id=''>
                                    </div>

                                    <div class="col-1">
                                        <button type="reset" class=" mt-3" id="reset">Reset</button>
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
                                               
                                                <th class="changeIcon" id='invoice_no'> <i  class="bi-arrow-down-up"></i>Invoice No</th>
                                                <th class="changeIcon"  id='invoice_date'> <i  class="bi-arrow-down-up"></i>Invoice Date</th>
                                                <th class="changeIcon" id='name'> <i  class="bi-arrow-down-up"></i>client Name</th>
                                                <th>address</th>
                                                <th class="changeIcon" id='email'> <i  class="bi-arrow-down-up"></i>Client Email</th>
                                                <th class="changeIcon" id='phone'> <i  class="bi-arrow-down-up"></i>Client Phone</th>
                                                <th>Total</th>
                                                <th>PDF</th>
                                                <th>Email</th>

                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody'>

                                        </tbody>

                                    </table>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Email</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="email_form" id="email-model-form">
                                                        <div class="mb-3 ">
                                                            <label for="sender-name" class="text-start">Sender:</label>
                                                            <input type="text" class="form-control" id="sender-name" placeholder="dimpalbasnal0@gmail.com" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="send_to" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Subject:</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="subject">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Message:</label>
                                                            <textarea class="form-control" id="message-text" name="content"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                           <a href="" id="pdf_link">Pdf</a>
                                                           <input type="hidden" value="" id="invoice_no_for_pdf" name='pdf_invoice'>
                                                        </div>
                                                        

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Close</button>
                                                    <button type="button" class="btn btn-primary" id="send_email">Send message</button>
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
                                        <label for="invoice" class="form-label">Invoice No<span>*</span></label>
                                        <input type="text" class="form-control invoic" name="invoice_no" id="invoice" maxlength="15" >
                                        <span></span>
                                        <input type="hidden" class="invoice_id" name="invoice_id" value="">
                                        
                                    </div>
                                    <div class="col-3">
                                        <label for="invoice_date" class="form-label">Invoice Date<span>*</span></label>
                                        <input type="text" class="form-control" name="invoice_date" id="invoice_date2" >
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <label for="client_name" class="form-label ">Client Name<span>*</span></label>
                                        <input type="text" class="form-control clients" name="name" id="client_name" maxlength="12" autocomplete="off">
                                        <span></span>
                                        <input type="hidden" class="clientId" name="client_id" value="">
                                        
                                    </div>


                                    <div class="col-md-3">
                                        <label for="inputphone" class="form-label">Phone<span>*</span></label>
                                        <input type="text" class="form-control numeric" id="inputphone" maxlength="12" name="phone" readonly>

                                    </div>

                                    <div class="col-md-3">
                                        <label for="inputemail" class="form-label ">Email<span>*</span></label>
                                        <input type="email" class="form-control " id="inputemail" name="email" maxlength="20" readonly>

                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputAddress" class="form-label">Address<span>*</span></label>
                                        <input type="text" class="form-control" id="inputAddress" name="address" maxlength="50" readonly>

                                    </div>


                                </div>


                            </div>
                            <div class="add-invoice  add-new row">


                                <div class="clone-row row clone">
                                    <!-- <form action="" class="row" id="" name="client_invoice"> -->
                                    <div class="col-3">
                                        <label for="input" class="form-label">Item Name<span>*</span></label>

                                        <input type="text" class="form-control inputitem" id="input" maxlength="20" onchange="amount()">
                                        <span></span>
                                        <input type="hidden" class="item_id" name="item_id[]">
                                       
                                    </div>
                                    <div class="col-md-3 price">
                                        <label for="inputprice" class="form-label">Item Price<span>*</span></label>
                                        <input type="text" class="form-control price right" id="inputprice" maxlength="10" oninput="amount()" readonly>

                                    </div>
                                    <div class="col-2">
                                        <label for="item" class="form-label">Quantity<span>*</span></label>
                                        <input type="number" class="form-control numeric Item right" name="quantity[]" id="item" maxlength="5" minlength="1"  min="1"  oninput="amount()" required>
                                    </div>
                                    <div class="col-md-2 price">
                                        <label for="amount" class="form-label">Amount<span>*</span></label>
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