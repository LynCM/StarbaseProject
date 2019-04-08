<html>
<body>
  <?php
  session_start();

  // Check user session
  if ( !isset( $_SESSION['userID'] ) ) {
    // Redirect to login page if not logged in
    header("Location: login.php");
  }

  ?>

<p>Ground Crew Portal</p>

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

</body>
</html>
