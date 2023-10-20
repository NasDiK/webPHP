<?php
  require_once '..\utils\logger.php';
  require_once '..\consts.php';
  require_once __DIR__ . '/commonMethods.php';

  $logger = new Logger();

  if (isset($_GET['ORDER'])) {
    order('FIFTH', $logger, $logTypes['ORDER']);
  } else {
    if (isset($_GET['from_banner'])) {
      $logger->info(
        $logTypes['OPEN_PAGE_FROM_BANNER'] . ' | ' . 'FIFTH'
      );
    } else {
      $logger->info(
        $logTypes['OPEN_PAGE'] . ' | ' . 'FIFTH'
      );
    }
  }
?>

<form action="./fifth.php" method="GET">
  <input type='submit' value="Заказать" name="ORDER" />
</form>

<?
$lines = file('../assets/pageContents/fifth.txt');

foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>