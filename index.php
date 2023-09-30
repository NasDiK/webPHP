<?php
  $fileContent = file_get_contents(__DIR__ . '/Лаб_Парсер.htm');

  $convertedContent = iconv('Windows-1251', 'UTF-8', $fileContent); //меняю кодировку строки

  $pattern = '/<td bgcolor="#ffffff">(.*?)<!--End of Main Menu-->/s';

  preg_match($pattern, $convertedContent, $matches);

  // var_dump($matches[0]);
  // echo($matches[0]) . '<br>';
  $mainMenu = $matches[0];
  
  $pattern = '/<span class="navText2">(.*?)<\/span>/s';

  preg_match_all($pattern, $mainMenu, $menuItems);
  // var_dump($menuItems[0]);

  foreach ($menuItems[0] as $item) {
    // var_dump($item);
    echo "<div>$item</div>";
  }

  $pattern = '/\b[A-ZА-ЯЁ]+\b/';
  $count = preg_match_all($pattern, join("", $menuItems[0]), $count);
  echo "Количество слов, напечатанных заглавными буквами: $count";
?>