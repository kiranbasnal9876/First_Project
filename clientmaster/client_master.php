<?php include("../header.php"); ?>
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
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Client</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add client</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="client-master">

                            <div class="row  input-div ">
                                <form name="getformdata" class="filter-div" id="filter_form">
                                <div class="col-1">
                                    <label for="id">Id:</label>
                                    <input type="text" class="form-control numeric" maxlength="3" name="id">
                                </div>
                                <div class="col-1.5">
                                    <label for="name">Name:</label>
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
                                    <label for="State_Input">State</label>
                                    <input type="text" class="form-control " name="state" id='State_Input'>
                                </div>
                                <div class="col-1.5">
                                    <label for="Dis_input">District:</label>
                                    <input type="text" class="form-control" name="district">
                                </div>

                                <div class="col-1">
                                    <button type="button" class=" mt-3" id="reset">Reset</button>
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
                                                <th ><img class='asc' id='id' src='../images/arrow-up (1).svg'><img class='desc' id='id' src='../images/arrow-down.svg'>ID</th>
                                                <th ><img class='asc' id='name' src='../images/arrow-up (1).svg'><img class='desc' id='name' src='../images/arrow-down.svg'>Name</th>
                                                <th ><img class='asc' id='phone' src='../images/arrow-up (1).svg'><img class='desc' id='phone' src='../images/arrow-down.svg'>Phone</th>
                                                <th ><img class='asc' id='email' src='../images/arrow-up (1).svg'><img class='desc' id='email' src='../images/arrow-down.svg'>Email</th>
                                                <th>address</th>
                                                <th ><img class='asc' id='state_name' src='../images/arrow-up (1).svg'><img class='desc' id='state_name' src='../images/arrow-down.svg'>Sate</th>
                                                <th ><img class='asc' id='district_name' src='../images/arrow-up (1).svg'><img class='desc' id='district_name' src='../images/arrow-down.svg'>District</th>
                                                <th >pincode</th>

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
                        <div class="add-client">
                            <form class="row g-3" id="formdata" name="form">
                                <div class="col-3">
                                    <label for="inputAddress2" class="form-label">Client Name:</label>
                                    <input type="text" class="form-control" name="name" id="inputAddress2" maxlength="15">
                                    <span></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputEmail4" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="inputEmail4">
                                    <span></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPassword4" class="form-label ">Phone:</label>
                                    <input type="text" class="form-control numeric" name="phone" id="inputPassword4" maxlength="12">
                                    <span></span>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress" class="form-label">Address</label>

                                    <input type="text" class="form-control" name="address" id="inputAddress" maxlength="50">
                                    <span></span>

                                </div>


                                <div class="col-md-3">
                                    <label for="inputState" class="form-label">State</label>
                                    <select id="inputState" class="form-select" name="state_id">
                                        <option name="state_name" value="">select</option>

                                        <?php
                                        require_once("../dbcon.php");
                                        $sql = "select * from state_master";

                                        $result = $con->query($sql);

                                        while ($data = $result->fetch_array()) {
                                            echo "<option value='{$data[0]}'>{$data[1]}</option>";
                                        }

                                        ?>
                                    </select>
                                    <span></span>

                                </div>

                                <div class="col-md-3">
                                    <label for="input_district" class="form-label">District</label>
                                    <select id="input_district" class="form-select" name="district_id">
                                        <option id="option" name="district_name"  value="">select</option>
                                         
                                    </select>
                                    <span></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label ">Pin Code</label>
                                    <input type="text" class="form-control numeric" name="pincode" id="inputZip" maxlength="6">
                                    <span></span>
                                </div>

                                <input type="hidden" name="id" value="">

                                <div class="col-12">

                                    <button type="button" id="submit">Add</button>
                                    <button type="button" id="update">Update</button>
                                </div>
                            </form>
                           
                        </div>
                    </div>

                </div>

            </div>

            <?php include("../footer.php"); ?>