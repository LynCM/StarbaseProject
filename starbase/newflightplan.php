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
$Start = $_GET["StartTime"];
$End = $_GET["EndTime"];
$PID = $_GET["PID"];
$Budget = $_GET["Budget"];

if($_GET["job"] == "part1") {

}
if($_GET["job"] == "part2") {

}
if($_GET["job"] == "part3") {
$result = mysqli_query($con,"SELECT * FROM Location");
echo "<form action='newflightplan.php' method='post'><form>

<table border='1'>
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
//  echo "<td><a href='newflightplan.php?job=end&amp;Name=". $row['Name'] . "'>Start</a></td>";
  echo "<td><"

  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";
}

else if($_GET["job"] = "end") {
print($name);
$res2 = mysqli_query($con,"SELECT * FROM Location WHERE Name <> '$Name'");
echo "SELECT * FROM Location WHERE Name <>".$Name;
echo "<table border='1'>
<tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
</tr>";

while($row = mysqli_fetch_array($res2))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td><a href='newflightplan.php?job=fin&amp;Name=".$Name."&amp;Name2=".$row[Name]."'>Destination</a></td>";

  echo "</tr>";
  }
echo "</table>";
}

if($_GET["job"] == "fin") {
	mysqli_query($con,"INSERT INTO Flight_Plan VALUES ('$Ship','$StartTime','$EndTime','$Budget','$Name','$Name2')");


}
mysqli_close($con);
?>

<form action="groundcrew.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>
