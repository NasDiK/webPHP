<?php
    require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
    require_once 'C:\ospanel\domains\laba11.com\utils\renderNavigation.php';
    
    renderNavigation(false);
    
    $api = new ServicesApi();

    require_once 'C:\ospanel\domains\laba11.com\pages\library\requestHandlers.php';
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

      <form method="post">
        <input type="text" placeholder="Название" name="titleAdd" />
        <input type="text" placeholder="Автор" name="authorNameAdd" />
        <input type="submit" value="Создать книгу" name="submit" />
      </form>
    </div>
  </body>
</html>