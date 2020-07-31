<?php
require("inc/connect.php");
// Set error 1 to 1 or more missing items
//set error 2 to non matching passwords
//error 3 user already registered.
//status 4 = success
if (isset($_SESSION['thesesh'])){
    header("Location: index.php");
    die();
  }
  
if(!empty($_POST)){

  if (empty($_POST['name'])){

    header("Location: register.php?status=1");
    die();

  }
  if (empty($_POST['num'])){

    header("Location: register.php?status=1");
    die();

  }
  if (empty($_POST['email'])){

    header("Location: register.php?status=1");
    die();

  }
  if (empty($_POST['pass1'])){

    header("Location: register.php?status=1");
    die();

  }
  if (empty($_POST['pass2'])){

    header("Location: register.php?status=1");
    die();

  }


  $name = escape($_POST['name']);
  $num = escape($_POST['num']);
  $email = escape($_POST['email']);
  $pass1 = escape($_POST['pass1']);
  $pass2 = escape($_POST['pass2']);




  if($pass1 != $pass2){

    header("Location: register.php?status=2");
    die();

  } else {



    $query = $db->prepare("SELECT COUNT(1) FROM `user` WHERE `email` = '$email'");
    $query->execute();
    $result = $query -> fetchAll();
    foreach( $result as $row ) {

      $emailexist = escape($row['COUNT(1)']);

    }

    if($emailexist != 0) {

      header("Location: register.php?status=3");
      die();

    } else {


      $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
      $password = hash('sha256', $_POST['pass1'] . $salt);
      for($round = 0; $round < 65536; $round++)
      { 
        $password = hash('sha256', $password . $salt);
      }

      $query = $db->prepare("INSERT INTO `user`(`name`, `num`, `email`, `pass`, `salt`) VALUES ('$name','$num','$email','$password','$salt')");
      $query->execute();
      header("Location: register.php?status=4");
      die();


    }

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
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper">

                  </div>
                </div>
                <div class="col-md-8 pl-md-0">


                  <?php

                  if(!empty($_GET)){

                    $status = escape($_GET['status']);

                    if(empty($_GET['status'])){
                      die();
                    }


                    if($status == 4){

                      echo ' <div class="alert alert-success" role="alert">
                      Registered Successfully, Redirecting to login in 5 seconds.
                      </div><meta http-equiv="refresh" content="5;url=/login.php">';

                    }

                    if($status == 1){

                      echo '<div class="alert alert-danger" role="alert">
                      Registered Failed : One or more missing items
                      </div>';

                    }      

                                        if($status == 2){

                      echo '<div class="alert alert-danger" role="alert">
                      Registered Failed : Passwords did not match.
                      </div>';

                    }     

                                        if($status == 3){

                      echo '<div class="alert alert-danger" role="alert">
                      Registered Failed : User already registered.
                      </div>';

                    }     

                    }?>


                    <div class="auth-form-wrapper px-4 py-5">
                      <a href="#" class="noble-ui-logo d-block mb-2">Business<span>Name</span></a>
                      <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
                      <form action="register.php" method="post">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Name</label>
                          <input type="text" class="form-control" name="name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contact Number</label>
                          <input type="text" class="form-control" name="num" placeholder="Number">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" name="pass1" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Repeat Password</label>
                          <input type="password" class="form-control" name="pass2" placeholder="Repeat">
                        </div>

                        <div class="mt-3">
                          <button type="submit" class="btn btn-primary text-white mr-2 mb-2 mb-md-0">
                           Register
                         </button>
                       </div>


                     </form>
                     <a href="login.php" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>

     </div>
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