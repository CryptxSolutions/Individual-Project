<?php
require("inc/connect.php");
checklogin();
$useremail = escape($_SESSION["thesesh"]);
//status == 1 == missing field

if(empty($_GET)){

  header("Location: allprojects.php");
  die();
}

if(!empty($_GET)){

  if(empty($_GET['id'])){

        //$projid = escape($_GET['id']);
    header("Location: managestaff.php");
    die();
  } 

  if(empty($_GET['status'])){
    header("Location: managestaff.php");
    die();
  }

  $taskid = escape($_GET['id']);
  $statustoset = escape($_GET['status']);


  if($statustoset == 1){
    $query = $db->prepare("UPDATE `user` SET `staff`= 1 WHERE `id` = '$taskid'");
  $query->execute(); 
  header("Location: managestaff.php");
    die();

  } elseif($statustoset == 2){
            $query = $db->prepare("UPDATE `user` SET `staff`= 0 WHERE `id` = '$taskid'");
          $query->execute(); 
  header("Location: managestaff.php");
    die();

  } else {
    header("Location: managestaff.php");
    die();
  }



}

?>

  