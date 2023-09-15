<?php
require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
$api = new ServicesApi();
  
  if (isset($_POST['id'])) {
    $api->library()->deleteBookById($_POST['id']);

    header("Location: http://laba11.com/pages/library/");
    die();
  }

  if (isset($_POST['idClient'])) {
    $api->library()->deleteClientById($_POST['idClient']);

    header("Location: http://laba11.com/pages/library/");
    die();
  }

  if (isset($_POST['idBookIssue'])) {
    $api->library()->deleteBookIssueById($_POST['idBookIssue']);

    header("Location: http://laba11.com/pages/library/");
    die();
  }
?>