<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<p>Adding new space station</p>
<?php
// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$planetdata = mysqli_query($con,"SELECT * FROM Location,Celestial_Body WHERE Name = Location_Name");
echo "<table border='1'><tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
<th>Mass</th>
<th>Radius</th></tr>";
print("Choose a Celestial Body for the Station to Orbit");
while($row = mysqli_fetch_array($planetdata))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td>" . $row['Mass'] . "</td>";
  echo "<td>" . $row['Radius'] . "</td>";
  echo "<td><a href='addstation.php?job=info&amp;Orbits=" . $row['Name'] . "'>Select</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";


?>
