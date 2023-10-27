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
    'contryCode' => 'Код страны'
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
  $parsedRows = array();
  
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
    $contryCode = $argsLength >= 17 ? returnFirstMatch($args[6], '/^[A-Z]{2}$/') : null; // Код страны (Aplha2 ISO???)

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
<div style="width: 100%; height: 500px; overflow: auto">
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

<?
  $changedRows = array();

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

  foreach($parsedRows as $rowIndex => $row) {
    $newRow = array(
      'recordIndex' => str_pad($row['recordIndex'], 6, '0', STR_PAD_LEFT),
      'name' => $row['name'],
      'patronymicInitial' => $row['patronymicInitial'],
      'lastname' => $row['lastname'],
      'sex' => $row['sex'],
      'city' => $row['city'],
      'district' => $row['district'],
      'emailAddress' => $row['emailAddress'],
      'phone' => formatPhone($row['phone']),
      'dateOfBirth' => $row['dateOfBirth'],
      'position' => $row['position'],
      'company' => $row['company'],
      'weight' => round(floatval($row['weight']), 0, PHP_ROUND_HALF_UP),
      // 'weight' => $row['weight'],
      'height' => $row['height'],
      'mailAddress' => $row['mailAddress'],
      'mailZIP' => $row['mailZIP'],
      'contryCode' => $row['contryCode']
    );
  
    array_push($changedRows, $newRow);
  }
?>

<h2>Таблица преобразованных значений (п.2): </h2>
<div style="width: 100%; height: 500px; overflow: auto">
  <table border="1">
    <tr>
      <? foreach($labelsOnRussia as $key => $val) { echo "<th>$val ($key)</th>"; } ?>
    </tr>
    <?
      foreach($changedRows as $rowIndex => $row) {
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

<?
// п.2 сделан. 
// @todo - Запись в файл. 
// @todo - статистика
// @todo - action
?>