<div>Статистика</div>
<a href="http://laba11.com/">На главную</a>

<?
  $lines = file('..\log.txt');

  $bilateralTranslate = [
    "FIRST" => 1,
    "SECOND" => 2,
    "THIRD" => 3,
    "FOURTH" => 4,
    "FIFTH" => 5,
    "1" => "FIRST",
    "2" => "SECOND",
    "3" => "THIRD",
    "4" => "FOURTH",
    "5" => "FIFTH",
  ];

  $sitesVisits = [
    "FIRST" => 0,
    "SECOND" => 0,
    "THIRD" => 0,
    "FOURTH" => 0,
    "FIFTH" => 0
  ];

  $bannersShows = [
    "1" => 0,
    "2" => 0,
    "3" => 0,
    "4" => 0,
    "5" => 0
  ];

  $sitesOrders = [
    "FIRST" => 0,
    "SECOND" => 0,
    "THIRD" => 0,
    "FOURTH" => 0,
    "FIFTH" => 0
  ];

  foreach($lines as $line) {
    $parsedLines = explode(' | ', $line);

    //[2023-10-14 17:30:48] | INFO | BANNER_SHOW | 2 - пример лога
    $action = $parsedLines[2];
    $value = str_replace("\n", "", $parsedLines[3]); // из-за перевода на новую строку...

    switch($action) {
      case 'BANNER_SHOW':
        $bannersShows[$value] = $bannersShows[$value] + 1;
        break;
      case 'OPEN_PAGE':
        $sitesVisits[$value] = $sitesVisits[$value] + 1;
        break;
      case 'ORDER':
        $sitesOrders[$value] = $sitesOrders[$value] + 1;
        break;
    }
  }

  $allVisitorsCount = array_sum($sitesVisits);

  foreach($bannersShows as $key => $val) {
    $ctr = $val === 0 ? 'Деление на ноль' : round($sitesVisits[$bilateralTranslate[$key]] / $val * 100, 2);
    $cti = $allVisitorsCount === 0 ? 'Деление на ноль' : round($sitesVisits[$bilateralTranslate[$key]] / $allVisitorsCount, 2);
    $ctb = $sitesVisits[$bilateralTranslate[$key]] === 0 ? 'Деление на ноль' : round($sitesOrders[$bilateralTranslate[$key]] / $sitesVisits[$bilateralTranslate[$key]], 2); 

    echo "<div>
      <h2>Баннер #$key</h2>
      <h3>CTR: $ctr</h3>
      <h3>CTI: $cti</h3>
      <h3>CTB: $ctb</h3>
    </div>";
  }
?>