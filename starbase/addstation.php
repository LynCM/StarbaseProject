<html>
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
if($_GET["job"] == "info") {
}
$orbits = $_POST["Orbits"];

if($_GET["job"] == "submitted") {
   $name = $_POST["name"];
   $x = $_POST["x"];
   $y = $_POST["y"];
   $z = $_POST["z"];
   $tonnage = $_POST["tonnage"];
   $maxocc = $_POST["maxocc"];
   mysqli_query($con,"INSERT INTO Location (Name,x,y,z) Values ('$name','$x','$y','$z')");
   mysqli_query($con,"INSERT INTO Spacecraft (Name, Tonnage, Max_Occupancy) Values ('$name','$tonnage','$maxocc')");
   $result = mysqli_query($con,"SELECT Craft_ID From Spacecraft Where Name ='$name'");
   mysqli_query($con,"INSERT INTO Space_Station Values ('$name',12,'$orbits')");
   header("Location:viewloc.php?job=locations");
}
?>

<form action="addstation.php?job=submitted" method="post">
   <input name="name" type="hidden" value=<?php echo $row['Craft_ID'];?>>
   Name: <input type="text" name="name" value='<?php echo $row['Name'];?>'><br>
   Tonnage: <input type="number" name="tonnage" value='<?php echo $row['Tonnage'];?>'><br>
   MaxOccupancy: <input type="number" name="maxocc" value='<?php echo $row['MaxOccupancy'];?>'><br>
   <p>Cords</p>
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