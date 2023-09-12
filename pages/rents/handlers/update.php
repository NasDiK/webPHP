<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();

$newObject = (object)[];
$objectId = null;

$newRenter = (object)[];
$renterId = null;

$newRentInfo = (object)[];
$rentInfoId = null;
  
if (isset($_POST['id'])) {
  $objectId = $_POST['id'];
}

if (isset($_POST['type'])) {
  $newObject->type = $_POST['type'];
}

if (isset($_POST['cost'])) {
  $newObject->cost = $_POST['cost'];
}

if (count((array)$newObject) > 0) {
  $result = $api->rents()->updateObject($objectId, $newObject);
  header("Location: http://laba11.com/pages/rents/");
  die();
}

if (isset($_POST['idRenter'])) {
  $renterId = $_POST['idRenter'];
}

if (isset($_POST['surnameRenter'])) {
  $newRenter->surname = $_POST['surnameRenter'];
}

if (count((array)$newRenter) > 0) {
  $result = $api->rents()->updateRenter($renterId, $newRenter);
  header("Location: http://laba11.com/pages/rents/");
  die();
}

if (isset($_POST['idRentInfo'])) {
  $rentInfoId = $_POST['idRentInfo'];
}

if (isset($_POST['objectIdRentInfo'])) {
  $newRentInfo->objectId = $_POST['objectIdRentInfo'];
}

if (isset($_POST['renterIdRentInfo'])) {
  $newRentInfo->renterId = $_POST['renterIdRentInfo'];
}

if (isset($_POST['rentLongRentInfo'])) {
  $newRentInfo->rentLong = $_POST['rentLongRentInfo'];
}

if (isset($_POST['startingDateRentInfo'])) {
  $newRentInfo->startingDate = $_POST['startingDateRentInfo'];
}

if (count((array)$newRentInfo) > 0) {
  $result = $api->rents()->updateRentInfo($rentInfoId, $newRentInfo);
  header("Location: http://laba11.com/pages/rents/");
  die();
}
?>