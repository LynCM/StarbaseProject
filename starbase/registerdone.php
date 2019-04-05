
<html>
<body>

<?php

// Script that receives client account registration info and updates database

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$username = $_POST["username"];
$password = $_POST["password"];
$type = $_POST['type'];

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  // Add to person
  $sql = "INSERT INTO Person (Username, Password, First_Name, Last_Name, Type)
           VALUES ('". $username."','". $password."', '". $fname."','". $lname ."', '$type')";

 if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
} else {
  echo "SELECT PID from Person WHERE Username='$username'";

  $result = mysqli_query($con,"SELECT PID from Person WHERE Username='$username'");
  $row = mysqli_fetch_array($result);

  if ($type == 'Flight Crew') {
    $pid = $row['PID'];
    echo "INSERT INTO Crew_Member Values ($pid, 'Crew', NULL)";
    mysqli_query($con, "INSERT INTO Crew_Member Values ($pid, 'Crew', NULL)");   // TODO Add role selection?

  } else if ($type == 'Ground Control') {
    // Leaving this here in case we need a ground crew table
  }

  echo "Account successfully created for ". $fname. " ". $lname. "!";
}

mysqli_close($con);
?>

<a href="login.php">Return home</a>

</body>
</html>
