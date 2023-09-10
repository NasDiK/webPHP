<?php
  function getPDOConnection ($dbName) {
    require 'C:\ospanel\domains\laba11.com\config.php';

    return new PDO(
      join(
        ';',
        array(
          1 => 'pgsql:host=' . $DB_HOST,
          2 => 'port=' . $DB_PORT,
          3 => 'dbname=' . $dbName,
          4 => 'user=' . $DB_USER,
          5 => 'password=' . $DB_PASSWORD
        )
      )
    );
  };

  class PostgressApi {
    //Может в перспективе тут и будет красиво, пока нет)
    private $PDO_CONNECTION;

    function __construct($PG_CONNECTION) {
      if ($PG_CONNECTION == null) {
        throw new ErrorException('коннекшн кривой, передалай по братски');
      }
    }
  }
?>