<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();

$newBook = (object)[];
$bookId = null;

$newClient = (object)[];
$clientId = null;

$newBookIssue = (object)[];
$bookIssueId = null;
  
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

  header("Location: http://laba11.com/pages/library/");
  die();
}

if (isset($_POST['surnameClient'])) {
  $newClient->surname = $_POST['surnameClient'];
}

if (count((array)$newClient) > 0) {
  $result = $api->library()->updateClient($clientId, $newClient);

  header("Location: http://laba11.com/pages/library/");
  die();
}

if (isset($_POST['bookIdBookIssue'])) {
  $newBookIssue->bookId = $_POST['bookIdBookIssue'];
}

if (isset($_POST['dueToDateBookIssue'])) {
  $newBookIssue->dueToDate = $_POST['dueToDateBookIssue'];
}

if (isset($_POST['clientIdBookIssue'])) {
  $newBookIssue->clientId = $_POST['clientIdBookIssue'];
}

if (isset($_POST['dateOfIssueBookIssue'])) {
  $newBookIssue->dateOfIssue = $_POST['dateOfIssueBookIssue'];
}

if (count((array)$newBookIssue) > 0) {
  $result = $api->library()->updateBookIssue($bookIssueId, $newBookIssue);

  header("Location: http://laba11.com/pages/library/");
  die();
}

?>