<?php
require("inc/connect.php");
checklogin();
$useremail = escape($_SESSION["thesesh"]);


$query = $db->prepare("SELECT * FROM `user` WHERE `email` = '$useremail'");
$query->execute();
$result = $query -> fetchAll();
foreach( $result as $row ) {

  $isstaff = escape($row['staff']);

}

if ($isstaff != 1){

  header("Location: myprojects.php");
  die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
  <!-- core:css -->
  <link rel="stylesheet" href="assets/vendors/core/core.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- Layout styles -->  
  <link rel="stylesheet" href="assets/css/demo_1/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
  <div class="main-wrapper">

   <!-- partial:partials/_sidebar.html -->

   <?php

   require('sidebar.php');

   ?>


   <div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Welcome to Invoice Dashboard</h4>
      </div>
      
    </div>

    <div class="row">
      <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Pending Invoices</h6>
                  <div class="dropdown mb-2">


                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>


                    <?php

                    $query = $db->prepare("SELECT COUNT(1) FROM `projects` WHERE 1");
                    $query->execute();
                    $result = $query -> fetchAll();
                    foreach( $result as $row ) {

                      $totalprojects = escape($row['COUNT(1)']);

                    }

                    ?>


                    <h3 class="mb-2"><?php echo $totalprojects;?></h3>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Unpaid Invoices</h6>
                  <div class="dropdown mb-2">

                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>

                    <?php

                    $query = $db->prepare("SELECT COUNT(1) FROM `projects` WHERE `status` = 0");
                    $query->execute();
                    $result = $query -> fetchAll();
                    foreach( $result as $row ) {

                      $totalpendingprojects = escape($row['COUNT(1)']);

                    }

                    ?>
                    <h3 class="mb-2"><?php echo $totalpendingprojects;?></h3>

                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Paid Invoices</h6>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <?php

                    $query = $db->prepare("SELECT COUNT(1) FROM `projects` WHERE `status` = 3");
                    $query->execute();
                    $result = $query -> fetchAll();
                    foreach( $result as $row ) {

                      $totalcompletedprojects = escape($row['COUNT(1)']);

                    }

                    ?>
                    <h3 class="mb-2"><?php echo $totalcompletedprojects; ?></h3>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">All Invoices</h6>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Budget</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Project Status</th>
                    <th>Invoice Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  <?php


                  $query = $db->prepare("SELECT * FROM `projects` WHERE 1 ORDER BY `id` DESC");
                  $query->execute();
                  $result = $query -> fetchAll();
                  foreach( $result as $row ) {

                    $projid = escape($row['id']);
                    $projtitle = escape($row['title']);
                    $projbudget = escape($row['budget']);
                    $projdeadline = escape($row['deadline']);
                    $projstatus = escape($row['status']);
                    $projname = escape($row['name']);
                    $projemail = escape($row['email']);
                    $projstatus = escape($row['status']);
                    $projinvoice = escape($row['invoicecreated']);

                    echo '<tr>';
                    echo '<td>' . $projid . '</td>';
                    echo '<td>' . $projtitle . '</td>';
                    echo '<td>$' . $projbudget . '</td>';
                    echo '<td>' . $projname . '</td>';
                    echo '<td>' . $projemail . '</td>';

                    if($projstatus == 0){
                      echo '<td><span class="badge badge-pill badge-info">Pending</span></td>';
                    } elseif ($projstatus == 3){

                      echo '<td><span class="badge badge-pill badge-success">Completed</span></td>';
                    } elseif($projstatus == 1){
                      echo '<td><span class="badge badge-pill badge-primary">In Progress</span></td>';
                    }

                    if($projinvoice == 0){
                      echo '<td><span class="badge badge-pill badge-info">Pending</span></td>';
                    } elseif ($projinvoice == 2){

                      echo '<td><span class="badge badge-pill badge-success">Paid</span></td>';
                    } elseif($projinvoice == 1){
                      echo '<td><span class="badge badge-pill badge-danger">UnPaid</span></td>';
                    }

                    echo '<td>';

                      if($projinvoice != 0){
                        echo '<a href="viewinvoice.php?id='.$projid .'"><button type="button" class="btn btn-light btn-xs mb-1 mb-md-0">View</button></a> ';
                      }
echo '<a href="markinvoice.php?id='.$projid .'&status=1"><button type="button" class="btn btn-danger btn-xs mb-1 mb-md-0">Unpaid</button></a> ';
echo '<a href="markinvoice.php?id='.$projid .'&status=2"><button type="button" class="btn btn-success btn-xs mb-1 mb-md-0">Paid</button></a> ';

if($projinvoice == 0){
  echo '<a href="createinvoice.php?id='.$projid .'"><button type="button" class="btn btn-info btn-xs mb-1 mb-md-0">Create Invoice</button></a>';
}

                    
                    echo '</td>';
                    echo '</tr>';    

                  }

                  ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- partial:partials/_footer.html -->
  <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
    <p class="text-muted text-center text-md-left">Copyright © 2020 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>. All rights reserved</p>
    <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
  </footer>
  <!-- partial -->

</div>
</div>

<!-- core:js -->
<script src="assets/vendors/core/core.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="assets/vendors/chartjs/Chart.min.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
<script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/datepicker.js"></script>
<!-- end custom js for this page -->
</body>
</html>    