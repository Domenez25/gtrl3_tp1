<?php
class Student
{
  public $module;
  public $coef;
  public $note;

  public function __construct($module, $coef, $note)
  {
    $this->module = $module;
    $this->coef = $coef;
    $this->note = $note;
  }
}

class note extends Student
{
  public function __construct($module, $coef, $note)
  {
    parent::__construct($module, $coef, $note);
  }
}

$labels = array();
$coefs = array();
$notes = array();
if (isset($_POST["n"])) {
  $n = $_POST["n"];
}
if (isset($_POST["calculate"])) {
  for ($i = 1; $i <= $n; $i++) {
    $labels[] = $_POST["module$i"];
    $coefs[] = (float)$_POST["coef$i"];
    $notes[] = (float)$_POST["note$i"];
  }

  function calculateaverage($n, $coefs, $notes)
  {

    $sum = 0;
    $totalcoef = array_sum($coefs);

    for ($i = 0; $i < $n; $i++) {
      $sum = $sum + $coefs[$i] * $notes[$i];
    }

    if ($totalcoef > 0) {
      return $sum / $totalcoef;
    } else {
    }
  }
  $average = calculateaverage($n, $coefs, $notes);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Student note Report</title>
   <style>
    body {
      text-align: center;
    }
  </style>
   
  <script>
    function createTable() {
      const n = parseInt(document.getElementById("n").value);
      const tableContainer = document.getElementById("tableContainer");

      const table = document.createElement("table");
      table.border = "1";

      const headerRow = table.insertRow(0);
      headerRow.insertCell(0).innerHTML = "Subject";
      headerRow.insertCell(1).innerHTML = "coef";
      headerRow.insertCell(2).innerHTML = "note";

      for (let i = 1; i <= n; i++) {
        const row = table.insertRow(i);
        row.insertCell(0).innerHTML = `<input type="text" name="module${i}" />`;
        row.insertCell(1).innerHTML = `<input type="number" name="coef${i}" />`;
        row.insertCell(2).innerHTML = `<input type="number" name="note${i}" />`;
      }

      tableContainer.innerHTML = "";
      tableContainer.appendChild(table);
    }
  </script>
</head>

<body>
  <h1>Student note Report</h1>

  <form method="POST" action="index.php">
    <p>
      <label for="n">Give the number of subjects: </label>
      <input type="number" id="n" name="n" required="required" min="1" value="1" />
    </p>
    <p>
      <input type="button" value="Create Table" onclick="createTable();" />
    </p>
    <div id="tableContainer"></div>
    <p>
      <input type="submit" name="calculate" value="Calculate" />
    </p>
  </form>

  <?php if (isset($_POST["calculate"])) { ?>
    
    <table border="1">
      <tr>
        <th>Subject</th>
        <th>coef</th>
        <th>note</th>
      </tr>
      <?php for ($i = 0; $i < $n; $i++) { ?>
        <tr>
          <td><?php echo $labels[$i]; ?></td>
          <td><?php echo $coefs[$i]; ?></td>
          <td><?php echo $notes[$i]; ?></td>
        </tr>
      <?php } ?>
    </table>

    <p>Average note: <?php echo number_format($average, 2); ?>

    </p>
  <?php } ?>
	<a href="tp1.php"><h2><b>Home</b></h2></a>
</body>

</html>