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
//status == 1 == missing field
if(!empty($_POST)){

  if (empty($_POST['title'])){

    header("Location: requestproject.php?status=1");
    die();

  }
  if (empty($_POST['budget'])){

    header("Location: requestproject.php?status=1");
    die();

  }
  if (empty($_POST['deadline'])){

    header("Location: requestproject.php?status=1");
    die();

  }
  if (empty($_POST['brief'])){

    header("Location: requestproject.php?status=1");
    die();

  }

  $title = escape($_POST['title']);
  $budget = escape($_POST['budget']);
  $deadline = escape($_POST['deadline']);
  $brief = escape($_POST['brief']);

  $query = $db->prepare("SELECT * FROM `user` WHERE `email` = '$useremail'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $name = escape($row['name']);

  }

  $query = $db->prepare("INSERT INTO `projects`(`title`, `brief`, `deadline`, `budget`, `name`, `email`) VALUES ('$title','$brief','$deadline','$budget','$name','$useremail')");
  $query->execute();
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
      <?php
      if(!empty($_GET)){

        $status = escape($_GET['status']);

        if(empty($_GET['status'])){
          die();
        }

        if($status == 1){

          echo '<div class="alert alert-warning" role="alert">
          Project Error, Please check your information and re-submit.
          </div>';

        }

      }


        ?>



        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Request A Project.</h4>
          </div>

        </div>

        

        <div class="row">
          <div class="col-12 col-xl-6 grid-margin stretch-card">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                  <h6 class="card-title mb-0">Project Information</h6>
                  
                </div>
                <form action="requestproject.php" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Project Title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Budget</label>
                    <input type="text" class="form-control" name="budget" placeholder="$100.00">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deadline</label>
                    <input type="text" class="form-control" name="deadline" placeholder="01-01-1970">
                  </div>

                </div>
              </div>
            </div>
            <div class="col-12 col-xl-6 grid-margin stretch-card">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">Project Brief</h6>

                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="brief" id="exampleFormControlTextarea1" rows="30"></textarea>
                  </div>

                  <button type="submit" class="btn btn-primary text-white mr-2 mb-2 mb-md-0">
                   Submit
                 </button>
               </div>
             </div>
           </div>
         </div>
       </div> <!-- row -->
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