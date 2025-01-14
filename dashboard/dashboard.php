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
         <div class="content ">
            <div class="dashboard-container">

               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/usermaster/usermaster.php" class="btn ">
                     <div class="card-body">
                        <h5 class="card-title">USER MASTER</h5>
                     </div>
                  </a>


               </div>
               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/clientmaster/client_master.php" class="btn ">
                     <div class="card-body">
                        <h5 class="card-title">CLIENT MASTER</h5>
                     </div>
                  </a>

               </div>
               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/item_master/item_master.php" class="btn">
                     <div class="card-body">
                        <h5 class="card-title">ITEM MASTER</h5>
                     </div>
                  </a>

               </div>
               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/invoice/invoice.php" class="btn ">
                     <div class="card-body">
                        <h5 class="card-title">INVOUICE MASTER</h5>
                     </div>
                  </a>

               </div>
            </div>
            <div class="dasboaerd-img">
     <img src="../images/dashboard.avif" alt="">
            </div>
         </div>

      </div>

   </div>

   <?php include("../footer.php"); ?>