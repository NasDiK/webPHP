<?php
  function renderBookCard($book) {
    $author =  $book->authorName ? "<span>Автор: $book->authorName.&nbsp;</span>" : "";

    echo "
      <div>
        <span>Id: $book->id.&nbsp;</span>
        <span>Название: $book->title.&nbsp;</span>
        $author
      </div>
    ";
  }
?>