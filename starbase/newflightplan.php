<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

session_start();

// Check user session
if ( isset( $_SESSION['userID'] ) ) {

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$Name = $_GET["Name"];
$Name2= $_GET["Name2"];
$Ship = $_GET["ShipID"];
$Start = $_GET["StartTime"];
$End = $_GET["EndTime"];
$PID = $_GET["PID"];
$Budget = $_GET["Budget"];

if($_GET["job"] == "start") {
$result = mysqli_query($con,"SELECT * FROM Location");
echo

"<p>Select a start location</p>
<table border='1'>
<tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  $name = $row['Name'];
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td><a href='newflightplan.php?job=end&amp;Name=". $row['Name'] . "'>Start</a></td>";
//  echo "<td><input type='radio' name='start' value=$name"

  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='addloc.php?job=delete&amp;Name= " . $row['Name'] . "'>DELETE</a></td>";

  echo "</tr>";
  }
echo "</table>";
}

else if($_GET['job'] == "end") {
  $Name = $_GET['Name'];

$res2 = mysqli_query($con,"SELECT * FROM Location WHERE Name <> '$Name'");
//echo "SELECT * FROM Location WHERE Name <>".$Name;
echo "
<p>Select a destination</p>
<table border='1'>
<tr>
<th>Name</th>
<th>x</th>
<th>y</th>
<th>z</th>
</tr>";

while($row = mysqli_fetch_array($res2))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['x'] . "</td>";
  echo "<td>" . $row['y'] . "</td>";
  echo "<td>" . $row['z'] . "</td>";
  echo "<td><a href='newflightplan.php?job=fin&amp;Name=".$Name."&amp;Name2=".$row[Name]."'>Destination</a></td>";

  echo "</tr>";
  }
echo "</table>";
}

if($_GET["job"] == "fin") {
  $Start = $_GET['Name'];
  $End = $_GET['Name2'];

  echo "Start: $Start<br> Destination: $End<br>

  <form action='newflightplan.php?job=insert' method='post'>
  <label>Spaceship: </label>";

  $ships = mysqli_query($con,"SELECT Name, Spacecraft_ID FROM (Spaceship NATURAL JOIN Spacecraft)");

  echo "<select name='Ship'>";
  while($row = mysqli_fetch_array($ships)) {
    echo "<option value =" . $row['Spacecraft_ID'] . ">" . $row['Name'] . "</option>";
    echo $row['Spacecraft_ID'];
  }

  echo "</select>
  <br><br>
  <p> Military Time Format: YYYY-MM-DD HH:MM:SS</p><br><br>
  <label>Start Time: </label><input type = 'text' name = 'StartTime'/>

  <input type='hidden' name='Start' value = $Start>
  <input type='hidden' name='End' value = $End>

  <br>
  <br>
  <label>End Time: </label><input type = 'text' name = 'EndTime'/>

  <br>
  <br>
  <label>Budget: </label><input type = 'text' name = 'Budget'/><br><br>

  <button type='submit' class='btn' name='addflight'>Add Flight</button>

  </form>";

}

if($_GET["job"] == "insert") {
  $Start = $_POST['Start'];
  $End = $_POST['End'];
  $Ship = $_POST['Ship'];
  $StartTime = $_POST['StartTime'];
  $EndTime = $_POST['EndTime'];
  $Budget = $_POST['Budget'];

  mysqli_query($con,"INSERT INTO Flight_Plan VALUES ($Ship,'$StartTime','$EndTime',$Budget,'$Start','$End')");
  // Note the ground control user who planned this flight
  $pid = $_SESSION['userID'];
  mysqli_query($con, "INSERT INTO Planned_By VALUES ($Ship, '$StartTime','$EndTime', $pid)");

  echo "Flight successfully added.";
}

mysqli_close($con);

} else {
  // Redirect to login page
  header("Location: login.php");
}
?>

<form action="groundcrew.php" method="post">
   <input type="submit" value="Exit">
</form>


</body>
</html>
