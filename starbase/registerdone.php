
<html>
<body>

<?php

// Script that receives client account registration info and updates database

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$username = $_POST["username"];
$password = $_POST["password"];

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "INSERT INTO Person (Username, Password, First_Name, Last_Name, Type)
           VALUES ('". $username."','". $password."', '". $fname."','". $lname ."', 'Client')";

 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
} else {
  echo "Account successfully created for ". $fname. " ". $lname. "!";
}

mysqli_close($con);
?>

<a href="login.php">Return home</a>

</body>
</html>
