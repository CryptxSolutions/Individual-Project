<?php
require("inc/connect.php");
checklogin();
$useremail = escape($_SESSION["thesesh"]);
//status == 1 == missing field

if(empty($_GET)){

  header("Location: myprojects.php");
  die();
}

if(!empty($_GET)){

  if(empty($_GET['id'])){

        //$projid = escape($_GET['id']);
    header("Location: myprojects.php");
    die();
  } 

  if(empty($_GET['status'])){

        //$projid = escape($_GET['id']);
    header("Location: myprojects.php");
    die();
  } 


  $taskid = escape($_GET['id']);


  $query = $db->prepare("SELECT COUNT(1) FROM `milestones` WHERE `id` = '$taskid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $doestaskexist = escape($row['COUNT(1)']);

  }

  if($doestaskexist != 1){
    header("Location: myprojects.php");
    die();

  }

  $query = $db->prepare("SELECT * FROM `milestones` WHERE `id` = '$taskid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $dbprojectid = escape($row['projectid']);

  }


  $statusid = escape($_GET['status']);

  if($statusid == 3){
  $query = $db->prepare("UPDATE `milestones` SET `status`= 0 WHERE `id` = '$taskid'");
  $query->execute();
  header("Location: viewproject.php?id=$dbprojectid&page=milestones");
  die();

  } elseif ($statusid == 1){

    $query = $db->prepare("UPDATE `milestones` SET `status`= 1 WHERE `id` = '$taskid'");
  $query->execute();
  header("Location: viewproject.php?id=$dbprojectid&page=milestones");
  die();

  } elseif ($statusid == 2){

    $query = $db->prepare("UPDATE `milestones` SET `status`= 2 WHERE `id` = '$taskid'");
  $query->execute();
    header("Location: viewproject.php?id=$dbprojectid&page=milestones");
  die();

  } elseif ($statusid == 4){

    $query = $db->prepare("DELETE FROM `milestones` WHERE `id` = '$taskid'");
  $query->execute();
  header("Location: viewproject.php?id=$dbprojectid&page=milestones");
  die();

  }






}

?>

  