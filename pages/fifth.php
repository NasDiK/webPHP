<?php
  require_once '..\utils\logger.php';
  require_once '..\consts.php';

  $logger = new Logger();

  $logger->info(
    $logTypes['OPEN_PAGE'] . ' | ' . 'FIFTH'
  );
?>

<form>
  <input type='submit' value="Заказать" />
</form>

<?
$lines = file('../assets/pageContents/fifth.txt');

foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>