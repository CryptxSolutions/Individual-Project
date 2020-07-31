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
    header("Location: allprojects.php");
    die();
  } 

  if(empty($_GET['status'])){

        //$projid = escape($_GET['id']);
    header("Location: allprojects.php");
    die();
  } 


  $taskid = escape($_GET['id']);


  $query = $db->prepare("SELECT COUNT(1) FROM `projects` WHERE `id` = '$taskid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $doestaskexist = escape($row['COUNT(1)']);

  }

  if($doestaskexist != 1){
    header("Location: allprojects.php");
    die();

  }


  $statusid = escape($_GET['status']);

  if($statusid == 3){
  $query = $db->prepare("UPDATE `projects` SET `status`= 0 WHERE `id` = '$taskid'");
  $query->execute();
  header("Location: allprojects.php");
  die();

  } elseif ($statusid == 1){

    $query = $db->prepare("UPDATE `projects` SET `status`= 1 WHERE `id` = '$taskid'");
  $query->execute();
    header("Location: allprojects.php");
  die();

  } elseif ($statusid == 2){

    $query = $db->prepare("UPDATE `projects` SET `status`= 3 WHERE `id` = '$taskid'");
  $query->execute();
  header("Location: allprojects.php");
  die();

  } elseif ($statusid == 4){

    $query = $db->prepare("DELETE FROM `projects` WHERE `id` = '$taskid'");
  $query->execute();
  header("Location: allprojects.php");
  die();

  }






}

?>

  