
<?php

$name = $_POST["name"];
$email = $_POST["email"];

echo $name. "<br>". $email. "<br>";


// Create connection
$con=mysqli_connect("localhost","root","123456","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "INSERT INTO users (Name, Email) VALUES ('". $name."','". $email ."')";
 
 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
echo "1 record added";

mysqli_close($con);
?>

