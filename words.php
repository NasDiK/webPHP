<?
$logFile = file('./log.txt');
$views = [
  "1" => 0,
  "2" => 0,
  "3" => 0,
  "4" => 0,
  "5" => 0,
  "6" => 0,
  "7" => 0,
  "8" => 0,
  "9" => 0,
  "10" => 0
];

foreach($logFile as $line) {
  $st = explode(' | ', $line);

  $time = $st[0];
  $severity = $st[1];
  $action = $st[2];
  $param = str_replace("\n", "", $st[3]);

  if ($action === 'WATCH_PAGE') {
    $views["$param"]++;
  }
}

$fontSizeFrom = 14;
$fontSizeTo = 30;

arsort($views); // сортируем по убыванию

$uniqueViews = array_unique($views);
$stepCount = count($uniqueViews);
$step = ($fontSizeTo - $fontSizeFrom) / ($stepCount - 1);

$fontViewSettings = array();
$curStep = $fontSizeTo + $step;
foreach($uniqueViews as $key => $val) {
  $fontViewSettings[$val] = round($curStep - $step);
  $curStep -= $step;
}

$json = json_decode(file_get_contents('./keyWords.json'));
foreach($json as $pageId => $val) {
  $str = implode(', ', $val);
  $viewsCount = $views["$pageId"];

  echo "<div style=\"font-size: $fontViewSettings[$viewsCount]\">$str</div>";
}
?>