<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();
  
  if (isset($_POST['id'])) {
    $api->rents()->deleteObjectById($_POST['id']);

    header("Location: http://laba11.com/pages/rents/");
    die();
  }

  if (isset($_POST['idRenter'])) {
    $api->rents()->deleteRenterById($_POST['idRenter']);

    header("Location: http://laba11.com/pages/rents/");
    die();
  }

  if (isset($_POST['idRentInfo'])) {
    $api->rents()->deleteRentInfoById($_POST['idRentInfo']);

    header("Location: http://laba11.com/pages/rents/");
    die();
  }

  // echo "<script>console.log($result)</script>";
?>