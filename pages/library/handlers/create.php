<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();

$newBook = (object)[];
  
if (isset($_POST['titleAdd'])) {
  $newBook->title = $_POST['titleAdd'];
}

if (isset($_POST['authorNameAdd'])) {
  $newBook->authorName = $_POST['authorNameAdd'];
}

if (count((array)$newBook) > 0) {
  $result = $api->library()->insertBook($newBook);
  echo "<script>console.log($result)</script>";
}

header("Location: http://laba11.com/pages/library/");
die();
?>