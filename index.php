<?
  require './config.php';
  require './utils/logger.php';

  $pageId = isset($_GET['page']) ? $_GET['page'] : null;
  $content = null;

  if (isset($pageId)) {
    $withPad = str_pad($pageId, 2, '0', STR_PAD_LEFT);
    $lines = file("./pages/Текст$withPad.txt");
    $linesWithCorrectEncode = array_map(
      function($line) {
        return iconv('Windows-1251', 'UTF-8', $line);
      },
      $lines
    );
  } else {
    echo "Page не указана";

    return;
  }

  const logger = new Logger(__DIR__ . '/log.txt');
  logger->info("WATCH_PAGE | $pageId");

  $randomPageNum = rand(1, 10);

?>

<a href="./?page=<? echo $randomPageNum ?>"><button>Рандомная страница</button></a>

<?
  foreach($linesWithCorrectEncode as $key => $line) {
    echo "<div>$line<div>";
  }
?>