<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<p>Adding new ship data</p>
<?php

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

print"Enter Entity Information";

if($_GET["job"] == "submitted") {
   $name = $_POST["name"];
   $role = $_POST["role"];
   $model = $_POST["model"];
   $tonnage = $_POST["tonnage"];
   $maxocc = $_POST["maxocc"];
   $station = $_POST["station"];

   // Add new spaceship to Spacecraft table
   mysqli_query($con,"INSERT INTO Spacecraft (Name, Tonnage, Max_Occupancy) Values ('$name',$tonnage,$maxocc)");
   $result = mysqli_query($con,
				"Select s.Spacecraft_ID
				From Spacecraft as s
				Where s.Name = '$name' and s.Tonnage = $tonnage and s.Max_Occupancy = $maxocc;");   // Get CraftID of the new spaceship
   $row = mysqli_fetch_array($result);
   $craftID = $row['Spacecraft_ID'];

   if ($station != "None") {      // If ship is docked at a station
     $result = mysqli_query($con,"SELECT Name from Spacecraft WHERE Spacecraft_ID = $station");
     $row = mysqli_fetch_array($result);
     $station = $row['Name'];         // Fetch the space station's name
   }

   mysqli_query($con,"INSERT INTO Spaceship Values ($craftID,'$name','$role', '$station')");   // Add spaceship to Spaceship table

   header("Location:viewspacecraft.php");    // Return to viewing page
}

// Print spaceship info form
echo "<form action='addcraft.php?job=submitted' method='post'>
   Name: <input type='text' name='name'><br>
   Model: <input type='text' name='model'><br>
   Role: <input type='text' name='role'><br>
   Tonnage: <input type='number' name='tonnage'><br>
   MaxOccupancy: <input type='number' name='maxocc'><br>";

   // Select all space stations
   $stations = mysqli_query($con,'SELECT Name, Spacecraft_ID FROM (Space_Station NATURAL JOIN Spacecraft)');

   // List space station names to dock spaceship to
     echo "Dock to Station:<br><select name='station'>";
     echo "<option value='None'>None</option>";
     while($row = mysqli_fetch_array($stations)) {
       echo "<option value =" . $row['Spacecraft_ID'] . ">" . $row['Name'] . "</option>";
     }
     echo "</select><br><br>";
   echo "<input type='submit' value='Submit'></form>";

mysqli_close($con);

?>

<form action="viewspacecraft.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>
