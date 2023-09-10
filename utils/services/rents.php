<?php
  class Rents {
    private PDO $connect;

    function __construct($connect){
      $this->connect = $connect;
    }
  }
?>