<html>
<body>

<?php

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

print"Select a start location";
$Name = $_GET["Name"];
$Name2= $_GET["Name2"];
$Ship = $_GET["ShipID"];

if($_GET["job"] == "start") {
$result = mysqli_query($con,"SELECT * FROM Location");
echo "<table border='1'>
<tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td><a href='newflightplan.php?job=end&amp;Name= ". $row['Name'] . "'>Start</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";
}

if($_GET["job"] == "end") {
print($name);
$result = mysqli_query($con,"SELECT * FROM Location");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td><a href='newflightplan.php?job=fin&amp;Name=".$Name."&amp;Name2=".$row[Name]."'>Start</a></td>";

  echo "</tr>";
  }
echo "</table>";
}

if($_GET["job"] == "fin") {
	header("Location:assignflight.php?Start=$Name&End=$Name2");
	//set the 2 to a new flight plan
	//calculate the distance between the 2 as well
}
mysqli_close($con);
?>

<form action="groundcrew.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>