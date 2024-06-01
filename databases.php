<?php 
require("includes/header.php");

$conn = db_connect();

if (empty($_GET["database"]))
{
    $select = "DATABASES";
    $select_file = "databases.php";
    $select_name = "Database";
    $database_name = "";
}
else
{   
    $database_name = $_GET["database"];
    $select = "TABLES";
    $select_file = "table.php";
    $select_name = "Tables_in_$database_name";

    $conn->select_db($database_name);
}

$sql = "SHOW $select";
$result = $conn->query($sql) OR die("Fehler: ". $conn->error);

db_close($conn);
?>
<body>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Database</th>
    </tr>
  </thead>
  <tbody>
      <!-- <td><a href="table.php?databse=" class="btn btn-primary">NAME</a></td> -->
      <?php
        if ($result->num_rows > 0) {
        // output data of each row
        $counter = 0;
        while($row = $result->fetch_assoc()) {
            $counter++;
            $location = $row[$select_name];
            $database_name = ($select == "DATABASES") ? $location : $database_name;
            echo "<tr>";
            echo "<th scope='row'>$counter</th>";
            echo "<td><a href='$select_file?database=$database_name&table=$location' class='btn btn-primary'>". $location."</a></td>";
            echo "</tr>";
        }
        } else {
        echo "<td>No Data</td>";
        echo "<td>No Data</td>";
        }
      ?>
  </tbody>
</table>
</body>