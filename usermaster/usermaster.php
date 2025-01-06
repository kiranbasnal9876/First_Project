<?php include("../header.php"); 
 ?>

<?php
session_start();
if (empty($_SESSION['username'])) {
   header("Location:http://localhost/First_Project/login-2-main/login2.php");
}
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
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add User</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="usermaster">

                            <div class="row input-div">
                                <div class="col-2 ">
                                    <label for="id">Id:</label>
                                    <input type="text" class="form-control numeric search" maxlength="3">
                                </div>
                                <div class="col-2">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control search" maxlength="15">
                                </div>
                                <div class="col-2">
                                    <label for="phone">Phone:</label>
                                    <input type="text" class="form-control numeric search" maxlength="12">
                                </div>
                                <div class="col-2">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control search">
                                </div>

                                <div class="col-2">
                                    <button type="button" class=" mt-3" id="reset">Reset</button>
                                </div>
                            </div>


                            <div class="getlist">
                                <input type="hidden" id="page_no" value="1">
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
                                                <th ><img class='asc' id='id' src='../images/arrow-up (1).svg'><img class='desc' id='id' src='../images/arrow-down.svg'>ID</th>
                                                <th ><img class='asc' id='create_by' src='../images/arrow-up (1).svg'><img class='desc' id='create_by' src='../images/arrow-down.svg'>Name</th>
                                                <th ><img class='asc' id='create_by' src='../images/arrow-up (1).svg'><img class='desc' id='create_by' src='../images/arrow-down.svg'>Phone</th>
                                                <th><img class='asc' id='email' src='../images/arrow-up (1).svg'><img class='desc' id='email' src='../images/arrow-down.svg'>Email</th>
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

                        <div class="row input-div">

                            <div class="col-2">
                                <label for="Name">Name:</label>
                                <input type="text" class="form-control" id="Name" name="name" maxlength="20">
                                <span id="log_er2"></span>
                            </div>
                            <div class="col-2">
                                <label for="Phone">Phone:</label>
                                <input type="text" class="form-control numeric" id="Phone" name="phone" maxlength="12">
                                <span id="log_er3"></span>
                            </div>
                            <div class="col-2">
                                <label for="inputemail">Email:</label>
                                <input type="email" class="form-control" id="inputemail" name="email" maxlength="20">
                                <span id="log_er1"></span>
                            </div>
                            <div class="col-2">
                                <label for="inputPassword">Password:</label>
                                <input type="password" class="form-control" id="inputPassword" name="password" value="">

                                <span id="log_er"></span>

                            </div>
                            <input type="hidden" id="pass" value="">
                            <input type="hidden" id="id" value="">
                            <div class="col-2">
                                <button type="button" class=" mt-3" id="insert-btn">Add</button>
                                <button type="button" class=" mt-3" id="update-btn">Update</button>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

    <?php include("../footer.php"); ?>