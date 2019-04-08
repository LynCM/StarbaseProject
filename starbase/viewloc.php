<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
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

$stationdata = mysqli_query($con,"SELECT * FROM Location,Space_Station WHERE Name = Location_Name");
$param1 = "Craft_ID";
$param2 = "Oribits";
echo "<table border='1'><tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
<th>".$param1."</th>
<th>".$param2."</th></tr>";
print("Space Stations");
while($row = mysqli_fetch_array($stationdata))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td>" . $row[$param1] . "</td>";
  echo "<td>" . $row[$param2] . "</td>";
  echo "<td><a href='addloc.php?job=edit&amp;Name= " . $row['Name'] . "'>Edit</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";
?>

<form action="selectorbit.php" method="post">
  <input type="submit" value="New Space Station">
</form>

<?php
$planetdata = mysqli_query($con,"SELECT * FROM Location,Celestial_Body WHERE Name = Location_Name");
$param1 = "Radius";
$param2 = "Mass";
echo "<table border='1'><tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
<th>".$param1."</th>
<th>".$param2."</th></tr>";
print("Celestial Bodies");
while($row = mysqli_fetch_array($planetdata))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td>" . $row[$param1] . "</td>";
  echo "<td>" . $row[$param2] . "</td>";
  echo "<td><a href='addloc.php?job=edit&amp;Name=" . $row['Name'] . "'>Edit</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>

<form action="addloc.php?job=add" method="post">
  <input type="submit" value="New Celestial Body">
</form>

<button onclick="window.location.href = 'groundcrew.php';">Return</button>


</body>
</html>
