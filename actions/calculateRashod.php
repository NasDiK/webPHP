<?
  $marka = $_GET['marka'];
  $distance = $_GET['distance'];

  $rows = array_slice(file(__DIR__ . '/../вар1.csv'), 1);

  $result = [];
  foreach($rows as $rowIdx => $rowValue) {
    $splittedStr = explode(';', $rowValue);
    if ($splittedStr[1] === $marka) {
      $markaRashod100km = $splittedStr[2];

      echo floatval($markaRashod100km)*floatval($distance) / 100;
      break;
    }
  }
?>