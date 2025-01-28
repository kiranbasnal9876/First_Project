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
                                    <input type="number" class="form-control numeric" maxlength="3" name="id" id="client_id">
                                </div>
                                <div class="col-1.5">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" Name='name'>
                                </div>
                                <div class="col-1.5">
                                    <label for="phone">Phone:</label>
                                    <input type="number" class="form-control numeric" name="phone">
                                </div>
                                <div class="col-1.5">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control " name="email">
                                </div>
                              
                                <div class="col-1.5">
                                    <label for="Dis_input">Address:</label>
                                    <input type="text" class="form-control" name="address">
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
                                                <th class="changeIcon" id='id'><i  class="bi-arrow-down-up"></i>ID</th>
                                                <th class="changeIcon"  id='name'><i  class="bi-arrow-down-up"></i>Name</th>
                                                <th class="changeIcon" id='phone'><i  class="bi-arrow-down-up"></i>Phone</th>
                                                <th class="changeIcon" id='email'><i  class="bi-arrow-down-up"></i>Email</th>
                                                <th >address</th>
                                               

                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody'>
                                            
                                        </tbody>

                                    </table>



                                </div>


                                

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="add-client">
                            <form class="row g-3" id="formdata" name="form">
                                <div class="col-3">
                                    <label for="inputAddress2" class="form-label">Client Name<span>*</span></label>
                                    <input type="text" class="form-control" name="name" id="inputAddress2" maxlength="15">
                                    <span></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputEmail4" class="form-label">Email<span>*</span></label>
                                    <input type="email" class="form-control" name="email" id="inputEmail4">
                                    <span></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPassword4" class="form-label ">Phone<span>*</span></label>
                                    <input type="text" class="form-control numeric" name="phone" id="inputPassword4" maxlength="12">
                                    <span></span>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress" class="form-label">Address<span>*</span></label>

                                    <input type="text" class="form-control" name="address" id="inputAddress" maxlength="50">
                                    <span></span>

                                </div>


                                <div class="col-md-3">
                                    <label for="inputState" class="form-label">State<span>*</span></label>
                                    <select id="inputState" class="form-select" name="state_id">
                                        <option name="state_name" value="">select</option>

                                        <?php
                                      class get_states{

                                        private $con;
                                          
                                      function __construct()
                                      {  
                                          include("../dbcon.php");
                                          $connection = new dbcon();
                                          $this->con=$connection->con;
                                      }
                                      function states(){
                                        $sql = "select * from state_master";

                                        $result = $this->con->query($sql);

                                        while ($data = $result->fetch_array()) {
                                            echo "<option value='{$data[0]}'>{$data[1]}</option>";
                                        }
                                      }
                                       
                                    }

                                    $obj= new get_states();
                                    $obj->states();
                                        ?>
                                    </select>
                                    <span></span>

                                </div>

                                <div class="col-md-3">
                                    <label for="input_district" class="form-label">District<span>*</span></label>
                                    <select id="input_district" class="form-select" name="district_id">
                                        <option id="option" name="district_name"  value="">select</option>
                                         
                                    </select>
                                    <span></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label ">Pin Code<span>*</span></label>
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