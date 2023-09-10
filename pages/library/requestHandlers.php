<?php
  require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';

  $newBook = (object)[];
  
  if (isset($_POST['titleAdd'])) {
    $o = $_POST['titleAdd'];
    echo "<script>console.log('$o')</script>";
  
    $newBook->title = $_POST['titleAdd'];
  }

  if (isset($_POST['authorNameAdd'])) {
    $b = $_POST['authorNameAdd'];
    echo "<script>console.log('$b')</script>";
  
    $newBook->authorName = $_POST['authorNameAdd'];
  }
  
  if (count((array)$newBook) > 0) {
    $result = $api->library()->insertBook($newBook);
    echo "<script>console.log($result)</script>";
  }
  
?>