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
if(!empty($_GET)){

  if(empty($_GET['id'])){
    header("Location: myinvoices.php");
    die();
  } else {

    $projectid = escape($_GET['id']);

    $query = $db->prepare("SELECT * FROM `invoice` WHERE `projectid` = '$projectid'");
    $query->execute();
    $result = $query -> fetchAll();
    foreach( $result as $row ) {

      $invoiceid = escape($row['id']);
      $projid = escape($row['projectid']);
      $projecttitle = escape($row['projecttitle']);
      $projectbudget = escape($row['budget']);
      $projectname = escape($row['name']);
      $projectnum = escape($row['number']);
      $projectemail = escape($row['email']);
      $projectinvoicestatus = escape($row['status']);
    //need to get number
    }



  }

} else {

  header("Location: myinvoices.php");
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

		<?php

    require('sidebar.php');

    ?>

    <div class="page-content">

      <nav class="page-breadcrumb">

      </nav>

      <div class="row">
       <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="container-fluid d-flex justify-content-between">
              <div class="col-lg-3 pl-0">
                <a href="#" class="noble-ui-logo d-block mt-3">Business<span>Name</span></a>                 
                <p class="mt-1 mb-1"><b>Business Name</b></p>
                <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>
                <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                <p><?php echo $projectname;?><br><?php echo $projectemail;?><br><?php echo $projectnum;?></p>
              </div>
              <div class="col-lg-3 pr-0">
                <h4 class="font-weight-medium text-uppercase text-right mt-4 mb-2">invoice</h4>
                <h6 class="text-right mb-5 pb-4"># INV-<?php echo $invoiceid;?></h6>
                <p class="text-right mb-1">Balance Due</p>
                <h4 class="text-right font-weight-normal">$ <?php echo $projectbudget;?></h4>
              </div>
            </div>
            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
              <div class="table-responsive w-100">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th class="text-right">Unit cost</th>
                      <th class="text-right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="text-right">
                      <td class="text-left">1</td>
                      <td class="text-left"><?php echo $projecttitle; ?></td>
                      <td><?php echo $projectbudget;?></td>
                      <td><?php echo $projectbudget;?></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <div class="container-fluid mt-5 w-100">
              <div class="row">
                <div class="col-md-6 ml-auto">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Sub Total</td>
                          <td class="text-right">$<?php echo $projectbudget;?></td>
                        </tr>
                        <tr>
                          <td class="text-bold-800">Total</td>
                          <td class="text-bold-800 text-right"> $<?php echo $projectbudget;?></td>
                        </tr>
                        <tr class="bg-light">
                          <?php 
                          if($projectinvoicestatus == 2){
                            echo '<td class="text-bold-800">Balance Due</td>
                          <td class="text-bold-800 text-right">$ 00.00</td>';
                          } else {
                            echo '<td class="text-bold-800">Balance Due</td>
                          <td class="text-bold-800 text-right">$ '.$projectbudget.'</td>';
                          }

                          ?>
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="container-fluid w-100">
              <a href="#" class="btn btn-primary float-right mt-4 ml-2"><i data-feather="send" class="mr-3 icon-md"></i>Pay Invoice</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- partial:../../partials/_footer.html -->
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
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<!-- end custom js for this page -->
</body>
</html>