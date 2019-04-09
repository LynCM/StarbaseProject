<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<p>Assigning Crew to Ships</p>


<?php

// Create connection
$con=mysqli_connect("localhost","root","pancakes","starbase");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if($_GET["job"] == "pickcrew") {

// Select all crew members and their assigned spaceship
$result = mysqli_query($con,"SELECT * FROM (Crew_Member JOIN Person ON Person.PID = Crew_Member.PID)
                              LEFT OUTER JOIN Spacecraft AS s ON s.Spacecraft_ID = Crew_Member.Assigned_Spacecraft");

echo "<table class='center' border='1'>
<tr>
<th>PID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Role</th>
<th>Assigned Spaceship</th>
</tr>";

// Display all crew members
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['PID'] . "</td>";
  echo "<td>" . $row['First_Name'] . "</td>";
  echo "<td>" . $row['Last_Name'] . "</td>";
  echo "<td>" . $row['Role'] . "</td>";
  if (!$row['Name']) {
    echo "<td>None</td>";
  } else {
    echo "<td>" . $row['Name'] . "</td>";       // Print assigned spaceship name
  }
  echo "<td><a href='assigncrew.php?PID=" . $row['PID'] . "'>Select</a></td>";
  echo "</tr>";
  }
echo "</table>";
}

// Assign a spacecraft to chosen crew member
if($_GET[PID] != NULL) {
$result = mysqli_query($con,"SELECT * FROM (Spacecraft NATURAL JOIN Spaceship)");
$pid = $_GET[PID];

echo "<table border='1'>
<tr>
<th>Name</th>
</tr>";

while($row = mysqli_fetch_array($result))        // Display all spacecraft
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td><a href='assigncrew.php?craftid=" . $row['Spacecraft_ID'] ."&PID=$pid'>Assign</a></td>";
  echo "</tr>";
  }
echo "</table>";
}

if($_GET["craftid"] != NULL) {
//   print"Flight Crew has been assigned to Spacecraft ".$name;
   $PID = $_GET['PID'];
   $craftid = $_GET['craftid'];

   $result = mysqli_query($con,"update Crew_Member set Assigned_Spacecraft=$craftid where PID= $PID");
   //update number of people in the ship??

   // Return to crew member selection page
   header("Location: assigncrew.php?job=pickcrew");
   }

mysqli_close($con);
?>

<form action="groundcrew.php" method="post">
   <input type="submit" value="Done">
</form>


</body>
</html>
