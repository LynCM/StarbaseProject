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

print"Select which you would like to add to the database"
//go to view ship instead first and then click add?
?>


<form action="addloc.php?job=body" method="post">
  <input type="submit" value="Add Celestial Body">
</form>

<form action="addcraft.php?job=craft" method="post">
   <input type="submit" value="Add Spacecraft">
</form>



<form action="groundcrew.php" method="post">
   <input type="submit" value="Done">
</form>


</body>
</html>
