<?php
  require_once '..\utils\logger.php';
  require_once '..\consts.php';

  $logger = new Logger();

  $logger->info(
    $logTypes['OPEN_PAGE'] . ' | ' . 'FOURTH'
  );
?>

<form>
  <input type='submit' value="Заказать" />
</form>

<?
$lines = file('../assets/pageContents/fourth.txt');

foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>