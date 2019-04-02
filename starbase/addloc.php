<html>
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
   $sql = 'INSERT INTO Location VALUES ($_POST["name"], $_POST["x"], $_POST["y"], $_POST["z"])';
   $sql = 'INSERT INTO Celestial_Body VALUES ($_POST["name"], $_POST["radius"], $_POST["mass"])';
}
mysqli_close($con);
?>
<form action="addloc.php?job=submitted" method="post">
   <input name="Name" type="hidden" value=<?php echo $row['Name'];?>>
   Name: <input type="text" name="name" value='<?php echo $row['Name'];?>'><br>
   Radius: <input type="text" name="radius" value='<?php echo $row['Radius'];?>'><br>
   Mass: <input type="text" name="mass" value='<?php echo $row['Mass'];?>'><br>   
   <p>Cords</p>
   x: <input type="text" name="x" value='<?php echo $row['x'];?>'><br>
   y: <input type="text" name="y" value='<?php echo $row['y'];?>'><br>
   z: <input type="text" name="z" value='<?php echo $row['z'];?>'><br>
   <input type="submit" value="Submit">
</form>


<form action="worldstate.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>