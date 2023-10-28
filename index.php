<a href="http://laba11.com/actions/getByRegion.php">Регионы</a>

<?
  require_once './config.php';

  $lines = file($PARSE_FILE_PATH);

  function validateRegex($string, $regex) {
    return preg_match($regex, $string) > 0;
  }

  function returnFirstMatch($string, $regex) {
    $matches = [];
    preg_match($regex, $string, $matches);

    return count($matches) !== 0 ? $matches[0] : null;
  }

  function formatPhone($data) {
    $digits = str_split(
      preg_replace('/\D/', '', $data)
    );

    switch(count($digits)) {
      case 8:
        $fp = $digits[0];
        $sp = join("", array_slice($digits, 1, 3));
        $tp = join("", array_slice($digits, 4, 4));
        // return 'Восемь';
        return "$fp-$sp-$tp";
      case 9:
        $fp = join("", array_slice($digits, 0, 2));
        $sp = join("", array_slice($digits, 2, 3));
        $tp = join("", array_slice($digits, 5, 4));
        // return 'Девять';
        return "$fp-$sp-$tp";
      case 10:
        $fp = join("", array_slice($digits, 0, 3));
        $sp = join("", array_slice($digits, 3, 3));
        $tp = join("", array_slice($digits, 6, 4));
        // return 'Девять';
        return "$fp-$sp-$tp";
      default:
        return '';
    }
  };

  function getAgeByDateOfBirth($dateOfBirth, $currentDate) {
    if (isset($dateOfBirth)) {
      return $currentDate->diff(new DateTime($dateOfBirth))->y;
    }
  
    return null;
  }

  function getNextAvg($previousAvg, $val, $count) {
    //среднее = (среднее*количество + значение) / (количество + 1)
    //количество++;
    return ($previousAvg*$count + $val) / ($count + 1);
  };

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

  $errors = array(
    'recordIndex' => 0,
    'name' => 0,
    'patronymicInitial' => 0,
    'lastname' => 0,
    'sex' => 0,
    'city' => 0,
    'district' => 0,
    'emailAddress' => 0,
    'phone' => 0,
    'dateOfBirth' => 0,
    'position' => 0,
    'company' => 0,
    'weight' => 0,
    'height' => 0,
    'mailAddress' => 0,
    'mailZIP' => 0,
    'contryCode' => 0
  );
  $dayOfBirthsPeopleNames = array(
    '01.01' => [],
    '07.01' => [],
    '14.02' => [],
    '23.02' => [],
    '08.03' => [],
    '01.05' => [],
    '31.12' => []
  );

  $parsedRows = array();
  $changedRows = array();
  $arrToFile = array();

  $maleStatistic = array(
    'avgHeight' => 0,
    'heightCount' => 0,
    'avgWeight' => 0,
    'weightCount' => 0,
    'avgAge' => 0,
    'ageCount' => 0,
    'count' => 0,

    'ageIsGreatherAvgCount' => 0,
    'ageIsAvgCount' => 0,
    'ageIsSmallerAvgCount' => 0,
    'heightIsGreatherAvgCount' => 0,
    'heightIsAvgCount' => 0,
    'heightIsSmallerAvgCount' => 0,
    'weightIsGreatherAvgCount' => 0,
    'weightIsAvgCount' => 0,
    'weightIsSmallerAvgCount' => 0,
  );
  $femaleStatistic = array(
    'avgHeight' => 0,
    'heightCount' => 0,
    'avgWeight' => 0,
    'weightCount' => 0,
    'avgAge' => 0,
    'ageCount' => 0,
    'count' => 0,

    'ageIsGreatherAvgCount' => 0,
    'ageIsAvgCount' => 0,
    'ageIsSmallerAvgCount' => 0,
    'heightIsGreatherAvgCount' => 0,
    'heightIsAvgCount' => 0,
    'heightIsSmallerAvgCount' => 0,
    'weightIsGreatherAvgCount' => 0,
    'weightIsAvgCount' => 0,
    'weightIsSmallerAvgCount' => 0,
  );

  $currentDate = new DateTime();

  foreach($lines as $line) {
    $args = explode(',', $line);
    $argsLength = count($args);

    if ($argsLength === 0) {
      continue;
    }

    /**
     * Требования к парсу данных
     * 1) Данные могут быть неполными (например 6 элементов в массиве)
     * 2) Данные могут быть искорёжены (например кодировка), что сделать? Игнорировать
     */

    $recordIndex = validateRegex($args[0], '/^\d+$/') ? $args[0] : null; // Номер записи
    $name = $argsLength >= 2 && validateRegex($args[1], '/^[A-Za-zА-Яа-я]+$/') ? $args[1] : null; // Имя
    $patronymicInitial = $argsLength >= 3 && validateRegex($args[2], '/^[A-Za-zА-Яа-я]$/')? $args[2] . '.' : null; // Инициал отчества
    $lastname = $argsLength >= 4 && validateRegex($args[3], '/^[A-Za-zА-Яа-я]+$/') ? $args[3] : null; // Фамилия
    $sex = $argsLength >= 5 && validateRegex($args[4], '/^male$|^female$/') ? $args[4] === 'male' ? 'Муж' : 'Жен' : null; // Пол
    $city = $argsLength >= 6 ? returnFirstMatch($args[5], '/([A-Za-zА-Яа-я]+\s?)+/') : null; //Город
    $district = $argsLength >= 7 ? returnFirstMatch($args[6], '/^[A-Za-zА-Яа-я0-9]{2}$/') : null; // область
    $emailAddress = $argsLength >= 8 ?  returnFirstMatch($args[7], '/^[A-Za-z0-9]+@[A-Za-z0-9]+\.[a-z]+$/') : null; // Адрес электронной почты
    $phone = $argsLength >= 9 ? returnFirstMatch($args[8], '/^[0-9]{2,3}-[0-9]{2,3}-[0-9]{4}$/') : null; // Телефон 781-705-5924
    $dateOfBirth = $argsLength >= 10 ? returnFirstMatch($args[9], '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/') : null; // Дата рождения
    $position = $argsLength >= 11 ? returnFirstMatch($args[10], '/^([A-Za-zА-Яа-я]+\s?)+$/') : null; // Должность
    $company = $argsLength >= 12 ? returnFirstMatch($args[11], '/^([A-Za-zА-Яа-я]+\s?)+$/') : null; // Компания
    $weight = $argsLength >= 13 ? returnFirstMatch($args[12], '/^[0-9]+\.?[0-9]*$/') : null; // Вес
    $height = $argsLength >= 14 ? returnFirstMatch($args[13], '/^[0-9]+$/') : null; // Рост
    $mailAddress = $argsLength >= 15 ? returnFirstMatch($args[14], '/^[0-9]+ ([A-Za-zА-Яа-я]+\s?)+$/') : null; // Почтовый адрес
    $mailZIP = $argsLength >= 16 ? returnFirstMatch($args[15], '/^[0-9]+$/') : null; // Почтовый индекс
    $contryCode = $argsLength >= 17 ? returnFirstMatch($args[6], '/^[A-Z]{2}$/') : null; // Код страны (Alpha2 ISO???)

    $recordIndex === null && $errors['recordIndex']++;
    $name === null && $errors['name']++;
    $patronymicInitial === null && $errors['patronymicInitial']++;
    $lastname === null && $errors['lastname']++;
    $sex === null && $errors['sex']++;
    $city === null && $errors['city']++;
    $district === null && $errors['district']++;
    $emailAddress === null && $errors['emailAddress']++;
    $phone === null && $errors['phone']++;
    $dateOfBirth === null && $errors['dateOfBirth']++;
    $position === null && $errors['position']++;
    $company === null && $errors['company']++;
    $weight === null && $errors['weight']++;
    $height === null && $errors['height']++;
    $mailAddress === null && $errors['mailAddress']++;
    $mailZIP === null && $errors['mailZIP']++;
    $contryCode === null && $errors['contryCode']++;

    array_push(
      $parsedRows,
      array(
        'recordIndex' => $recordIndex,
        'name' => $name,
        'patronymicInitial' => $patronymicInitial,
        'lastname' => $lastname,
        'sex' => $sex,
        'city' => $city,
        'district' => $district,
        'emailAddress' => $emailAddress,
        'phone' => $phone,
        'dateOfBirth' => $dateOfBirth,
        'position' => $position,
        'company' => $company,
        'weight' => $weight,
        'height' => $height,
        'mailAddress' => $mailAddress,
        'mailZIP' => $mailZIP,
        'contryCode' => $contryCode
      )
    );

    $age = null;

    if (isset($dateOfBirth)) {
      $splittedDate = explode('/', $dateOfBirth);
      $month = $splittedDate[0];
      $day = $splittedDate[1];
      
      if (array_key_exists("$day.$month", $dayOfBirthsPeopleNames)) {
        array_push($dayOfBirthsPeopleNames["$day.$month"], "$name ($recordIndex)");
      }

      $age = getAgeByDateOfBirth($dateOfBirth, $currentDate);
    }

    $newRecordIndex = str_pad($recordIndex, 6, '0', STR_PAD_LEFT);
    $newPhone = formatPhone($phone);
    $newWeight = round(floatval($weight), 0, PHP_ROUND_HALF_UP);

    $newRow = array(
      'recordIndex' => $newRecordIndex,
      'name' => $name,
      'patronymicInitial' => $patronymicInitial,
      'lastname' => $lastname,
      'sex' => $sex,
      'city' => $city,
      'district' => $district,
      'emailAddress' => $emailAddress,
      'phone' => $newPhone,
      'dateOfBirth' => $dateOfBirth,
      'position' => $position,
      'company' => $company,
      'weight' => $newWeight,
      'height' => $height,
      'mailAddress' => $mailAddress,
      'mailZIP' => $mailZIP,
      'contryCode' => $contryCode
    );
  
    array_push($changedRows, $newRow);
    array_push($arrToFile, implode(';', $newRow) . "\n");

    if ($sex === 'Муж') {
      if (isset($height)) {
        $maleStatistic['avgHeight'] = getNextAvg($maleStatistic['avgHeight'], floatval($height), $maleStatistic['heightCount']);
        $maleStatistic['heightCount']++;
      }
      if (isset($age)) {
        $maleStatistic['avgAge'] = getNextAvg($maleStatistic['avgAge'], floatval($age), $maleStatistic['ageCount']);
        $maleStatistic['ageCount']++;
      }
      if (isset($weight)) {
        $maleStatistic['avgWeight'] = getNextAvg($maleStatistic['avgWeight'], $newWeight, $maleStatistic['weightCount']);
        $maleStatistic['weightCount']++;
      }
      $maleStatistic['count']++;
    } else if ($sex === 'Жен') {
      if (isset($height)) {
        $femaleStatistic['avgHeight'] = getNextAvg($femaleStatistic['avgHeight'], floatval($height), $femaleStatistic['heightCount']);
        $femaleStatistic['heightCount']++;
      }
      if (isset($age)) {
        $femaleStatistic['avgAge'] = getNextAvg($femaleStatistic['avgAge'], floatval($age), $femaleStatistic['ageCount']);
        $femaleStatistic['ageCount']++;
      }
      if (isset($weight)) {
        $femaleStatistic['avgWeight'] = getNextAvg($femaleStatistic['avgWeight'], $newWeight, $femaleStatistic['weightCount']);
        $femaleStatistic['weightCount']++;
      }
      $femaleStatistic['count']++;
    }
  }

  echo "<h2>Количество ошибок в полях</h2>";
  foreach($errors as $key => $val) {
    echo "
      <div><b>$labelsOnRussia[$key]</b>: $val</div>
    ";
  }
