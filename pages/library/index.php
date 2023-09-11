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
  </body>
</html>