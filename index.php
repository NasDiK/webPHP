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
    $emailAddress = $argsLength >= 8 ? $args[7] : null; // Адрес электронной почты
    $phone = $argsLength >= 9 ? $args[8] : null; // Телефон
    $dateOfBirth = $argsLength >= 10 ? $args[9] : null; // Дата рождения
    $position = $argsLength >= 11 ? $args[10] : null; // Должность
    $company = $argsLength >= 12 ? $args[11] : null; // Компания
    $weight = $argsLength >= 13 ? $args[12] : null; // Вес
    $height = $argsLength >= 14 ? $args[13] : null; // Рост
    $mailAddress = $argsLength >= 15 ? $args[14] : null; // Почтовый адрес
    $mailZIP = $argsLength >= 16 ? $args[15] : null; // Почтовый индекс
    $contryCode = $argsLength >= 17 ? $args[16] : null; // Код страны

    echo $recordIndex . '/' . $district; 
  }
?>