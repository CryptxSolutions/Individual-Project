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
    header("Location: allprojects.php");
    die();
  }

  $taskid = escape($_GET['id']);
  $statustoset = escape($_GET['status']);

  $query = $db->prepare("SELECT * FROM `invoice` WHERE `projectid` = '$taskid'");
  $query->execute();
  $result = $query -> fetchAll();
  foreach( $result as $row ) {

    $dbprojectid = escape($row['projectid']);

  }

  if($statustoset == 1){
    $query = $db->prepare("UPDATE `projects` SET `invoicecreated`= 1 WHERE `id` = '$taskid'");
  $query->execute(); 
  $query = $db->prepare("UPDATE `invoice` SET `status`= 1 WHERE `projectid` = '$taskid'");
  $query->execute(); 
  header("Location: manageinvoice.php");
    die();

  } elseif($statustoset == 2){
        $query = $db->prepare("UPDATE `projects` SET `invoicecreated`= 2 WHERE `id` = '$taskid'");
  $query->execute(); 
  $query = $db->prepare("UPDATE `invoice` SET `status`= 2 WHERE `projectid` = '$taskid'");
  $query->execute();
  header("Location: manageinvoice.php");
    die();

  } else {
    header("Location: allprojects.php");
    die();
  }



}

?>

  