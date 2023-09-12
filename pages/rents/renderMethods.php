<?php
  function renderObjectCard($object) {
    $type =  $object->type ? "<span>Тип: $object->type.&nbsp;</span>" : "";
    $cost =  $object->cost ? "<span>Стоимость: $object->cost.&nbsp;</span>" : "";
?>
    <div>
      <span>Id: <?echo $object->id?>.&nbsp;</span>
      <?echo $type?>
      <?echo $cost?>
      <div style="display: flex; gap: 8px;">
        <form method="get" action="./index.php">
          <input type="text" value="<?echo $object->id?>" hidden name="idObject" />
          <input type="text" value="<?echo $object->cost?>" hidden name="costObject" />
          <input type="text" value="<?echo $object->type?>" hidden name="typeObject" />
          <input type="submit" value="Изменить" />
        </form>
        <form method="post" action="./handlers/delete.php">
          <input type="text" value="<?echo $object->id?>" hidden name="id" />
          <input type="submit" value="Удалить" />
        </form>
      </div>
    </div>  
<?php
}

function renderRenterCard($el) {
  $renterSurname =  $el->surname ? "<span>Фамилия: $el->surname.&nbsp;</span>" : "";
?>

<div>
  <span>Id: <?echo $el->id?>.&nbsp;</span>
  <?echo $renterSurname?>
  <div style="display: flex; gap: 8px;">
    <form method="get" action="./index.php">
      <input type="text" value="<?echo $el->id?>" hidden name="idRenter" />
      <input type="text" value="<?echo $el->surname?>" hidden name="surnameRenter" />
      <input type="submit" value="Изменить" />
    </form>
    <form method="post" action="./handlers/delete.php">
      <input type="text" value="<?echo $el->id?>" hidden name="idRenter" />
      <input type="submit" value="Удалить" />
    </form>
  </div>
  </div>  

<?php
}

function renderRentInfoCard ($el) {
?>
  <div>
    <span>Id: <?echo $el->id?>.&nbsp;</span>
    <?echo "Арендатор: " . $el->renterSurname . ". "?>
    <?echo "Тип объекта: " . $el->objectType . ". "?>
    <?echo "Длительность аренды: " . $el->rentLong . " месяца(ев). "?>
    <?echo "Дата начала аренды: " . $el->startingDate?>
    <div style="display: flex; gap: 8px;">
      <form method="get" action="./index.php">
        <input type="text" value="<?echo $el->id?>" hidden name="idRentInfo" />
        <input type="text" value="<?echo $el->objectId?>" hidden name="objectIdRentInfo" />
        <input type="text" value="<?echo $el->renterId?>" hidden name="renterIdRentInfo" />
        <input type="text" value="<?echo $el->rentLong?>" hidden name="rentLongRentInfo" />
        <input type="text" value="<?echo $el->startingDate?>" hidden name="startingDateRentInfo" />
        <input type="submit" value="Изменить" />
      </form>
      <form method="post" action="./handlers/delete.php">
        <input type="text" value="<?echo $el->id?>" hidden name="idRentInfo" />
        <input type="submit" value="Удалить" />
      </form>
    </div>
  </div>  
<?php
}
?>