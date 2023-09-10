<?php
  require_once 'C:\ospanel\domains\laba11.com\utils\PostgressApi.php';
  require_once 'C:\ospanel\domains\laba11.com\utils\services\library.php';
  require_once 'C:\ospanel\domains\laba11.com\utils\services\rents.php';
  require_once 'C:\ospanel\domains\laba11.com\utils\services\aviatickets.php';
class ServicesApi {
  private $_services;

  function __construct() {
    $_services = (object)[];

    $_services->library = new Library(getPDOConnection("L_11_library"));
    $_services->rents = new Rents(getPDOConnection("L_11_rent"));
    $_services->aviatickets = new AviaTickets(getPDOConnection("L_11_aviaTickets"));

    $this->_services = $_services;
  }

  public function library(): Library {
    return $this->_services->library;
  }

  public function rents(): Rents {
    return $this->_services->rents;
  }

  public function aviaTickets(): AviaTickets {
    return $this->_services->aviatickets;
  }
}
?>