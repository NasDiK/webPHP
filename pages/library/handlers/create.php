<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();

$newBook = (object)[];
$newClient = (object)[];
$newBookIssue = (object)[];
  
if (isset($_POST['titleAdd'])) {
  $newBook->title = $_POST['titleAdd'];
}

if (isset($_POST['authorNameAdd'])) {
  $newBook->authorName = $_POST['authorNameAdd'];
}

if (count((array)$newBook) > 0) {
  $api->library()->insertBook($newBook);

  header("Location: http://laba11.com/pages/library/");
  die();
}

if (isset($_POST['surnameAddClient'])) {
  $newClient->surname = $_POST['surnameAddClient'];
}

if (count((array)$newClient) > 0) {
  $api->library()->insertClient($newClient);

  header("Location: http://laba11.com/pages/library/");
  die();
}

if (isset($_POST['bookIdAddBookIssue'])) {
  $newBookIssue->bookId = $_POST['bookIdAddBookIssue'];
}

if (isset($_POST['clientIdAddBookIssue'])) {
  $newBookIssue->clientId = $_POST['clientIdAddBookIssue'];
}

if (isset($_POST['dateOfIssueAddBookIssue'])) {
  $newBookIssue->dateOfIssue = $_POST['dateOfIssueAddBookIssue'];
}

if (isset($_POST['dueToDateAddBookIssue'])) {
  $newBookIssue->dueToDate = $_POST['dueToDateAddBookIssue'];
}

if (count((array)$newBookIssue) > 0) {
  $api->library()->insertBookIssue($newBookIssue);

  header("Location: http://laba11.com/pages/library/");
  die();
}


?>