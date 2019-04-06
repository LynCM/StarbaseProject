<!-- Referenced for constructing login system: https://www.johnmorrisonline.com/build-php-login-form-using-sessions/ -->

<html>
<body>

<p><b>Starbase</b></p>

<form action="" method="post">
   Username: <input type="text" name="username"><br>
   Password: <input type="password" name="password"><br>
   <input type="submit" value="Sign in">
</form>
<br>

<?php
session_start();

if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        // Getting submitted user data from database
        $con = mysqli_connect("localhost","root","pancakes","starbase");

        // Check connection
        if (mysqli_connect_errno($con)){
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // Search for person w/ matching username
        $user = $_POST['username'];
        $result = mysqli_query($con,"SELECT * FROM Person WHERE Username = '$user'");

        // If no user was found
        if (!$result) {
          echo "Invalid username\n";
        } else {
          $row = mysqli_fetch_array($result);        // Get the user's row in table

          // Verify user password
          if ($row['Password'] == $_POST['password']) {

            $_SESSION['userID'] = $row['PID'];     // Set user session
          // Redirect logged in user to correct page based on their user role
          // Referenced: https://www.sitepoint.com/community/t/redirecting-users-to-different-pages-according-to-their-roles/7539/2
            switch ($row['Type']) {
              case 'Client':
                $redirect = 'client.php';
                break;
              case 'Ground Control':
                $redirect = 'groundcrew.php';
                break;
              case 'Flight Crew':
                $redirect = 'flightcrew.php';
                break;
            }
            header('Location: ' . $redirect);

          } else {
            // Inform user that login attempt failed
            echo "Incorrect password entered\n";
          }
        }
      mysqli_close($con);      // Close connection
    }
}
?>

<a href="register.php">Create a new account</a>

</body>
</html>
