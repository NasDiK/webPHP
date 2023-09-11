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
      return $this
        ->connect
        ->exec("INSERT INTO books (\"title\", \"authorName\") VALUES ('$book->title', '$book->authorName') RETURNING *");
    }

    public function deleteBookById($bookId) {
      return $this->connect->exec("DELETE FROM books WHERE id=$bookId");
    }

    public function updateBook($bookId, $params) {
      return $this->connect->exec("UPDATE books SET \"authorName\"='$params->authorName', title='$params->title' WHERE id=$bookId");
    }
  }
?>