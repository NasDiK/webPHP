<?php
    require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
    require_once 'C:\ospanel\domains\laba11.com\utils\renderNavigation.php';
    
    renderNavigation(false);
    
    $api = new ServicesApi();
?>

<?php
  $updateBook = (object)[];

  if (isset($_GET['id'])) {
    $updateBook->id = $_GET['id'];
  }

  if (isset($_GET['authorName'])) {
    $updateBook->authorName = $_GET['authorName'];
  }

  if (isset($_GET['title'])) {
    $updateBook->title = $_GET['title'];
  }

  $updateClient = (object)[];

  if (isset($_GET['idClient'])) {
    $updateClient->id = $_GET['idClient'];
  }

  if (isset($_GET['surnameClient'])) {
    $updateClient->surname = $_GET['surnameClient'];
  }

  $updateBookIssue = (object)[];

  if (isset($_GET['idBookIssue'])) {
    $updateBookIssue->id = $_GET['idBookIssue'];
  }

  if (isset($_GET['bookIdBookIssue'])) {
    $updateBookIssue->bookId = $_GET['bookIdBookIssue'];
  }

  if (isset($_GET['clientIdBookIssue'])) {
    $updateBookIssue->clientId = $_GET['clientIdBookIssue'];
  }

  if (isset($_GET['dateOfIssueBookIssue'])) {
    $updateBookIssue->dateOfIssue = $_GET['dateOfIssueBookIssue'];
  }

  if (isset($_GET['dueToDateBookIssue'])) {
    $updateBookIssue->dueToDate = $_GET['dueToDateBookIssue'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Библиотека</title>
  </head>
  <body>
    <div>
      <div class="books">
        <h2>Все книги</h2>

        <?php
        require_once('C:\ospanel\domains\laba11.com\pages\library\renderMethods.php');
        $books = $api->library()->getAllBooks();

        foreach($books as $el) {
          renderBookCard($el);
        }
        ?>
      </div>
      <div>
        <h2>Добавить книгу</h2>

        <form method="post" action="./handlers/create.php">
          <input type="text" placeholder="Название" name="titleAdd" />
          <input type="text" placeholder="Автор" name="authorNameAdd" />
          <input type="submit" value="Создать книгу" name="submit" />
        </form>
      </div>
      <div>
      <h2>Изменить книгу</h2>

      <form method="post" action="./handlers/update.php">
        <input 
          type="text" 
          placeholder="Название" 
          name="title" 
          value="<?php echo isset($updateBook->title) ? $updateBook->title : "" ?>"          
          <?php echo isset($updateBook->id) ? null : "disabled" ?>
        />
        <input 
          type="text" 
          placeholder="Автор" 
          name="authorName"
          value="<?php echo isset($updateBook->authorName) ? $updateBook->authorName : "" ?>"          
          <?php echo isset($updateBook->id) ? null : "disabled" ?>
        />
        <input 
          type="text" 
          name="id"
          value="<?php echo "$updateBook->id" ?>"          
          hidden
        />
        <input 
          type="submit" 
          value="Редактировать" 
          <?php echo isset($updateBook->id) ? null : "disabled" ?>
        />
      </form>
    </div>
    </div>

    <div>
      <div>
        <h2>Все клиенты</h2>

        <?php
        require_once('C:\ospanel\domains\laba11.com\pages\library\renderMethods.php');
        $clients = $api->library()->getAllClients();

        foreach($clients as $el) {
          renderClientCard($el);
        }
        ?>
      </div>
      <div>
        <h2>Добавить клиента</h2>
        <form method="post" action="./handlers/create.php">
          <input type="text" placeholder="Фамилия" name="surnameAddClient" />
          <input type="submit" value="Создать клиента" name="submit" />
        </form>
      </div>
      <div>
        <h2>Изменить клиента</h2>

        <form method="post" action="./handlers/update.php">
          <input 
            type="text" 
            placeholder="Фамилия" 
            name="surnameClient" 
            <?php echo isset($updateClient->surname) ? "value=\"$updateClient->surname\"" : "" ?>         
            <?php echo isset($updateClient->id) ? null : "disabled" ?>
          />
          <input 
            type="text" 
            name="idClient"
            value="<?php echo "$updateClient->id" ?>"          
            hidden
          />
          <input 
            type="submit" 
            value="Редактировать" 
            <?php echo isset($updateClient->id) ? null : "disabled" ?>
          />
        </form>
      </div>
    </div>

    <div>
      <div>
        <h2>Все выдачи</h2>

        <?php
        require_once('C:\ospanel\domains\laba11.com\pages\library\renderMethods.php');
        $booksIssues = $api->library()->getAllBooksIssue();

        foreach($booksIssues as $el) {
          renderBookIssueCard($el);
        }
        ?>
      </div>
      <div>
        <h2>Добавить выдачу</h2>
        <form method="post" action="./handlers/create.php">
          <input type="number" placeholder="Id client" name="clientIdAddBookIssue" />
          <input type="number" placeholder="Id book" name="bookIdAddBookIssue" />
          <input type="date" placeholder="IssueDate" name="dateOfIssueAddBookIssue" />
          <input type="date" placeholder="DueToDate" name="dueToDateAddBookIssue" />
          <input type="submit" value="Создать клиента" name="submit" />
        </form>
      </div>
      <div>
        <h2>Изменить выдачу</h2>

        <form method="post" action="./handlers/update.php">
          <input 
            type="number" 
            placeholder="Книга Id" 
            name="bookIdBookIssue" 
            <?php echo isset($updateBookIssue->bookId) ? "value=\"$updateBookIssue->bookId\"" : "" ?>         
            <?php echo isset($updateBookIssue->id) ? null : "disabled" ?>
          />
          <input 
            type="number" 
            placeholder="Клиент Id" 
            name="clientIdBookIssue" 
            <?php echo isset($updateBookIssue->clientId) ? "value=\"$updateBookIssue->clientId\"" : "" ?>         
            <?php echo isset($updateBookIssue->id) ? null : "disabled" ?>
          />
          <input 
            type="date" 
            placeholder="IssueDate" 
            name="dateOfIssueBookIssue" 
            <?php echo isset($updateBookIssue->dateOfIssue) ? "value=\"$updateBookIssue->dateOfIssue\"" : "" ?>         
            <?php echo isset($updateBookIssue->id) ? null : "disabled" ?>
          />
          <input 
            type="date" 
            placeholder="DueToDate" 
            name="dueToDateBookIssue" 
            <?php echo isset($updateBookIssue->dueToDate) ? "value=\"$updateBookIssue->dueToDate\"" : "" ?>         
            <?php echo isset($updateBookIssue->id) ? null : "disabled" ?>
          />
          <input 
            type="text" 
            name="idBookIssue"
            value="<?php echo "$updateBookIssue->id" ?>"          
            hidden
          />
          <input 
            type="submit" 
            value="Редактировать" 
            <?php echo isset($updateBookIssue->id) ? null : "disabled" ?>
          />
        </form>
      </div>
    </div>
  </body>
</html>