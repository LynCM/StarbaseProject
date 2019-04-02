<html>
<body>

<p>Listing all flights</p>

<?php

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

/*if ($_GET["job"] == "update"){

$ID = $_POST["ID"];
$name = $_POST["name"];
$email = $_POST["email"];

$result = mysqli_query($con,"update Users set name='".$name. "', email='". $email. "' where ID=". $ID);

}

if ($_GET["job"] == "delete"){
$ID = $_GET["ID"];
$result = mysqli_query($con,"Delete from Users where ID=". $ID );

} */

$result = mysqli_query($con,"SELECT * FROM Flight_Plan");

echo "<table border='1'>
<tr>
<th>Start Location</th>
<th>Destination</th>
<th>Start Time</th>
<th>End Time</th>
<th>Price</th>
<th>Spacecraft ID</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Start_Location'] . "</td>";
  echo "<td>" . $row['Destination'] . "</td>";
  echo "<td>" . $row['Start_Time'] . "</td>";
  echo "<td>" . $row['End_Time'] . "</td>";
  echo "<td>" . $row['Budget'] . "</td>";
  echo "<td>" . $row['Spacecraft_ID'] . "</td>";
  echo "<td><a href='book.php?ID= " . $row['ID'] . "'>Book</a></td>";
//  echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='view.php?job=delete&amp;ID= " . $row['ID'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>



</body>
</html>
