<?php
require("inc/connect.php");
checklogin();
$useremail = escape($_SESSION["thesesh"]);
//status == 1 == missing field
error_reporting(0);
$query = $db->prepare("SELECT * FROM `user` WHERE `email` = '$useremail'");
$query->execute();
$result = $query -> fetchAll();
foreach( $result as $row ) {

  $isstaff = escape($row['staff']);

}

if(empty($_GET)){

  header("Location: myprojects.php");
  die();
}

if(!empty($_GET)){

  if(empty($_GET['id'])){

        //$projid = escape($_GET['id']);
    header("Location: myprojects.php");
    die();
  } else {

    $projectid = escape($_GET['id']);

  }


  $query = $db->prepare("SELECT * FROM `projects` WHERE `id` = '$projectid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $projid = escape($row['id']);
    $projtitle = escape($row['title']);
    $projbrief = escape($row['brief']);
    $projdeadline = escape($row['deadline']);
    $projectbudget = escape($row['budget']);
    $projectname = escape($row['name']);
    $projectemail = escape($row['email']);
    $projectstatus = escape($row['status']);
    $projectinvoice = escape($row['invoicecreated']);

  }

  if(strtolower($projectemail) != strtolower($useremail) && $isstaff != 1 ){
    header("Location: myprojects.php");
    die();
  }


  if(empty($_GET['page'])){

    header("Location: viewproject.php?id=$projid&page=info");
    die();

  }

  $pagetoview = escape($_GET['page']);



}

$query = $db->prepare("SELECT * FROM `projectnotes` WHERE `projectid` = '$projectid'");
$query->execute();
$result = $query -> fetchAll();
foreach( $result as $row ) {

  $projectsnotes = escape($row['note']);

}


if(!empty($_POST['submit_1'] )) {


  if(empty($_POST['notes'])){

    header("Location: viewproject.php?id=$projid&page=notes");
    die();

  }

  $newnotes = escape($_POST['notes']);
  

  $query = $db->prepare("SELECT COUNT(1) FROM `projectnotes` WHERE `projectid` = '$projectid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $doesprojectnoteexist = escape($row['COUNT(1)']);

  }

  if($doesprojectnoteexist == 0){

    $query = $db->prepare("INSERT INTO `projectnotes`(`projectid`, `note`) VALUES ('$projectid','$newnotes')");
    $query->execute();
    header("Refresh:0");
  } elseif($doesprojectnoteexist != 0){

    $query = $db->prepare("UPDATE `projectnotes` SET `note`= '$newnotes' WHERE `projectid` = '$projectid'");
    $query->execute();
    header("Refresh:0");

  }

}

if(!empty($_POST['submit_2'] )) {


  if(empty($_POST['tasktitle'])){

    header("Location: viewproject.php?id=$projid&page=tasks");
    die();

  }
  if(empty($_POST['taskdescription'])){

    header("Location: viewproject.php?id=$projid&page=tasks");
    die();

  }

  $tasktoaddtitle = escape($_POST['tasktitle']);
  $taskdesctoadd = escape($_POST['taskdescription']);

  $query = $db->prepare("INSERT INTO `tasks`(`Title`, `Description`, `projectid`) VALUES ('$tasktoaddtitle','$taskdesctoadd','$projectid')");
  $query->execute();


}

