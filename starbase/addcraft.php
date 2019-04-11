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

   // Add new spaceship to Spacecraft table
   mysqli_query($con,"INSERT INTO Spacecraft (Name, Tonnage, Max_Occupancy) Values ('$name',$tonnage,$maxocc)");
   $result = mysqli_query($con,
				"Select s.Spacecraft_ID
				From Spacecraft as s
				Where s.Name = '$name' and s.Tonnage = $tonnage and s.Max_Occupancy = $maxocc;");   // Get CraftID of the new spaceship
   $row = mysqli_fetch_array($result);
   $craftID = $row['Spacecraft_ID'];
   mysqli_query($con,"INSERT INTO Spaceship (Spacecraft_ID, Model, Role) Values ($craftID,'$name','$role')");   // Add spaceship to Spaceship table

   header("Location:viewspacecraft.php");    // Return to viewing page
}

mysqli_close($con);

?>
<form action="addcraft.php?job=submitted" method="post">
   Name: <input type="text" name="name"><br>
   Model: <input type="text" name="model"><br>
   Role: <input type="text" name="role"><br>
   Tonnage: <input type="number" name="tonnage"><br>
   MaxOccupancy: <input type="number" name="maxocc"><br>

   <!-- Button to view and select possible space stations to select -->

   <input type="submit" value="Submit">
</form>


<form action="viewspacecraft.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>
