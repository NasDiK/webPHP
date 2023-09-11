<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();

$newBook = (object)[];
$bookId = null;
  
if (isset($_POST['id'])) {
  $bookId = $_POST['id'];
}

if (isset($_POST['title'])) {
  $newBook->title = $_POST['title'];
}

if (isset($_POST['authorName'])) {
  $newBook->authorName = $_POST['authorName'];
}

if (count((array)$newBook) > 0) {
  $result = $api->library()->updateBook($bookId, $newBook);
  echo "<script>console.log($result)</script>";
}

header("Location: http://laba11.com/pages/library/");
die();
?>