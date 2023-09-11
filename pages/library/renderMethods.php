<?php
  function renderBookCard($book) {
    $author =  $book->authorName ? "<span>Автор: $book->authorName.&nbsp;</span>" : "";
?>
    <div>
      <span>Id: <?echo $book->id?>.&nbsp;</span>
      <span>Название: <?echo $book->title?>.&nbsp;</span>
      <?echo $author?>
      <div style="display: flex; gap: 8px;">
        <form method="get" action="./index.php">
          <input type="text" value="<?echo $book->id?>" hidden name="id" />
          <input type="text" value="<?echo $book->title?>" hidden name="title" />
          <input type="text" value="<?echo $book->authorName?>" hidden name="authorName" />
          <input type="submit" value="Изменить" />
        </form>
        <form method="post" action="./handlers/delete.php">
          <input type="text" value="<?echo $book->id?>" hidden name="id" />
          <input type="submit" value="Удалить" />
        </form>
      </div>
    </div>  
<?php
}
?>