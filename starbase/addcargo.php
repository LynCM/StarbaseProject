<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

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

      // After receiving cargo form data
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mass = $_POST["mass"];
        $isdanger = $_POST["isdanger"];
        $desc = $_POST["desc"];
        $pid = $_SESSION['userID'];

        // Add cargo to database
        mysqli_query($con, "INSERT INTO Cargo (Mass, Is_Dangerous, Description, Owner_PID) Values ($mass, $isdanger, '$desc', $pid)");

        mysqli_close($con);    // Close connection
        header("Location: client.php");     // Go back to client page
      }

      mysqli_close($con);    // Close connection

    } else {
      // Redirect to login page
      header("Location: login.php");
    }

 ?>
    <form action = "addcargo.php" method = "post">
      <label>Cargo Mass (kg):</label>
      <input type = "number" name = "mass" id = "mass" />
      <br />
      <br />

      <label>Dangerous?</label><br>
      <input type = "radio" name = "isdanger" value = "True" />Yes<br>
      <input type = "radio" name = "isdanger" value = "False" />No<br>
      <br />
      <br />

       <label>Description:</label>
       <input type = "text" name = "desc" size="30" />
       <br />
      <br />

       <button type="submit" class="btn" name="submitcargo">Submit</button>
       <br />
    </form>


</body>
</html>
