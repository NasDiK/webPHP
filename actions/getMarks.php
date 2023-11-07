<?
  $vidTransporta = $_GET['vidTransporta'];
  $rows = array_slice(file(__DIR__ . '/../вар1.csv'), 1);

  $result = [];
  foreach($rows as $rowIdx => $rowValue) {
    $splittedStr = explode(';', $rowValue);
    if ($splittedStr[0] === $vidTransporta) {
      array_push(
        $result,
        array(
          'vidTransporta' => $splittedStr[0],
          'marka' => $splittedStr[1],
          'rashod' => $splittedStr[2]
        )
      );
    }
  }

  echo json_encode($result);
?>