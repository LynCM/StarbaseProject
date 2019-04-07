<html>
<body>

  <p>Client Portal</p>

<?php
  session_start();

  // Check user session
  if ( isset( $_SESSION['userID'] ) ) {
    // Connect to database
    $con = mysqli_connect("localhost","root","pancakes","starbase");

    // Check connection
    if (mysqli_connect_errno($con)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Fetch client data
    $result = mysqli_query($con,"SELECT * FROM Person WHERE PID = " . $_SESSION['userID']);
    $row = mysqli_fetch_array($result);

    // Print welcome message
    echo "Welcome, " . $row['First_Name'] . "!\n";

    // If user cancels their flight booking
    if ($_GET["job"] == "cancel"){

      $spacecraftid = $_GET['spacecraftid'];
      $starttime = $_GET['starttime'];
      $endtime = $_GET['endtime'];
      $pid = $_SESSION['userID'];

      $result = mysqli_query($con,"DELETE FROM Transports WHERE Spacecraft_ID = $spacecraftid and
                Flight_Plan_Start_Time = '$starttime' and Flight_Plan_End_Time = '$endtime' and Client_PID = $pid");
    }

    // If user removes their cargo
    if ($_GET["job"] == "remove") {
      $cargoid = $_GET['cargoid'];
      mysqli_query($con, "DELETE FROM Cargo WHERE Cargo_ID = $cargoid");
    }

    // Link to search for more flights and add cargo
    echo '<div><br><button onclick="window.location.href = \'viewflights.php\';">Book Flights</button>';
    echo '<div><br><button onclick="window.location.href = \'addcargo.php\';">Add Cargo</button>';

    // Display currently booked flights
    echo '<div><br><p>Your Flights</p></div>';

    $pid = $row['PID'];
    $sql = "SELECT * from (Flight_Plan as F JOIN Transports as T ON(f.Spacecraft_ID = t.Spacecraft_ID
      and f.Start_Time = t.Flight_Plan_Start_Time and f.End_Time = t.Flight_Plan_End_Time)) WHERE Client_PID = $pid";


    // TODO: Adjust to display spacecraft name instead of ID (more user friendly), units for price and more readable time format?
    echo "<div><table border='1'>
    <tr>
    <th>Start Location</th>
    <th>Destination</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Price</th>
    <th>Spacecraft ID</th>
    <th>Seat No</th>
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
        echo "<td>" . $row['Seat_No'] . "</td>";
        echo "<td><a onClick= \"return confirm('Do you want to cancel your booking?')\"
              href='client.php?job=cancel&amp;spacecraftid= " . $row['Spacecraft_ID'] . "&starttime=" .
              $row['Start_Time'] . "&endtime=" . $row['End_Time'] . "'>Cancel</a></td>";

        echo "</tr>";
        }
    }
    echo "</table></div>";

    // Display client cargo
    echo '<br><div><p>Your Cargo</p></div>';
    $sql = "SELECT * FROM Cargo WHERE Owner_PID=" . $pid;

    echo "<div><table border='1'>
    <tr>
    <th>Cargo ID</th>
    <th>Mass</th>
    <th>Dangerous?</th>
    <th>Description</th>
    <th>Assigned Spacecraft ID</th>
    </tr>";

    if ($result = mysqli_query($con, $sql)) {      // If search returns something
      while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['Cargo_ID'] . "</td>";
        echo "<td>" . $row['Mass'] . "</td>";
        if (!$row['Is_Dangerous']) {     // More readable output for IsDangerous flag
          echo "<td>Yes</td>";
        } else {
          echo "<td>No</td>";
        }
        echo "<td>" . $row['Description'] . "</td>";
        if ($row['Spacecraft_ID'] == NULL) {
          echo "<td>Not assigned</td>";
        } else {
          echo "<td>" . $row['Spacecraft_ID'] . "</td>";
        }
        echo "<td><a onClick= \"return confirm('Do you want to remove this cargo?')\" href='client.php?job=remove&amp;cargoid= " . $row['Cargo_ID'] . "'>Remove</a></td>";
        echo "</tr>";
        }
    }
    echo "</table></div><br><br>";

    mysqli_close($con);    // Close connection

  } else {
    // Redirect to login page
    header("Location: login.php");
  }

?>

<button onclick="window.location.href = 'login.php';">Log out</button>

</body>
</html>
