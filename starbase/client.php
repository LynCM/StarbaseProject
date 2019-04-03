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

    // Link to search for more flights
    echo '<div><br><button onclick="window.location.href = \'viewflights.php\';">Book Flights</button>';

    // Display currently booked flights
    echo '<div><br><p>Your Flights</p></div>';

    $pid = $row['PID'];
    $sql = "'SELECT * from (Flight_Plan as F JOIN Transports as T ON
      (f.Spacecraft_ID = t.Spacecraft_ID and f.Start_Time = t.Flight_Plan_Start_Time and f.End_Time = f.Flight_Plan_End_Time)
      where Client_PID ='". $pid ;

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
        // TODO Adjust to actually display seat number and allow user to cancel booking
        echo "<td>" . "filler" . "</td>";
        echo "<td><a onClick= \"return confirm('Do you want to cancel your booking?')\" href='view.php?job=delete&amp;ID= " . $row['ID'] . "'>Cancel</a></td>";

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
    <th>Spacecraft ID</th>
    </tr>";

    if ($result = mysqli_query($con, $sql)) {      // If search returns something
      while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['Cargo_ID'] . "</td>";
        echo "<td>" . $row['Mass'] . "</td>";
        echo "<td>" . $row['Is_Dangerous'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Spacecraft_ID'] . "</td>";
        // TODO Make cargo removable??
        echo "<td><a onClick= \"return confirm('Do you want to remove this cargo?')\" href='view.php?job=delete&amp;ID= " . $row['ID'] . "'>Cancel</a></td>";

        echo "</tr>";
        }
    }
    echo "</table></div>";

  } else {
    // Redirect to login page
    header("Location: login.php");
  }

  mysqli_close($con);    // Close connection

?>



</body>
</html>
