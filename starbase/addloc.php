<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<p>Adding new data</p>
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
   $x = $_POST["x"];
   $y = $_POST["y"];
   $z = $_POST["z"];
   $radius = $_POST["radius"];
   $mass = $_POST["mass"];
   mysqli_query($con,"INSERT INTO Location Values ('$name','$x','$y','$z')");
   mysqli_query($con,"INSERT INTO Celestial_Body Values ('$name','$radius','$mass')");
   header("Location:viewloc.php?job=locations");
}
mysqli_close($con);
?>
<form action="addloc.php?job=submitted" method="post">
   <input name="name" type="hidden" value=<?php echo $row['Name'];?>>
   Name: <input type="text" name="name" value='<?php echo $row['Name'];?>'><br>
   Radius: <input type="number" name="radius" value='<?php echo $row['Radius'];?>'><br>
   Mass: <input type="number" name="mass" value='<?php echo $row['Mass'];?>'><br>
   <p>Coordinates</p>
   x: <input type="number" name="x" value='<?php echo $row['x'];?>'><br>
   y: <input type="number" name="y" value='<?php echo $row['y'];?>'><br>
   z: <input type="number" name="z" value='<?php echo $row['z'];?>'><br>
   <input type="submit" value="Submit">
</form>


<form action="worldstate.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>
