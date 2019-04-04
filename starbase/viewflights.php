<html>
<body>

<p>Listing available flights</p>


<div><br><button onclick="window.location.href = 'client.php'";>Return</button></div><br>

<?php

  session_start();

  // Check if user is logged in
  if ( isset( $_SESSION['userID'] ) ) {
    // Create connection
    $con=mysqli_connect("localhost","root","pancakes","starbase");

    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      // If user books a flight
    if ($_GET["job"] == "book"){
      $spacecraftid = $_GET['spacecraftid'];
      $starttime = $_GET['starttime'];
      $endtime = $_GET['endtime'];

      // Update transports table
      $sql = "INSERT INTO Transports (Spacecraft_ID, Flight_Plan_Start_Time, Flight_Plan_End_Time, Client_PID)
                Values ". "($spacecraftid, '$starttime', '$endtime', " . $_SESSION['userID'] . ")";

      $result = mysqli_query($con, $sql);
    }

    $pid = $_SESSION['userID'];

    // Display available flights (not booked by user)
    $result = mysqli_query($con,"SELECT f.* FROM (Flight_Plan as f) WHERE NOT EXISTS
                              (SELECT * from Transports as t WHERE f.Spacecraft_ID = t.Spacecraft_ID
                                and f.Start_Time = t.Flight_Plan_Start_Time and f.End_Time = t.Flight_Plan_End_Time
                                  and t.Client_PID = $pid)");

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
      echo "<td><a onClick= \"return confirm('Do you want to book this flight?')\"
            href='viewflights.php?job=book&amp;spacecraftid=" . $row['Spacecraft_ID'] . "&starttime=" .
            $row['Start_Time'] . "&endtime=" . $row['End_Time'] . "'>Book</a></td>";

      echo "</tr>";
      }
    echo "</table>";

    mysqli_close($con);

} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>

</body>
</html>
