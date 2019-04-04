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
   print($_POST["name"]);
   print($_POST["x"]);
   mysqli_query($con,'INSERT INTO Location Values ('.$_POST["name"].','. $_POST["x"].','. $_POST["y"].','. $_POST["z"].')');
   mysqli_query($con,'INSERT INTO Celestial_Body Values ('.$_POST["name"].','. $_POST["radius"].','. $_POST["mass"].')');
   header("Location:viewloc.php?job=locations");
}
mysqli_close($con);
?>
<form action="addloc.php?job=submitted" method="post">
   <input name="name" type="hidden" value=<?php echo $row['Name'];?>>
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