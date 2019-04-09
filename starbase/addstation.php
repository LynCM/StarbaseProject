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

// Get orbit info when first accessing page
$orbits = $_GET["Orbits"];


if($_GET["job"] == "submitted") {
   $name = $_POST["name"];
   $x = $_POST["x"];
   $y = $_POST["y"];
   $z = $_POST["z"];
   $orbits = $_POST["Orbits"];
   $tonnage = $_POST["tonnage"];
   $maxocc = $_POST["maxocc"];
   mysqli_query($con,"INSERT INTO Location (Name,x,y,z) Values ('$name',$x,$y,$z)");
   mysqli_query($con,"INSERT INTO Spacecraft (Name, Tonnage, Max_Occupancy) Values ('$name',$tonnage,$maxocc)");

   $result = mysqli_query($con,"SELECT Spacecraft_ID From Spacecraft Where Name ='$name'");
   $row = mysqli_fetch_array($result);
   $craftid = $row['Spacecraft_ID'];

   echo "INSERT INTO Space_Station Values ('$name',$craftid, '$orbits')";

   mysqli_query($con,"INSERT INTO Space_Station Values ('$name',$craftid, '$orbits')");
   header("Location:viewloc.php?job=locations");
}
?>

<form action="addstation.php?job=submitted" method="post">
   <input name="Orbits" type="hidden" value =<?php echo "'$orbits'"; ?>>
   <input name="name" type="hidden" value=<?php echo $row['Craft_ID'];?>>
   Name: <input type="text" name="name" value='<?php echo $row['Name'];?>'><br>
   Tonnage: <input type="number" name="tonnage" value='<?php echo $row['Tonnage'];?>'><br>
   MaxOccupancy: <input type="number" name="maxocc" value='<?php echo $row['MaxOccupancy'];?>'><br>
   <p>Coordinates</p>
   x: <input type="number" name="x" value='<?php echo $row['x'];?>'><br>
   y: <input type="number" name="y" value='<?php echo $row['y'];?>'><br>
   z: <input type="number" name="z" value='<?php echo $row['z'];?>'><br>
   <input type="submit" value="Submit">
</form>


<form action="groundcrew.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>
