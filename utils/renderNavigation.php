<?php
  function renderNavigation($onMain = true) {
    echo '<div>';

    $cwd = '.';
  
    if (!$onMain) {
      $cwd = '../..';
    }

    $links = array(
      1 => '<a href="' . $cwd . '/index.php"><b>Главная</b></a>',
      2 => '<a href="' . $cwd . '/pages\library"><b>Библиотека</b></a>',
      3 => '<a href="' . $cwd . '/pages\rents"><b>Аренда</b></a>',
      4 => '<a href="' . $cwd . '/pages\aviatickets"><b>Авиабилеты</b></a>',
      5 => '<a href="' . $cwd . '/pages\queries"><b>Запросы</b></a>',
    );

    foreach ($links as $el) {
      echo "<div>$el</div>";
    }

    echo '</div>'. '<br>';
  }
?>