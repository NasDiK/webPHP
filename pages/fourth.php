<?php
  require_once '..\utils\logger.php';
  require_once '..\consts.php';
  require_once __DIR__ . '/commonMethods.php';

  $logger = new Logger();

  if (isset($_GET['ORDER']) && isset($_GET['from_banner'])) {
    order('FOURTH', $logger, $logTypes['ORDER']);
  } else {
    $logger->info(
      $logTypes['OPEN_PAGE'] . ' | ' . 'FOURTH'
    );
  }
?>

<form action="./fourth.php" method="GET">
  <input type='submit' value="Заказать" name="ORDER" />
</form>

<?
$lines = file('../assets/pageContents/fourth.txt');

foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>