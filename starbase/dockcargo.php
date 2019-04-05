<html>
<body>
  <?php

  $spacecraftid = $_POST["spacecraftid"];

  // Connect to database
  $con = mysqli_connect("localhost","root","pancakes","starbase");

  // Check connection
  if (mysqli_connect_errno($con)){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  // Dock cargo to this spacecraft
  if ($_GET["job"] == "dock"){
    $spacecraftid = $_GET['spacecraftid'];
    $cargoid = $_GET['cargoid'];
    $result = mysqli_query($con,"UPDATE Cargo SET Spacecraft_ID = $spacecraftid WHERE Cargo_ID = $cargoid");
  }

  // Undock cargo from this spacecraft
  if ($_GET["job"] == "undock"){
    $spacecraftid = $_GET['spacecraftid'];
    $cargoid = $_GET['cargoid'];
    $result = mysqli_query($con,"UPDATE Cargo SET Spacecraft_ID = NULL WHERE Cargo_ID = $cargoid");
  }

  // Fetch spacecraft info
  $result = mysqli_query($con, "SELECT * FROM Spacecraft WHERE Spacecraft_ID=$spacecraftid");
  $spacecraftrow = mysqli_fetch_array($result);
  echo "Spacecraft " . $spacecraftrow['Name'] . "'s Current Cargo:<br><br>";

  // List cargo currently on the ship
  $sql = "SELECT * FROM Cargo WHERE Spacecraft_ID = " . $spacecraftid;

  echo "<div><table border='1'>
  <tr>
  <th>Cargo ID</th>
  <th>Mass</th>
  <th>Dangerous?</th>
  <th>Description</th>
  <th>Assigned Spacecraft ID</th>
  <th>Owner ID</th>
  </tr>";

  if ($result = mysqli_query($con, $sql)) {      // If search returns something
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['Cargo_ID'] . "</td>";
      echo "<td>" . $row['Mass'] . "</td>";
      if (!$row['Is_Dangerous']) {     // More readable output for IsDangerous flag
        echo "<td>Yes</td>";
      } else {
        echo "<td>No</td>";
      }
      echo "<td>" . $row['Description'] . "</td>";
      echo "<td>" . $row['Spacecraft_ID'] . "</td>";
      echo "<td>" . $row['Owner_PID'] . "</td>";
      // Link to cargo management page
      echo "<td><a onClick= \"return confirm('Do you want to undock this cargo?')\" href='dockcargo.php?job=undock&amp;
                             cargoid= " . $row['Cargo_ID'] . "&spacecraftid=" . $row['Spacecraft_ID'] . "')>Undock</a></td>";
      echo "</tr>";
      }
  }
  echo "</table></div><br><br>";

  // List cargo that is not docked anywhere
  echo "Available cargo:<br><br>";
  $sql = "SELECT * FROM Cargo WHERE Spacecraft_ID IS NULL";

  echo "<div><table border='1'>
  <tr>
  <th>Cargo ID</th>
  <th>Mass</th>
  <th>Dangerous?</th>
  <th>Description</th>
  <th>Owner ID</th>
  </tr>";

  if ($result = mysqli_query($con, $sql)) {      // If search returns something
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['Cargo_ID'] . "</td>";
      echo "<td>" . $row['Mass'] . "</td>";
      if (!$row['Is_Dangerous']) {     // More readable output for IsDangerous flag
        echo "<td>Yes</td>";
      } else {
        echo "<td>No</td>";
      }
      echo "<td>" . $row['Description'] . "</td>";
      echo "<td>" . $row['Owner_PID'] . "</td>";
      echo "<td><a onClick= \"return confirm('Do you want to dock this cargo?')\" href='dockcargo.php?job=dock&amp;cargoid= " . $row['Cargo_ID'] .
                              "&spacecraftid=" . $spacecraftid . "'>Dock</a></td>";
      echo "</tr>";
      }
  }
  echo "</table></div><br><br>";

  ?>

  <button onclick="window.location.href = 'flightcrew.php';">Return</button>


</body>
</html>
