<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

  <h1>Ground Crew Portal</h1>

<form action="assigncrew.php?job=pickcrew" method="post">
   <input type="submit" value="Assign Crew">
</form>

<form action="viewloc.php?job=locations" method="post">
   <input type="submit" value="View All Locations">
</form>

<form action="newflightplan.php?job=start" method="post">
   <input type="submit" value="Add New Flight">
</form>

<form action="viewspacecraft.php?job=locations" method="post">
   <input type="submit" value="View All Spacecraft">
</form><br>

<button onclick="window.location.href = 'login.php';">Log out</button>

<?php
include 'functions.php';

session_start();

// Check user session
if ( !isset( $_SESSION['userID'] ) ) {
  // Redirect to login page if not logged in
  header("Location: login.php");
} else {
  // Connect to database
  $con = connect();

  // Display flights this ground crew member is currently planning
  echo '<div><br><p>Your Planned Flights</p></div>';

  $pid = $_SESSION['userID'];
  $sql = "SELECT * from (Flight_Plan as f JOIN Planned_By as p ON (f.Spacecraft_ID = p.Spacecraft_ID
    and f.Start_Time = p.Flight_Plan_Start_Time and f.End_Time = p.Flight_Plan_End_Time)) WHERE Ground_Control_PID = $pid";

  // TODO: Adjust to display spacecraft name instead of ID (more user friendly), units for price and more readable time format?
  echo "<div><table border='1'>
  <tr>
  <th>Start Location</th>
  <th>Destination</th>
  <th>Start Time</th>
  <th>End Time</th>
  <th>Price</th>
  <th>Spacecraft ID</th>
  </tr>";
  if ($result = mysqli_query($con, $sql)) {      // If search returns something
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['Start_Location'] . "</td>";
      echo "<td>" . $row['Destination'] . "</td>";
      echo "<td>" . $row['Start_Time'] . "</td>";
      echo "<td>" . $row['End_Time'] . "</td>";
      echo "<td>" . $row['Budget'] . "</td>";
      echo "<td>" . $row['Spacecraft_ID'] . "</td>";
  /*    echo "<td><a onClick= \"return confirm('Do you want to cancel this flight?')\"
            href='client.php?job=cancel&amp;spacecraftid= " . $row['Spacecraft_ID'] . "&starttime=" .
            $row['Start_Time'] . "&endtime=" . $row['End_Time'] . "'>Cancel</a></td>"; */

      echo "</tr>";
      }
  }
  echo "</table></div>";

}

?>

</body>
</html>
