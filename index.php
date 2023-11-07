<?
  $lines = file(__DIR__ . '/вар1.csv');
  $allRows = []; $groupedByVidTransporta = [];

  foreach($lines as $lineIdx => $lineValue) {
    $splitted = explode(';', $lineValue);
    $newRow = array(
      'vidTransporta' => $splitted[0],
      'marka' => $splitted[1],
      'rashod' => $splitted[2]
    );

    array_push(
      $allRows,
      $newRow
    );

    if (
      $lineIdx !== 0 &&
      !isset(
        $groupedByVidTransporta[
          $newRow['vidTransporta']
        ]
      )
    ) {
      $groupedByVidTransporta[$newRow['vidTransporta']] = [];
    }

    $lineIdx !== 0 && array_push($groupedByVidTransporta[$newRow['vidTransporta']], $newRow);
  }

  $headers = array_splice($allRows, 0, 1);
?>

<select onchange="onChangeVidTransporta(this.value)">
<?
    foreach(array_keys($groupedByVidTransporta) as $rowIdx => $rowValue) {
  ?>
    <option value="<? echo $rowValue; ?>">
      <? echo $rowValue; ?>
    </option>
  <?
    }
  ?>
  <option selected disabled hidden>Вид транспорта</option>
<select>
<select id="marka" disabled onchange="onChangeMark(this.value)">
  <option selected disabled hidden>Марка автомобиля</option>  
</select>
<input
  type="number"
  min="0"
  placeholder="Расстояние"
  onchange="onChangeDistance(this.value)"
  id="distance"
/>
<input type="text" disabled id="rashod" />

<script>
  const rashod = document.getElementById('rashod');
  const distance = document.getElementById('distance');
  let loadedMarks, selectedMark;

  const onChangeDistance = (value) => {
    const selectedMarkRow = loadedMarks.find(({marka})=> marka === selectedMark);

    rashod.value = Number.parseFloat(selectedMarkRow['rashod']) / 100 * Number.parseFloat(value) + ' л./100 км'
  }

  const onChangeMark = (value) => {
    selectedMark = value;
    distance.disabled = false;
  }

  const onChangeVidTransporta = (value) => {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          const result = JSON.parse(this.responseText);
          loadedMarks = result;
          
          document.getElementById("marka").innerHTML = result.reduce((acc, curV) => {
            return acc + `<option value="${curV['marka']}">${curV['marka']}</option>`;
          }, '');
          document.getElementById("marka").disabled = false;
        }
      };
    xhr.open("GET", "actions/getMarks.php?vidTransporta=" + value);
    xhr.send();
  }
</script>
