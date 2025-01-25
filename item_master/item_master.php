<?php include("../header.php"); ?>
<?php
// session_start();
// if (empty($_SESSION['username'])) {
//    header("Location:http://localhost/First_Project/login-2-main/login2.php");
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
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Item</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add item</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="client-master">

                            <div class="row  input-div ">
                                <form name="getformdata" class="filter-div" id="filter_form">

                                    <div class="col-1.5">
                                        <label for="name">Item Name:</label>
                                        <input type="text" class="form-control" Name='itemName' maxlength="20">
                                    </div>

                                    <div class="col-1">
                                        <button type="reset" class=" mt-3" id="reset">Reset</button>
                                    </div>
                                    <input type="hidden" id="page_no" value="1" name="page">
                                    <input type="hidden" id="row_no" value="2" name="row">


                                </form>
                            </div>


                            <div class="getlist">

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
                                                <th id='itemName' class="changeIcon">
                                                    Item Name <i  class="bi-arrow-down-up"></i>
                                                </th>
                                                <th id='itemPrice' class="changeIcon">
                                                    Item Price <i class="bi-arrow-down-up"></i>
                                                </th>
                                                <th>Item Description</th>

                                                <th>Item image</th>


                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                      
                                        <tbody id='tbody'>

                                        </tbody>

                                    </table>



                                </div>


                                <!-- <div class="pagination"> -->

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="input-div add-item">
                            <form class="row g-3" id="formdata" name="form" enctype="multipart/form-data">
                                <div class="col-2">
                                    <label for="inputitem" class="form-label">Item Name:</label>
                                    <input type="text" class="form-control" name="itemName" id="inputitem" maxlength="20">
                                    <span></span>
                                </div>
                                <div class="col-md-2 price">
                                    <label for="inputprice" class="form-label ">Item Price:</label>
                                    <input type="text" class="form-control price" name="itemPrice" id="inputprice" maxlength="10">
                                    <span></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputd" class="form-label ">Item Description:</label>
                                    <textarea class="form-control " name="itemD" id="inputd" maxlength="200" cols="50" rows="1"></textarea>
                                    <span></span>
                                </div>
                                <div class="col-2">
                                    <label for="image" class="form-label">Item Image</label>

                                    <input type="file" class="form-control" name="fileUpload" id="image" onChange="imgDicShow()" oninput="pic.src=window.URL.createObjectURL(this.files[0]) " accept="image/png, image/gif, image/jpeg" />
                                    <span></span>

                                </div>

                                <div class="col-1" id="show-img">
                                    <img src="" id="pic" alt="">

                                </div>


                                <div class="col-2">
                                    <input type="hidden" name="id" value="">
                                    <button type="button" id="submit">Add</button>
                                    <button type="button" id="update">Update</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>

            <?php include("../footer.php"); ?>