?>

<hr/>

<!-- <h2>Таблица распаршенных значений: </h2>
<div style="width: 100%; max-height: 500px; overflow: auto">
  <table border="1">
    <tr>
      <? //foreach($labelsOnRussia as $key => $val) { echo "<th>$val ($key)</th>"; } ?>
    </tr>
    <?
      //foreach($parsedRows as $rowIndex => $row) {
    ?>
      <tr>
        <?
          //foreach($row as $fieldName => $fieldVal) {
          ?>
            <td><? //echo $fieldVal ?></td>
          <?
          //}
        ?>
      </tr>
    <?
      //}
    ?>
  </table>
</div> -->

<hr/>

<h2>Таблица преобразованных значений (п.2): </h2>
<div style="width: 100%; max-height: 500px; overflow: auto">
  <table border="1">
    <tr>
      <? foreach($changedRows[0] as $key => $val) { echo "<th>$labelsOnRussia[$key] ($key)</th>"; } ?>
    </tr>
    <?
      // foreach($changedRows as $rowIndex => $row) {
      foreach([] as $rowIndex => $row) {
    ?>
      <tr>
        <?
          foreach($row as $fieldName => $fieldVal) {
          ?>
            <td><? echo $fieldVal ?></td>
          <?
          }
        ?>
      </tr>
    <?
      }
    ?>
  </table>
