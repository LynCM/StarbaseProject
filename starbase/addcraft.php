<html>
<body>
<?php
   if($_GET["job"] == "submitted") {
   $sql = 'INSERT INTO Spacecraft VALUES ($_POST["id"], $_POST["name"], $_POST["tonnage"], $_POST["maxocc"])';
   $sql = 'INSERT INTO Spaceship VALUES ($_POST["id"], $_POST["model"], $_POST["role"], $_POST["blah"])';
   header("Location:worldstate.php");
   exit();
}
?>
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
mysqli_close($con);
?>
<form action="addloc.php?job=submitted" method="post">
   <input name="Name" type="hidden" value=<?php echo $row['Craft_ID'];?>>
   Craft_ID: <input type="number" name="id" value='<?php echo $row['Craft_ID'];?>'><br>
   Name: <input type="text" name="name" value='<?php echo $row['Name'];?>'><br>
   Model: <input type="text" name="model" value='<?php echo $row['Model'];?>'><br>
   Role: <input type="text" name="role" value='<?php echo $row['Role'];?>'><br>
   Tonnage: <input type="number" name="tonnage" value='<?php echo $row['Tonnage'];?>'><br>
   MaxOccupancy: <input type="number" name="maxocc" value='<?php echo $row['MaxOccupancy'];?>'><br>
   <p> If Currently Docked </p>
   <!-- Button to view and select possible space stations to select -->

   <input type="submit" value="Submit">
</form>


<form action="worldstate.php" method="post">
   <input type="submit" value="Cancel">
</form>


</body>
</html>