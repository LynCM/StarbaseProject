<?php

  function connect() {
    // Connect to database
    $con = mysqli_connect("localhost","root","pancakes","starbase");

    // Check connection
    if (mysqli_connect_errno($con)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $con;
  }
?>