</div>

<hr/>

<h2>Имена тех, кто родился в определённые праздники:</h2>
<div>
  <?
    foreach($dayOfBirthsPeopleNames as $holidayDate => $names) {
  ?>
    <p>
        <b><? echo $holidayDate ?></b>
     <p>
  <?
      foreach($names as $idx => $peopleName) {
  ?>
        <div style="margin-left: 15px;"><? echo $peopleName ?></div>
  <?
      }
    }
  ?>
</div>

<?
  file_put_contents('changedValues.txt', $arrToFile);

  $roundedStats = array(
    'Муж' => array(
      'avgHeight' => round($maleStatistic['avgHeight']),
      'avgWeight' => round($maleStatistic['avgWeight']),
      'avgAge' => round($maleStatistic['avgAge'])
    ),
    'Жен' => array(
      'avgHeight' => round($femaleStatistic['avgHeight']),
      'avgWeight' => round($femaleStatistic['avgWeight']),
      'avgAge' => round($femaleStatistic['avgAge'])
    )
  );
  foreach($changedRows as $idx => $row) {
    if (!isset($row['sex'])) {
      continue;
    }

    $sex = $row['sex'];
    $age = getAgeByDateOfBirth($row['dateOfBirth'], $currentDate);
    $weight = $row['weight'];
    $height = floatval($row['height']);

    if ($sex === 'Муж') {
      if (isset($age)) {
        ($age > $roundedStats[$sex]['avgAge']) && ($maleStatistic['ageIsGreatherAvgCount']++);
        ($age < $roundedStats[$sex]['avgAge']) && ($maleStatistic['ageIsSmallerAvgCount']++);
        ($age + $roundedStats[$sex]['avgAge']) && ($maleStatistic['ageIsAvgCount']++);
      }
  
      if (isset($weight)) {
        ($weight > $roundedStats[$sex]['avgWeight']) && ($maleStatistic['heightIsGreatherAvgCount']++);
        ($weight < $roundedStats[$sex]['avgWeight']) && ($maleStatistic['heightIsSmallerAvgCount']++);
        ($weight + $roundedStats[$sex]['avgWeight']) && ($maleStatistic['heightIsAvgCount']++);
      }
  
      if (isset($height)) {
        ($height > $roundedStats[$sex]['avgHeight']) && ($maleStatistic['weightIsGreatherAvgCount']++);
        ($height < $roundedStats[$sex]['avgHeight']) && ($maleStatistic['weightIsSmallerAvgCount']++);
        ($height + $roundedStats[$sex]['avgHeight']) && ($maleStatistic['weightIsAvgCount']++);
      }
    }
    else {
      if (isset($age)) {
        ($age > $roundedStats[$sex]['avgAge']) && ($femaleStatistic['ageIsGreatherAvgCount']++);
        ($age < $roundedStats[$sex]['avgAge']) && ($femaleStatistic['ageIsSmallerAvgCount']++);
        ($age + $roundedStats[$sex]['avgAge']) && ($femaleStatistic['ageIsAvgCount']++);
      }
  
      if (isset($weight)) {
        ($weight > $roundedStats[$sex]['avgWeight']) && ($femaleStatistic['heightIsGreatherAvgCount']++);
        ($weight < $roundedStats[$sex]['avgWeight']) && ($femaleStatistic['heightIsSmallerAvgCount']++);
        ($weight + $roundedStats[$sex]['avgWeight']) && ($femaleStatistic['heightIsAvgCount']++);
      }
  
      if (isset($height)) {
        ($height > $roundedStats[$sex]['avgHeight']) && ($femaleStatistic['weightIsGreatherAvgCount']++);
        ($height < $roundedStats[$sex]['avgHeight']) && ($femaleStatistic['weightIsSmallerAvgCount']++);
        ($height + $roundedStats[$sex]['avgHeight']) && ($femaleStatistic['weightIsAvgCount']++);
      }
    }
  }
  // @todo - action
?>

<hr/>

<h2>Статистика по полам: </h2>
<div>
  <h3>Жен</h3>
  <?
    foreach($femaleStatistic as $statKey => $statValue) {
      if (!array_key_exists($statKey, $labelsOnRussia)) {
        continue;
      } 

      echo "
      <p style=\"margin-left: 15px;\">
        <b>$labelsOnRussia[$statKey]</b>: $statValue
      </p>
      ";
    }
  ?>
  <h3>Муж</h3>
  <?
    foreach($maleStatistic as $statKey => $statValue) {
      if (!array_key_exists($statKey, $labelsOnRussia)) {
        continue;
      } 

      echo "
      <p style=\"margin-left: 15px;\">
        <b>$labelsOnRussia[$statKey]</b>: $statValue
      </p>
      ";
    }
  ?>
</div>