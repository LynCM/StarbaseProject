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

if($_GET["job"] == "stations") {
   $locdata = mysqli_query($con,"SELECT * FROM Location,Space_Station WHERE Name = Location_Name");
   $param1 = "Craft_ID";
   $param2 = "Oribits";
} else if($_GET["job"] == "planets") {
   $locdata = mysqli_query($con,"SELECT * FROM Location,Celestial_Body WHERE Name = Location_Name");
   $param1 = "Radius";
   $param2 = "Mass";
} else if($_GET["job"] == "locations") {
   $locdata = mysqli_query($con,"SELECT * FROM Location");//,Celestial_Body,Space_Station WHERE Name = Location_Name");
   $param1 = "Radius";
   $param2 = "Mass";
}
//mysqli_query($con,"INSERT INTO Celestial_Body VALUES ('Earth', 40, 40)");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
<th>".$param1."</th>
<th>".$param2."</th>
</tr>";

while($row = mysqli_fetch_array($locdata))
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

mysqli_close($con);
?>

<form action="addloc.php?job=add" method="post">
  <input type="submit" value="New Celestial Body">
</form>


</body>
</html>