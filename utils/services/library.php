<?php
  class Library {
    private PDO $connect;

    function __construct($connect){
      $this->connect = $connect;
    }

    public function getAllBooks() {
      return $this->connect->query('SELECT * FROM "books"')->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllClients() {
      return $this->connect->query('SELECT * FROM "clients"')->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllBooksIssue() {
      return $this->connect->query('
      SELECT "booksIssues"."id",
      "booksIssues"."dateOfIssue" as "dateOfIssue",
      "booksIssues"."dueToDate" as "dueToDate",
      "booksIssues"."bookId" as "bookId",
      "books"."title" as "bookTitle",
      "booksIssues"."clientId" as "clientId",
      "clients"."surname" as "clientSurname"

      FROM "booksIssues"

      INNER JOIN clients ON "clients"."id" = "booksIssues"."clientId"
      INNER JOIN books on "books"."id" = "booksIssues"."bookId"
      ')->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertBook($book) {
      return $this
        ->connect
        ->exec("INSERT INTO books (title, \"authorName\") VALUES ('$book->title', '$book->authorName') RETURNING *");
    }

    public function insertClient($params) {
      return $this
        ->connect
        ->exec("INSERT INTO clients (surname) VALUES ('$params->surname')");
    }

    public function insertBookIssue($params) {
      return $this
        ->connect
        ->exec("
          INSERT INTO \"booksIssues\" (\"bookId\", \"clientId\", \"dateOfIssue\", \"dueToDate\")
          VALUES ($params->bookId, $params->clientId, '$params->dateOfIssue', '$params->dueToDate')
        ");
    }

    public function deleteBookById($bookId) {
      return $this->connect->exec("DELETE FROM books WHERE id=$bookId");
    }

    public function deleteClientById($id) {
      return $this->connect->exec("DELETE FROM clients WHERE id=$id");
    }

    public function deleteBookIssueById($id) {
      return $this->connect->exec("DELETE FROM \"booksIssues\" WHERE id=$id");
    }

    public function updateBook($id, $params) {
      return $this->connect->exec("UPDATE books SET \"authorName\"='$params->authorName', title='$params->title' WHERE id=$id");
    }

    public function updateClient($id, $params) {
      return $this->connect->exec("UPDATE clients SET surname='$params->surname' WHERE id=$id");
    }

    public function updateBookIssue($id, $params) {
      return $this->connect->exec("
        UPDATE \"booksIssues\" SET 
          \"bookId\"='$params->bookId',
          \"clientId\"='$params->clientId',
          \"dateOfIssue\"='$params->dateOfIssue',
          \"dueToDate\"='$params->dueToDate'
        WHERE id=$id
      ");
    }
  }
?>