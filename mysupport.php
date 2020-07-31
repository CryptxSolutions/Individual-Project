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

$query = $db->prepare("SELECT * FROM `user` WHERE `email` = '$useremail'");
$query->execute();
$result = $query -> fetchAll();
foreach( $result as $row ) {

  $staffstatus = escape($row['staff']);
  $usersname = escape($row['name']);
}

$query = $db->prepare("SELECT COUNT(1) FROM `tickets` WHERE `user` = '$useremail'");
$query->execute();
$result = $query -> fetchAll();
foreach( $result as $row ) {

  $hasaticket = escape($row['COUNT(1)']);

}

if($hasaticket == 0){

  //Create Ticket
  //echo "No Ticket";
  $query = $db->prepare("INSERT INTO `tickets`(`user`) VALUES ('$useremail')");
  $query->execute();
  header("Refresh:0");
  die();

} else {
  //echo "HasTicket";
  //Do Nothing

  $query = $db->prepare("SELECT * FROM `tickets` WHERE `user` = '$useremail'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $ticketid = escape($row['id']);
  }


}

if(!empty($_POST['message'])){

  $usermessage = escape($_POST['message']);
  $query = $db->prepare("INSERT INTO `ticketreplies`(`ticketid`, `staff`, `message`) VALUES ('$ticketid','$staffstatus','$usermessage')");
  $query->execute();
  if($staffstatus == 0){

    //update to user reply
    $query = $db->prepare("UPDATE `tickets` SET `status`= 1 WHERE `id` = '$ticketid'");
    $query->execute();

  } elseif ($staffstatus == 1){

    //update to staff reply
    $query = $db->prepare("UPDATE `tickets` SET `status`= 2 WHERE `id` = '$ticketid'");
    $query->execute();

  }

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

      <div class="row chat-wrapper">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row position-relative">

                <div class="col-lg-12 chat-content">
                  <div class="chat-header border-bottom pb-2">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex align-items-center">
                        <i data-feather="corner-up-left" id="backToChatList" class="icon-lg mr-2 ml-n2 text-muted d-lg-none"></i>
                        <figure class="mb-0 mr-2">
                          <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="image">
                          <div class="status online"></div>
                          <div class="status online"></div>
                        </figure>
                        <div>
                          <p>Staff Team</p>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="chat-body">
                    <ul class="messages">

                      <?php

                    $query = $db->prepare("SELECT * FROM `ticketreplies` WHERE `ticketid` = '$ticketid' ORDER BY `id` ASC");
                    $query->execute();
                    $result = $query -> fetchAll();
                    foreach( $result as $row ) {

                      $staffreply = escape($row['staff']);
                      $message = escape($row['message']);

                      if($staffreply == 1){

                        echo '<li class="message-item friend">
                        <img src="https://img.icons8.com/nolan/2x/change-user-male.png" class="img-xs rounded-circle" alt="avatar">
                        <div class="content">
                          <div class="message">
                            <div class="bubble">
                              <p>'.$message.'</p>
                            </div>
                          </div>
                        </div>
                      </li>';

                      } else {


                        echo '<li class="message-item me">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQf2j71u2ipMbi4uUIcRaomOvJOSPkvvUPWFA&usqp=CAU" class="img-xs rounded-circle" alt="avatar">
                        <div class="content">
                          <div class="message">
                            <div class="bubble">
                              <p>'.$message.'</p>
                            </div>
                        </div>
                      </li>';


                      }


                    }




                    ?>


                      
                    </ul>
                  </div>
                  <form action="mysupport.php" method="post" class="search-form flex-grow mr-2">
                    <div class="chat-footer d-flex">



                      <div class="input-group">
                        <input type="text" name="message" class="form-control rounded-pill" id="chatForm" placeholder="Type a message">
                      </div>
                      
                      <div>
                        <button type="submit" class="btn btn-primary btn-icon rounded-circle">
                          <i data-feather="send"></i>
                        </button>
                      </div>
                      
                    </div>
                  </form>
                  </div>
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
  <script src="assets/js/chat.js"></script>
  <!-- end custom js for this page -->
</body>
</html>