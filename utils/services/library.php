<?php
  class Library {
    private PDO $connect;

    function __construct($connect){
      $this->connect = $connect;
    }

    public function getAllBooks() {
      return $this->connect->query('SELECT * FROM "books"')->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertBook($book) {

      return $this->connect->exec("INSERT INTO books (\"title\", \"authorName\") VALUES ('$book->title', '$book->authorName')");
    }
  }
?>