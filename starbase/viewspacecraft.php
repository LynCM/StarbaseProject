<html>
<body>

<p>All Locations:</p>


<?php

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//mysqli_query($con,"INSERT INTO Celestial_Body VALUES ('Earth', 40, 40)");

$spacecrafts = mysqli_query($con,"SELECT * FROM Spacecraft");
$ships = mysqli_query($con,"SELECT * FROM Spaceship");
$stations = mysqli_query($con,"SELECT * FROM Space_Station");

echo "<table border='1'><tr>
<th>CraftID</th>
<th>Name</th>
<th>Tonnage</th>
<th>MaxOccupancy</th>
<th>Model</th>
<th>Role</th>
<th>Docked</th></tr>";

print("Spacecraft");
while($row = mysqli_fetch_array($ships))
  {
  echo "<tr>";
  echo "<td>" . $row['Spacecraft_ID'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Tonnage'] . "</td>";
  echo "<td>" . $row['Max_Occupancy'] . "</td>";
  echo "<td>" . $row['Model'] . "</td>";
  echo "<td>" . $row['Role'] . "</td>";
  echo "<td>" . $row['Docked'] . "</td>";
  //echo "<td><a href='addcraft.php?job=edit&amp;Name= " . $row['Name'] . "'>Edit</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";
?>

<form action="addcraft.php?job=add" method="post">
  <input type="submit" value="New Spacecraft">
</form>

  <button onclick="window.location.href = 'groundcrew.php';">Return</button>


</body>
</html>
