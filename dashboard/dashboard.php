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
                     <div class="card-body" id="users">

                     </div>
                  </a>


               </div>
               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/clientmaster/client_master.php" class="btn ">
                     <div class="card-body" id="client">
                        <h6 class="card-title">CLIENT MASTER</h6>
                     </div>
                  </a>

               </div>
               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/item_master/item_master.php" class="btn">
                     <div class="card-body" id="items">
                        <h5 class="card-title">ITEM MASTER</h5>
                     </div>
                  </a>

               </div>
               <div class="card" style="width: 18rem;">
                  <!-- <img src="..." class="card-img-top" alt="..."> -->

                  <a href="http://localhost/First_Project/invoice/invoice.php" class="btn ">
                     <div class="card-body" id="invoice_detail">
                        <h5 class="card-title">INVOUICE MASTER</h5>
                     </div>
                  </a>

               </div>
            </div>
            <!-- <div class="dasboaerd-img">
            <img src="../images/dashboard.png" alt="">
            </div> -->
            <div class="mt-4">
               <div class="card flex-fill w-100 draggable">
                  <div class="card-header">
                     <h5 class="card-title mb-0">Sales chart</h5>
                  </div>
                  <div class="card-body py-3">
                     <div class="chart chart-sm">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <canvas id="chartjs-dashboard-line" style="display: block; height: 252px; width: 428px;" width="856" height="504" class="chart-line chartjs-render-monitor"></canvas>
                     </div>
                  </div>
               </div>


            </div>
         </div>

      </div>

   </div>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <?php include("../footer.php"); ?>