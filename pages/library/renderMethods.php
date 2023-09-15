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

  function renderClientCard($el) {
?>
  <div>
    <span>Id: <?echo $el->id?>.&nbsp;</span>
    <span>Фамилия: <?echo $el->surname?>.&nbsp;</span>
    <div style="display: flex; gap: 8px;">
        <form method="get" action="./index.php">
          <input type="text" value="<?echo $el->id?>" hidden name="idClient" />
          <input type="text" value="<?echo $el->surname?>" hidden name="surnameClient" />
          <input type="submit" value="Изменить" />
        </form>
        <form method="post" action="./handlers/delete.php">
          <input type="text" value="<?echo $el->id?>" hidden name="idClient" />
          <input type="submit" value="Удалить" />
        </form>
      </div>
  </div>
<?
}

function renderBookIssueCard($el) {
?>
  <div>
  <span>Id: <?echo $el->id?>.&nbsp;</span>
    <span>Книга: <?echo $el->bookTitle?>.&nbsp;</span>
    <span>Клиент: <?echo $el->clientSurname?>.&nbsp;</span>
    <span>Дата выдачи: <?echo $el->dateOfIssue?>.&nbsp;</span>
    <span>Срок выдачи: <?echo $el->dueToDate?>.&nbsp;</span>
    <div style="display: flex; gap: 8px;">
      <form method="get" action="./index.php">
        <input type="text" value="<?echo $el->id?>" hidden name="idBookIssue" />
        <input type="text" value="<?echo $el->bookId?>" hidden name="bookIdBookIssue" />
        <input type="text" value="<?echo $el->clientId?>" hidden name="clientIdBookIssue" />
        <input type="text" value="<?echo $el->dateOfIssue?>" hidden name="dateOfIssueBookIssue" />
        <input type="text" value="<?echo $el->dueToDate?>" hidden name="dueToDateBookIssue" />
        <input type="submit" value="Изменить" />
      </form>
      <form method="post" action="./handlers/delete.php">
        <input type="text" value="<?echo $el->id?>" hidden name="idBookIssue" />
        <input type="submit" value="Удалить" />
      </form>
    </div>
  </div>
<?
}
?>