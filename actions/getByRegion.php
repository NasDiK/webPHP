<a href="http://laba11.com">На главную</a>
<?
  $labelsOnRussia = array(
    'recordIndex' => 'Индекс',
    'name' => 'Имя',
    'patronymicInitial' => 'Инициал отчества',
    'lastname' => 'Фамилия',
    'sex' => 'Пол',
    'city' => 'Город',
    'district' => 'Область',
    'emailAddress' => 'Адрес электронной почты',
    'phone' => 'Номер телефона',
    'dateOfBirth' => 'Дата рождения',
    'position' => 'Должность',
    'company' => 'Компания',
    'weight' => 'Вес',
    'height' => 'Рост',
    'mailAddress' => 'Почтовый адрес',
    'mailZIP' => 'Почтовый индекс',
    'contryCode' => 'Код страны',
    'age' => 'Возраст',

    'avgHeight' => 'Средний рост',
    'avgWeight' => 'Средний вес',
    'avgAge' => 'Средний возраст',
    'count' => 'Количество',
    'ageIsGreatherAvgCount' => 'Возраст больше среднего (количество)',
    'ageIsAvgCount' => 'Возраст равен среднему (количество)',
    'ageIsSmallerAvgCount' => 'Возраст меньше среднего (количество)',
    'heightIsGreatherAvgCount' => 'Рост больше среднего (количество)',
    'heightIsAvgCount' => 'Рост равен среднему (количество)',
    'heightIsSmallerAvgCount' => 'Рост меньше среднего (количество)',
    'weightIsGreatherAvgCount' => 'Вес больше среднего (количество)',
    'weightIsAvgCount' => 'Вес равен среднему (количество)',
    'weightIsSmallerAvgCount' => 'Вес меньше среднего (количество)',
  );
  function getAgeByDateOfBirth($dateOfBirth, $currentDate) {
    if (isset($dateOfBirth)) {
      return $currentDate->diff(new DateTime($dateOfBirth))->y;
    }

    return null;
  }

  $shouldParse = false;
  $region = isset($_GET['region']) && strlen($_GET['region']) ? $_GET['region'] : null;

  if (!isset($region)) {
    return;
  }
?>

<form method="GET" action="./getByRegion.php">
  <label>Введите регион: 
    <input type="text" placeholder="Регион" name="region" value="<? echo $region ?>"/>
    <input type="submit" value="Искать" />
  </label>
</form>

<?

  $content = file('../changedValues.txt');

  $linesThisRegion = [];
  $currentDate = new DateTime();

  foreach($content as $idx => $line) {
    $splittedRow = explode(';', $line);
    $district = $splittedRow[6];

    if ($district !== $region) {
      continue;
    }

    array_push(
      $linesThisRegion,
      array(
        'recordIndex' => $splittedRow[0],
        'name' => $splittedRow[1],
        'patronymicInitial' => $splittedRow[2],
        'lastname' => $splittedRow[3],
        'sex' => $splittedRow[4],
        'city' => $splittedRow[5],
        'district' => $splittedRow[6],
        'emailAddress' => $splittedRow[7],
        'phone' => $splittedRow[8],
        // 'dateOfBirth' => $splittedRow[9],
        'position' => $splittedRow[10],
        'company' => $splittedRow[11],
        'weight' => $splittedRow[12],
        'height' => $splittedRow[13],
        'mailAddress' => $splittedRow[14],
        'mailZIP' => $splittedRow[15],
        'contryCode' => $splittedRow[16],
        'age' => getAgeByDateOfBirth($splittedRow[9], $currentDate)
      )
    );
  }

  if(count($linesThisRegion) === 0) {
    echo "Записи не найдены. Пустота :(";

    return;
  }

  $lastnames = array_column($linesThisRegion, 'lastname');
  array_multisort($lastnames, SORT_ASC, $linesThisRegion);
?>

<h2>Таблица результата: </h2>
<div style="width: 100%; max-height: 500px; overflow: auto">
  <table border="1">
    <tr>
      <? foreach($linesThisRegion[0] as $key => $val) { echo "<th>$labelsOnRussia[$key] ($key)</th>"; } ?>
    </tr>
    <?
      foreach($linesThisRegion as $rowIndex => $row) {
      // foreach([] as $rowIndex => $row) {
    ?>
      <tr>
        <?
          foreach($row as $fieldName => $fieldVal) {
          ?>
            <td><? 
              if ($fieldName === 'name' && isset($row['sex'])) {
              ?>
                <span style="font-weight: bold; color: <? echo $row['sex'] === 'Муж' ? 'cyan' : 'pink' ?>">
                  <? echo $fieldVal ?>
                </span>
              <?
              } else {
                echo $fieldVal;
              }
            ?></td>
          <?
          }
        ?>
      </tr>
    <?
      }
    ?>
  </table>
</div>