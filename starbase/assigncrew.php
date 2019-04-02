<html>
<body>

<p>Assigning Crew to Ships</p>

<?php

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$PID = $_GET[PID];
$Craft_ID = $_GET[Craft_ID];
if($_GET["job"] == "pickcrew") {
$result = mysqli_query($con,"SELECT * FROM Crew_Member");

echo "<table border='1'>
<tr>
<th>PID</th>
<th>Role/th>
<th>Assigned_Spacecraft</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['PID'] . "</td>";
  echo "<td>" . $row['Role'] . "</td>";
  echo "<td>" . $row['Assigned_Spacecraft'] . "</td>";
  echo "<td><a href='assigncrew.php?PID= ?job=pickship" . $row['PID'] . "'>Select</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
if($_GET["job"] == "pickship") {
$result = mysqli_query($con,"SELECT * FROM Spacecraft");

echo "<table border='1'>
<tr>
<th>Craft_ID</th>
<th>Name</th>
<th>Type</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Craft_ID'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td><a href='assign.php?Craft_ID= ?job=done" . $row['Craft_ID'] . "'>Assign</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
if($_GET["job"] == "done") {
   $PID = $_GET[PID];
   $Craft_ID = $_GET[Craft_ID];
   $result = mysqli_query($con,"update Crew_Member set assigned_spacecraft=".$craft_id."where PID=".$PID);
   //update number of people in the ship??
   }

mysqli_close($con);
?> 




</body>
</html>