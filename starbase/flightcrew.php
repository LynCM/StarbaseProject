<html>
<body>

  <p>Crew page</p>

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

      // Get user info
      $result = mysqli_query($con,"SELECT * FROM (Crew_Member as c NATURAL JOIN Person AS p) WHERE PID = " . $_SESSION['userID']);
      $row = mysqli_fetch_array($result);

      // Print welcome message
      echo "Welcome, " . $row['First_Name'] . "! <br><br>";

      $spacecraftid = $row['Assigned_Spacecraft'];
      $result = mysqli_query($con, "SELECT * FROM Spacecraft WHERE Spacecraft_ID=$spacecraftid");
      $spacecraftrow = mysqli_fetch_array($result);

      // Display spaceship assignment and role
      echo "Assigned to spacecraft: " . $spacecraftrow['Name'] . "<br><br>";
      echo "Role: " . $row['Role'] . "<br><br>";

      // Display ship's flight plans
      $sql = "SELECT * FROM Flight_Plan WHERE Spacecraft_ID=$spacecraftid";

      echo "Upcoming Flights:<br><br>
      <div><table border='1'>
      <tr>
      <th>Start Location</th>
      <th>Destination</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Budget</th>
      </tr>";
      if ($result = mysqli_query($con, $sql)) {      // If search returns something
        while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row['Start_Location'] . "</td>";
          echo "<td>" . $row['Destination'] . "</td>";
          echo "<td>" . $row['Start_Time'] . "</td>";
          echo "<td>" . $row['End_Time'] . "</td>";
          echo "<td>" . $row['Budget'] . "</td>";
          echo "</tr>";
          }
      }
      echo "</table></div>";
      mysqli_close($con);    // Close connection

    } else {
      // Redirect to login page
      header("Location: starbase/login.php");
    }

  ?>

  <br><br><div><a href="login.php">Log out</a></div>

</body>
</html>
