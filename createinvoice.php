<?php
require("inc/connect.php");
checklogin();
$useremail = escape($_SESSION["thesesh"]);
//status == 1 == missing field
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
  } 


  $taskid = escape($_GET['id']);


  $query = $db->prepare("SELECT COUNT(1) FROM `projects` WHERE `id` = '$taskid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $doestaskexist = escape($row['COUNT(1)']);

  }

  if($doestaskexist != 1){
    header("Location: myprojects.php");
    die();

  }


  $query = $db->prepare("SELECT * FROM `projects` WHERE `id` = '$taskid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $projectid = escape($row['id']);
    $projecttitle = escape($row['title']);
    $projectbudget = escape($row['budget']);
    $projectname = escape($row['name']);
    $projectemail = escape($row['email']);
    $projectinvoicestatus = escape($row['invoicecreated']);
    //need to get number
  }


  $query = $db->prepare("SELECT * FROM `user` WHERE `email` = '$projectemail'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $projectnum = escape($row['num']);
    //need to get number
  }

  $projectinvoicestatus = 1;


  $query = $db->prepare("UPDATE `projects` SET `invoicecreated`= 1 WHERE `id` = '$taskid'");
  $query->execute(); 

  $query = $db->prepare("INSERT INTO `invoice`(`projectid`, `projecttitle`, `budget`, `name`, `number`, `email`, `status`) VALUES ('$projectid','$projecttitle','$projectbudget','$projectname','$projectnum','$projectemail','$projectinvoicestatus')");
  $query->execute();

 

  header("Location: manageinvoice.php");
    die();



  } 




?>

  