<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();

$newObject = (object)[];
$newRenter = (object)[];
$newRentInfo = (object)[];
  
if (isset($_POST['costAdd'])) {
  $newObject->cost = $_POST['costAdd'];
}

if (isset($_POST['typeAdd'])) {
  $newObject->type = $_POST['typeAdd'];
}

if (count((array)$newObject) > 0) {
  $result = $api->rents()->insertObject($newObject);
  header("Location: http://laba11.com/pages/rents/");
  die();
}

if (isset($_POST['surnameAddRenter'])) {
  $newRenter->surname = $_POST['surnameAddRenter'];
}

if (count((array)$newRenter) > 0) {
  $result = $api->rents()->insertRenter($newRenter);
  header("Location: http://laba11.com/pages/rents/");
  die();
}

if (isset($_POST['objectIdAddRentInfo'])) {
  $newRentInfo->objectId = $_POST['objectIdAddRentInfo'];
}

if (isset($_POST['renterIdAddRentInfo'])) {
  $newRentInfo->renterId = $_POST['renterIdAddRentInfo'];
}

if (isset($_POST['rentLongAddRentInfo'])) {
  $newRentInfo->rentLong = $_POST['rentLongAddRentInfo'];
}

if (isset($_POST['startingDateAddRentInfo'])) {
  $newRentInfo->startingDate = $_POST['startingDateAddRentInfo'];
}

if (count((array)$newRentInfo) > 0) {
  $result = $api->rents()->insertRentInfo($newRentInfo);
  header("Location: http://laba11.com/pages/rents/");
  die();
}


?>