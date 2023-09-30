<?php
    require_once '..\..\utils\services\index.php';
    require_once 'C:\ospanel\domains\laba11.com\utils\renderNavigation.php';
    
    renderNavigation(false);

    $api = new ServicesApi();

    $books = $api->library()->getAllBooks(); 

    //DEFAULT_VALUES
    $queryParams = (object)[];
    $queryParams->authorsQueryOne = ['Пушкин А. С.']; 
    $queryParams->countQuerySeven = null;

    if (isset($_POST['authorsQueryOne'])) {
      $queryParams->authorsQueryOne = $_POST['authorsQueryOne'];
    }

    if (isset($_POST['countQueryFour'])) {
      $queryParams->countQueryFour = $_POST['countQueryFour'];
    }

    if (isset($_POST['countQuerySeven'])) {
      $queryParams->countQuerySeven = $_POST['countQuerySeven'];
    }

    function renderQueryCard(string $query, int $index, string $task) {
?>
  <div style="margin-top: 30px;">
    <h2>Запрос <?echo $index?></h2>
    <p><?echo $task?></p>
    <pre style="background-color: black; color: white; font-weight: bold;"><?echo $query?></pre>
    <h3>Результат</h3>
    <?
      $api = new ServicesApi();
      $connection = $api->library()->getConnection();

      $result = $connection->query($query)->fetchAll(PDO::FETCH_OBJ);

      if (count($result) === 0) {
        return;
      }

      $keys = array_keys((array)$result[0]);

      echo "<table border=1><thead><tr>";
    
      foreach ($keys as $key) {
        echo "<th>$key</th>";
      }

      echo "</tr></thead>";

      foreach ($result as $el) {
        echo "<tr>";
        foreach($el as $fieldValue) {
          echo "<td>$fieldValue</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    ?>
  </div>
<?
    }

    $authors = join(",", array_map(function($authorName) {
      return "'$authorName'";
      }, $queryParams->authorsQueryOne)
    );

    renderQueryCard(
      "SELECT * FROM books where \"authorName\" in ($authors) ORDER BY \"authorName\" DESC, \"title\" ASC",
      1,
      "Список книг заданных авторов, упорядоченный по убыванию по авторам или по возрастанию по названиям;"
    );
?>
    <form method="POST" action="./index.php">
      <select
        multiple
        name="authorsQueryOne[]"
      >
        <?
          foreach($books as $book) {
            echo "<option value=\"$book->authorName\">$book->authorName</option>";
          }
        ?>
      </select>
      <input type="submit" />
    </form>
<?

    renderQueryCard(
      'SELECT * FROM clients WHERE surname ilike \'%ов\'',
      2,
      "Список клиентов, фамилии которых заканчиваются на «ов»;"
    );

    renderQueryCard(
      'SELECT DISTINCT ("bookId") FROM "booksIssues"',
      3,
      "Список кодов книг, которые выдавались (без повторов);"
    );

    renderQueryCard(
      'SELECT "clientId" as "clientId", "clients"."surname", COUNT("clientId") from "booksIssues"
      INNER JOIN "clients" ON "booksIssues"."clientId" = "clients"."id"
      GROUP BY ("clientId", "clients"."surname")',
      4,
      "Список клиентов, которым выдавались книги с указанием количества выдач;"
    );

    renderQueryCard(
      'SELECT "books"."id", "books"."title", "books"."authorName" from "booksIssues"
        RIGHT JOIN "books" ON "books"."id" = "booksIssues"."bookId"
        WHERE "booksIssues"."id" is NULL',
      5,
      "Список книг, которые не выдавались;"
    );

    renderQueryCard(
      'SELECT * from (
        SELECT "clientId", count("clientId") as count
        FROM "booksIssues"
        GROUP BY ("clientId")
    ) as "countTable"
    INNER JOIN "clients" ON "countTable"."clientId" = "clients"."id"
    WHERE count > 5',
      6,
      "6.	Список клиентов, бравших книги более 5 раз;"
    );

    $query7Text = 'SELECT "clients".*, COALESCE("counts"."count", 0) as count from "clients"
    LEFT JOIN (
         SELECT "clientId", count("clientId") as count
            FROM "booksIssues"
            GROUP BY ("clientId")
    ) as "counts" ON "counts"."clientId" = "clients"."id"';

    if (isset($queryParams->countQuerySeven) && is_numeric($queryParams->countQuerySeven)) {
      $query7Text = $query7Text . "WHERE count = $queryParams->countQuerySeven";
    }

    renderQueryCard(
      $query7Text,
      7,
      "Список клиентов с полем, содержащим количество выдач книг данному клиенту."
    );


?>
      <form method="POST" action="./index.php">
      <input
        style="width=100%;"
        type="text"
        name="countQuerySeven"
        placeholder="Если необходимо, укажите количество книг"
      />
      <input type="submit" />
    </form>

<?

    renderQueryCard(
      'SELECT "books".*, COALESCE("counts"."count", 0) as count, "counts"."avg" as avg from "books"
      LEFT JOIN (
           SELECT "bookId",
           count("bookId") as count,
           avg("dueToDate"::timestamp - "dateOfIssue"::timestamp) as avg
              FROM "booksIssues"
              GROUP BY ("bookId")
      ) as "counts" ON "counts"."bookId" = "books"."id";',
      8,
      "Список книг с указанием, сколько раз она выдавалась и среднего срока выдачи."
    );

    renderQueryCard(
      'SELECT "clients"."id", "clients"."surname", "counts"."count", "counts"."bookId", "books"."title", "books"."authorName" FROM clients
      INNER JOIN (
      SELECT DISTINCT("clientId"), Count("bookId"), "bookId" FROM "booksIssues" GROUP BY ("bookId", "clientId")
     )  as counts ON "counts"."clientId" = "clients"."id"
     INNER JOIN "books" ON "counts"."bookId" = "books"."id"
     WHERE count > 1',
      9,
      "Список клиентов, бравших одну и ту же книгу более 1 раза. В списке отобразить название книги и сколько раз она бралась."
    );

    renderQueryCard(
      'SELECT "books".*, COALESCE("counts"."count", 0) as count
      from "books"
        LEFT JOIN (
             SELECT "bookId",
             count("bookId") as count
                FROM "booksIssues"
                WHERE ("dueToDate" - "dateOfIssue") > 30
                GROUP BY ("bookId")
        ) as "counts" ON "counts"."bookId" = "books"."id"
      WHERE "count" > 10',
      10,
      "Список книг, которые брались более 10 раз на срок не менее 30 дней."
    );
?>

