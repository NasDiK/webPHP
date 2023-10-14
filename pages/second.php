<?php
  require_once '..\utils\logger.php';
  require_once '..\consts.php';

  $logger = new Logger();

  $logger->info(
    $logTypes['OPEN_PAGE'] . ' | ' . 'SECOND'
  );
?>

<form>
  <input type='submit' value="Заказать" />
</form>

<?
$lines = file('../assets/pageContents/second.txt');

foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>