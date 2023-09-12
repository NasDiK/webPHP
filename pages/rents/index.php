<?php
    require_once 'C:\ospanel\domains\laba11.com\utils\services\index.php';
    require_once 'C:\ospanel\domains\laba11.com\utils\renderNavigation.php';
    
    renderNavigation(false);
    
    $api = new ServicesApi();
?>

<?php
  $updateRenter = (object)[];

  if (isset($_GET['idRenter'])) {
    $updateRenter->id = $_GET['idRenter'];
  }

  if (isset($_GET['surnameRenter'])) {
    $updateRenter->surname = $_GET['surnameRenter'];
  }

  $updateObject = (object)[];

  if (isset($_GET['idObject'])) {
    $updateObject->id = $_GET['idObject'];
  }

  if (isset($_GET['costObject'])) {
    $updateObject->cost = $_GET['costObject'];
  }

  if (isset($_GET['typeObject'])) {
    $updateObject->type = $_GET['typeObject'];
  }

  $updateRentInfo = (object)[];

  if (isset($_GET['idRentInfo'])) {
    $updateRentInfo->id = $_GET['idRentInfo'];
  }

  if (isset($_GET['objectIdRentInfo'])) {
    $updateRentInfo->objectId = $_GET['objectIdRentInfo'];
  }

  if (isset($_GET['renterIdRentInfo'])) {
    $updateRentInfo->renterId = $_GET['renterIdRentInfo'];
  }

  if (isset($_GET['rentLongRentInfo'])) {
    $updateRentInfo->rentLong = $_GET['rentLongRentInfo'];
  }

  if (isset($_GET['startingDateRentInfo'])) {
    $updateRentInfo->startingDate = $_GET['startingDateRentInfo'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аренда</title>
  </head>
  <body>
    <div class="objects">
      <h2>Все объекты</h2>

      <?php
      require_once('C:\ospanel\domains\laba11.com\pages\rents\renderMethods.php');
      $objects = $api->rents()->getAllObjects();

      foreach($objects as $el) {
        renderObjectCard($el);
      }
      ?>
    </div>
    <div>
      <h2>Добавить объект</h2>

      <form method="post" action="./handlers/create.php">
        <input type="text" placeholder="Тип" name="typeAdd" />
        <input type="number" placeholder="Стоимость" name="costAdd" />
        <input type="submit" value="Создать объект" name="submit" />
      </form>
    </div>
    <div>
      <h2>Изменить объект</h2>

      <form method="post" action="./handlers/update.php">
        <input 
          type="text" 
          placeholder="Тип" 
          name="type" 
          value="<?php echo isset($updateObject->type) ? $updateObject->type : "" ?>"          
          <?php echo isset($updateObject->id) ? null : "disabled" ?>
        />
        <input 
          type="text" 
          placeholder="Стоимость" 
          name="cost"
          value="<?php echo isset($updateObject->cost) ? $updateObject->cost : "" ?>"          
          <?php echo isset($updateObject->id) ? null : "disabled" ?>
        />
        <input 
          type="text" 
          name="id"
          value="<?php echo "$updateObject->id" ?>"          
          hidden
        />
        <input 
          type="submit" 
          value="Редактировать" 
          <?php echo isset($updateObject->id) ? null : "disabled" ?>
        />
      </form>
    </div>

    <div class="objects">
      <h2>Все арендаторы</h2>

      <?php
      require_once('C:\ospanel\domains\laba11.com\pages\rents\renderMethods.php');
      $renters = $api->rents()->getAllRenters();

      foreach($renters as $el) {
        renderRenterCard($el);
      }
      ?>
    </div>
    <div>
      <h2>Добавить арендатора</h2>

      <form method="post" action="./handlers/create.php">
        <input type="text" placeholder="Фамилия" name="surnameAddRenter" />
        <input type="submit" value="Создать арендатора" name="submit" />
      </form>
    </div>
    <div>
      <h2>Изменить арендатора</h2>

      <form method="post" action="./handlers/update.php">
        <input 
          type="text" 
          placeholder="Фамилия" 
          name="surnameRenter" 
          value="<?php echo isset($updateRenter->surname) ? $updateRenter->surname : "" ?>"          
          <?php echo isset($updateRenter->id) ? null : "disabled" ?>
        />
        <input 
          type="text" 
          name="idRenter"
          value="<?php echo "$updateRenter->id" ?>"          
          hidden
        />
        <input 
          type="submit" 
          value="Редактировать" 
          <?php echo isset($updateRenter->id) ? null : "disabled" ?>
        />
      </form>
    </div>

    <div class="objects">
      <h2>Вся информация об арендах</h2>

      <?php
      require_once('C:\ospanel\domains\laba11.com\pages\rents\renderMethods.php');
      $rentInfos = $api->rents()->getAllRentInfos();

      foreach($rentInfos as $el) {
        renderRentInfoCard($el);
      }
      ?>
    </div>
    <div>
      <h2>Добавить аренд-инфо</h2>

      <form method="post" action="./handlers/create.php">
        <input type="number" placeholder="Ид объекта" name="objectIdAddRentInfo" />
        <input type="number" placeholder="Рентер ид" name="renterIdAddRentInfo" />
        <input type="number" placeholder="Длительность аренды (мес)" name="rentLongAddRentInfo" />
        <input type="date" placeholder="Дата начала" name="startingDateAddRentInfo" />

        <input type="submit" value="Создать аренд-информацию" name="submit" />
      </form>
    </div>
    <div>
      <h2>Изменить аренд-инфо</h2>

      <form method="post" action="./handlers/update.php">
        <input 
          type="number" 
          placeholder="Ид объекта" 
          name="objectIdRentInfo" 
          value="<?php echo isset($updateRentInfo->objectId) ? $updateRentInfo->objectId : "" ?>"          
          <?php echo isset($updateRentInfo->id) ? null : "disabled" ?>
        />
        <input 
          type="number" 
          placeholder="Ид арендатора" 
          name="renterIdRentInfo" 
          value="<?php echo isset($updateRentInfo->renterId) ? $updateRentInfo->renterId : "" ?>"          
          <?php echo isset($updateRentInfo->id) ? null : "disabled" ?>
        />
        <input 
          type="number" 
          placeholder="Длительность аренды (мес)" 
          name="rentLongRentInfo" 
          value="<?php echo isset($updateRentInfo->rentLong) ? $updateRentInfo->rentLong : "" ?>"          
          <?php echo isset($updateRentInfo->id) ? null : "disabled" ?>
        />
        <input 
          type="date" 
          placeholder="Дата начала аренды" 
          name="startingDateRentInfo" 
          value="<?php echo isset($updateRentInfo->startingDate) ? $updateRentInfo->startingDate : "" ?>"          
          <?php echo isset($updateRentInfo->id) ? null : "disabled" ?>
        />
        <input 
          type="text" 
          name="idRentInfo"
          value="<?php echo "$updateRentInfo->id" ?>"          
          hidden
        />
        <input 
          type="submit" 
          value="Редактировать" 
          <?php echo isset($updateRentInfo->id) ? null : "disabled" ?>
        />
      </form>
    </div>
  </body>
</html>