if(!empty($_POST['submit_3'] )) {


  if(empty($_POST['Milestonetitle'])){

    header("Location: viewproject.php?id=$projid&page=Milestone");
    die();

  }
  if(empty($_POST['Milestonedescription'])){

    header("Location: viewproject.php?id=$projid&page=Milestone");
    die();

  }

  $Milestonetoaddtitle = escape($_POST['Milestonetitle']);
  $Milestonedesctoadd = escape($_POST['Milestonedescription']);

  $query = $db->prepare("INSERT INTO `milestones`(`Title`, `Description`, `projectid`) VALUES ('$Milestonetoaddtitle','$Milestonedesctoadd','$projectid')");
  $query->execute();


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
          <h4 class="mb-3 mb-md-0">Your Project</h4>
        </div>

      </div>



      <div class="row">
        <div class="col-12 col-xl-12 grid-margin stretch-card">
          <div class="card overflow-hidden">
            <div class="card-body">

             <ul class="nav nav-tabs">
              <li class="nav-item">

                <?php

                if($pagetoview == "info"){
                  echo '<a class="nav-link active" href="viewproject.php?id=' . $projectid . '&page=info">Project Information</a>
                  </li>';

                } else {
                  echo '<a class="nav-link" href="viewproject.php?id=' . $projectid . '&page=info">Project Information</a>
                  </li>';

                }

                ?>
                <li class="nav-item">

                  <?php

                  if($pagetoview == "notes"){

                    echo '<a class="nav-link active" href="viewproject.php?id=' . $projectid . '&page=notes">Notes</a>
                    </li>';

                  } else {
                    echo '<a class="nav-link" href="viewproject.php?id=' . $projectid . '&page=notes">Notes</a>
                    </li>';

                  }

                  ?>

                </li>


                <li class="nav-item">

                  <?php

                  if($pagetoview == "tasks"){

                    echo '<a class="nav-link active" href="viewproject.php?id=' . $projectid . '&page=tasks">Tasks</a>
                    </li>';

                  } else {
                    echo '<a class="nav-link" href="viewproject.php?id=' . $projectid . '&page=tasks">Tasks</a>
                    </li>';

                  }

                  ?>

                </li>

                <li class="nav-item">

                  <?php

                  if($pagetoview == "milestones"){

                    echo '<a class="nav-link active" href="viewproject.php?id=' . $projectid . '&page=milestones">Milestones</a>
                    </li>';

                  } else {
                    echo '<a class="nav-link" href="viewproject.php?id=' . $projectid . '&page=milestones">Milestones</a>
                    </li>';

                  }

                  ?>

                </li>


              </ul>



              <br>

              <?php

              if($pagetoview == "info"){



                echo '            <div class="row">
                <div class="col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Project Information</h6>

                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Title:</label><br>' . $projtitle . '
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Deadline:</label><br>' . $projdeadline . '
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Budget:</label><br>$'.$projectbudget.'
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Client Name:</label><br>'.$projectname.'
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Client Email:</label><br>'.$projectemail.'
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Project Status:</label><br>'; 



                if($projectstatus == 0){
                  echo '<td><span class="badge badge-pill badge-info">Pending</span></td>';
                } elseif ($projectstatus == 3){

                  echo '<td><span class="badge badge-pill badge-success">Completed</span></td>';
                } elseif($projectstatus == 1){
                  echo '<td><span class="badge badge-pill badge-primary">In Progress</span></td>';
                }


                echo '</div>

                <div class="form-group">
                <label for="exampleInputEmail1">Project Invoiced:</label><br>';

                if($projectinvoice == 0){
                  echo '<td><span class="badge badge-pill badge-danger">Pending Invoice</span></td>';
                } elseif ($projectinvoice == 2){

                  echo '<td><span class="badge badge-pill badge-success">Paid</span></td>';
                } elseif($projectinvoice == 1){
                  echo '<td><span class="badge badge-pill badge-primary">Invoiced</span></td>';
                }

                echo '
                </div>
                </div>
                </div>
                </div>

                <div class="col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Brief</h6>

                </div>
                <form action="viewproject.php?id='.$projectid.'" method="post">
                <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="40">'.$projbrief.'</textarea>
                </div>
                </div>
                </div>
                </div>
                </div> ';



              }


              ?>

              <?php



              if($pagetoview == "notes"){


                echo '            <div class="row">


                <div class="col-xl-12 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Write Note</h6>

                </div>
                <form id="form_1" action="viewproject.php?id='.$projectid.'&page=notes" method="post">
                <div class="form-group">
                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="40">'.$projectsnotes.'</textarea>
                </div>
                <input type="submit"  name="submit_1" value="Update Notes" class="btn btn-primary float-right">
                </form>
                </div>
                </div>
                </div>
                </div> ';



              }





              ?>



              <?php


              if($pagetoview == "tasks"){


                echo '            <div class="row">';




               






                echo '
                <div class="col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Add Task</h6>

                </div>

                <form id="form_2" action="viewproject.php?id='.$projectid.'&page=tasks" method="post">
                <div class="form-group">
                <label for="exampleInputEmail1">Task Title</label>
                <input type="text" class="form-control" name="tasktitle" placeholder="Example Title">
                </div>
                <label for="exampleInputEmail1">Task Description</label>
                <div class="form-group">
                <textarea class="form-control" name="taskdescription" id="exampleFormControlTextarea1" rows="10"></textarea>
                </div>
                <input type="submit"  name="submit_2" value="Add Task" class="btn btn-primary float-right">
                </form>

                </div>
                </div>
                </div>

                <div class="col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <h6 class="card-title">Current Tasks</h6>
                
                <div class="table-responsive">
                <table class="table">
                <thead>
                <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>';

                $query = $db->prepare("SELECT * FROM `tasks` WHERE `projectid` = '$projectid'");
                $query->execute();
                $result = $query -> fetchAll();
                foreach( $result as $row ) {
                  $dbtaskid = escape($row['id']);
                  $dbtasktitle = escape($row['Title']);
                  $dbtaskdesc = escape($row['Description']);
                  $dbtaskstatus = escape($row['status']);
                  $dbprojid = escape($row['projectid']);

                  echo '<tr>';
                  echo '<td>' . $dbtaskid . '</td>';
                  echo '<td>' . $dbtasktitle . '</td>';

                  if($dbtaskstatus == 0){
                    echo '<td><span class="badge badge-pill badge-info">Pending</span></td>';
                  } elseif ($dbtaskstatus == 2){

                    echo '<td><span class="badge badge-pill badge-success">Completed</span></td>';
                  } elseif($dbtaskstatus == 1){
                    echo '<td><span class="badge badge-pill badge-primary">In Progress</span></td>';
                  }


                  echo '<td><a href="marktask.php?id='.$dbtaskid.'&status=3"><button type="button" class="btn btn-info btn-xs mb-1 mb-md-0">Mark as pending</button></a> <a href="marktask.php?id='.$dbtaskid.'&status=1"><button type="button" class="btn btn-primary btn-xs mb-1 mb-md-0">Mark as in progress</button></a> <a href="marktask.php?id='.$dbtaskid.'&status=2"><button type="button" class="btn btn-success btn-xs mb-1 mb-md-0">Mark as Completed</button></a> <a href="marktask.php?id='.$dbtaskid.'&status=4"><button type="button" class="btn btn-danger btn-xs mb-1 mb-md-0">X</button></a></td>';
                  echo '</tr>';

                }




                echo '</tbody>
                </table>
                </div>
                </div>
                </div>
                </div>';

                 echo '<div class="col-xl-4 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Pending Tasks</h6>
                </div>
                <div class="form-group">';
                
                $query = $db->prepare("SELECT * FROM `tasks` WHERE `projectid` = '$projectid' AND `status` = 0");
                $query->execute();
                $result = $query -> fetchAll();
                foreach( $result as $row ) {
                  $pendingdbtasktitle = escape($row['Title']);
                  $pendingdbtaskdesc = escape($row['Description']);

                  echo '<div class="card">
                  <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">'.$pendingdbtasktitle.'</h6>
                  <p class="card-text">'.$pendingdbtaskdesc.'</p>
                  </div>
                  </div><br>';

                }









                echo '</div>
                </div>
                </div>
                </div>

                <div class="col-xl-4 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">In Progress</h6>
                </div>
                <div class="form-group">
                
                ';
                
                $query = $db->prepare("SELECT * FROM `tasks` WHERE `projectid` = '$projectid' AND `status` = 1");
                $query->execute();
                $result = $query -> fetchAll();
                foreach( $result as $row ) {
                  $pendingdbtasktitle = escape($row['Title']);
                  $pendingdbtaskdesc = escape($row['Description']);

                  echo '<div class="card">
                  <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">'.$pendingdbtasktitle.'</h6>
                  <p class="card-text">'.$pendingdbtaskdesc.'</p>
                  </div>
                  </div><br>';

                }


                echo '</div>
                </div>
                </div>
                </div>

                <div class="col-xl-4 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body"s>
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Completed Tasks</h6>
                </div>
                <div class="form-group">
                ';
                
                $query = $db->prepare("SELECT * FROM `tasks` WHERE `projectid` = '$projectid' AND `status` = 2");
                $query->execute();
                $result = $query -> fetchAll();
                foreach( $result as $row ) {
                  $pendingdbtasktitle = escape($row['Title']);
                  $pendingdbtaskdesc = escape($row['Description']);

                  echo '<div class="card">
                  <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">'.$pendingdbtasktitle.'</h6>
                  <p class="card-text">'.$pendingdbtaskdesc.'</p>
                  </div>
                  </div><br>';

                }


                echo '
                </div>
                </div>
                </div>
                </div>



                </div> ';


              }






              ?>




              <?php


              if($pagetoview == "milestones"){


                echo '            <div class="row">';




               






                echo '
                <div class="col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Add Milestone</h6>

                </div>

                <form id="form_2" action="viewproject.php?id='.$projectid.'&page=milestones" method="post">
                <div class="form-group">
                <label for="exampleInputEmail1">Milestone Title</label>
                <input type="text" class="form-control" name="Milestonetitle" placeholder="Example Title">
                </div>
                <label for="exampleInputEmail1">Milestone Description</label>
                <div class="form-group">
                <textarea class="form-control" name="Milestonedescription" id="exampleFormControlTextarea1" rows="10"></textarea>
                </div>
                <input type="submit"  name="submit_3" value="Add Milestones" class="btn btn-primary float-right">
                </form>

                </div>
                </div>
                </div>

                <div class="col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <h6 class="card-title">Current Milestones</h6>
                
                <div class="table-responsive">
                <table class="table">
                <thead>
                <tr>
                <th>#</th>
                <th>Title</th>
                
                <th>Status</th>
                
                </tr>
                </thead>
                <tbody>';

                $query = $db->prepare("SELECT * FROM `milestones` WHERE `projectid` = '$projectid'");
                $query->execute();
                $result = $query -> fetchAll();
                foreach( $result as $row ) {
                  $dbtaskid = escape($row['id']);
                  $dbtasktitle = escape($row['Title']);
                  $dbtaskdesc = escape($row['Description']);
                  $dbtaskstatus = escape($row['status']);
                  $dbprojid = escape($row['projectid']);

                  echo '<tr>';
                  echo '<td>' . $dbtaskid . '</td>';
                  echo '<td>' . $dbtasktitle . '</td>';


                  if($dbtaskstatus == 0){
                    echo '<td><span class="badge badge-pill badge-info">Pending</span></td>';
                  } elseif ($dbtaskstatus == 2){

                    echo '<td><span class="badge badge-pill badge-success">Completed</span></td>';
                  } elseif($dbtaskstatus == 1){
                    echo '<td><span class="badge badge-pill badge-primary">In Progress</span></td>';
                  }


                  
                  echo '</tr>';

                }




                echo '</tbody>
                </table>
                </div>
                </div>
                </div>
                </div>






                </div> ';

                                echo '<div class="col-xl-12 grid-margin stretch-card">
                <div class="card overflow-hidden">
                <div class="card-body">
                <h6 class="card-title">Current Tasks</h6>
                
                <div class="table-responsive">
                <table class="table">
                <thead>
                <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>';

                $query = $db->prepare("SELECT * FROM `milestones` WHERE `projectid` = '$projectid'");
                $query->execute();
                $result = $query -> fetchAll();
                foreach( $result as $row ) {
                  $dbtaskid = escape($row['id']);
                  $dbtasktitle = escape($row['Title']);
                  $dbtaskdesc = escape($row['Description']);
                  $dbtaskstatus = escape($row['status']);
                  $dbprojid = escape($row['projectid']);

                  echo '<tr>';
                  echo '<td>' . $dbtaskid . '</td>';
                  echo '<td>' . $dbtasktitle . '</td>';
                  echo '<td>' . $dbtaskdesc . '</td>';
                  if($dbtaskstatus == 0){
                    echo '<td><span class="badge badge-pill badge-info">Pending</span></td>';
                  } elseif ($dbtaskstatus == 2){

                    echo '<td><span class="badge badge-pill badge-success">Completed</span></td>';
                  } elseif($dbtaskstatus == 1){
                    echo '<td><span class="badge badge-pill badge-primary">In Progress</span></td>';
                  }


                  echo '<td><a href="markmilestone.php?id='.$dbtaskid.'&status=3"><button type="button" class="btn btn-info btn-xs mb-1 mb-md-0">Mark as pending</button></a> <a href="markmilestone.php?id='.$dbtaskid.'&status=1"><button type="button" class="btn btn-primary btn-xs mb-1 mb-md-0">Mark as in progress</button></a> <a href="markmilestone.php?id='.$dbtaskid.'&status=2"><button type="button" class="btn btn-success btn-xs mb-1 mb-md-0">Mark as Completed</button></a> <a href="markmilestone.php?id='.$dbtaskid.'&status=4"><button type="button" class="btn btn-danger btn-xs mb-1 mb-md-0">X</button></a></td>';
                  echo '</tr>';

                }




                echo '</tbody>
                </table>
                </div>
                </div>
                </div>
                </div>';


              }






              ?>






            </div>
          </div>
        </div>
      </div> <!-- row -->
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