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
   $model = $_POST["model"];
   
   mysqli_query($con,"INSERT INTO Spacecraft Values ('$name',$tonnage,$maxocc)");
   $craftID = mysqli_query($con,
				"Select s.PID
				From Spacecraft as s
				Where s.Name = $Name, s.Tonnage = $tonnage, s.Max_Occupancy = $maxocc;");
   mysqli_query($con,"INSERT INTO Spaceship Values ($craftID,'$name','$role','$model')");
   
   header("Location:viewspacecraft.php");
}

mysqli_close($con);

?>
<form action="addcraft.php?job=submitted" method="post">
   <input name="id" type="hidden" value=<?php echo $row['Craft_ID'];?>>
   Name: <input type="text" name="name" value='<?php echo $row['Name'];?>'><br>
   Model: <input type="text" name="model" value='<?php echo $row['Model'];?>'><br>
   Role: <input type="text" name="role" value='<?php echo $row['Role'];?>'><br>
   Tonnage: <input type="number" name="tonnage" value='<?php echo $row['Tonnage'];?>'><br>
   MaxOccupancy: <input type="number" name="maxocc" value='<?php echo $row['MaxOccupancy'];?>'><br>
   <!-- Button to view and select possible space stations to select -->

   <input type="submit" value="Submit">
</form>


<form action="viewspacecraft.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>
