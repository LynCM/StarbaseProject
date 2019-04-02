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

if($_GET["job"] == "pickcrew") {
$result = mysqli_query($con,"SELECT * FROM Crew_Member");

echo "<table border='1'>
<tr>
<th>PID</th>
<th>Role</th>
<th>Assigned_Spacecraft</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['PID'] . "</td>";
  echo "<td>" . $row['Role'] . "</td>";
  echo "<td>" . $row['Assigned_Spacecraft'] . "</td>";
  echo "<td><a href='assigncrew.php?PID= " . $row['PID'] . "'>Select</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
if($_GET[PID] != NULL) {
$result = mysqli_query($con,"SELECT * FROM Spacecraft");

echo "<table border='1'>
<tr>
<th>Name</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td><a href='assigncrew.php?Name= " . $row['Name'] . "'>Assign</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
if($_GET["Name"] != NULL) {
   print"Flight Crew has been assigned to Spacecraft ".$name;
   $PID = $_GET[PID];
   $Craft_ID = $_GET[Craft_ID];
   $result = mysqli_query($con,"update Crew_Member set assigned_spacecraft=".$craft_id."where PID=".$PID);
   //update number of people in the ship??
   
   }

mysqli_close($con);
?> 

<form action="groundcrew.php" method="post">
   <input type="submit" value="Done">
</form>




</body>
</html>