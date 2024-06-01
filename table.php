<?php 
require("includes/header.php");

if (empty($_GET["database"]) OR empty($_GET["table"]))
{
    header("Location: index.php");
    exit;
}

$conn = db_connect();

$database_name = $_GET["database"];
$table_name = $_GET["table"];

$conn->select_db($database_name);

$sql = "SHOW COLUMNS FROM $table_name";
$collumns = $conn->query($sql) OR die("Fehler: ". $conn->error);

$sql = "SELECT * FROM $table_name";
$datas = $conn->query($sql) OR die("fehler: ". $conn->error);


db_close($conn);
?>
<body>
<h1><?= $table_name; ?></h1>
<table class="table table-striped">
  <thead>
    <tr>
      <?php
        if ($collumns->num_rows > 0) {
            // output data of each row
            while($row = $collumns->fetch_assoc()) {
                echo "<th scope='col'>";
                echo array_values($row)[0];
                echo "</th>";
            }
        }
      ?>
    </tr>
  </thead>
  <tbody>
      <?php
        if ($datas->num_rows > 0) {
        // output data of each row
        $counter = 0;
        while($row_data = $datas->fetch_assoc()) {
            $data = array_values($row_data);

            echo "<tr>";
            echo "<th scope='row'>$data[0]</th>";
            $count = 1;
            while ($count < count($data))
            {
                echo "<td>". $data[$count]. "</td>";
                $count++;
            }
            echo "</tr>";
        }
        } else {
        echo "<th>No Data</th>";
        echo "<td>No Data</td>";
        }
      ?>
  </tbody>
</table>
</body>