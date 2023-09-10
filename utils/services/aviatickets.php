<?php
  class AviaTickets {
    private PDO $connect;

    function __construct($connect){
      $this->connect = $connect;
    }
  }
?>