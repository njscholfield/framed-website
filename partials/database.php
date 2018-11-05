<?php 
  // DB constants are defined in env.php
  $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, USERNAME);
  if(mysqli_connect_errno()) {
    die("Error connecting to the database: ". mysqli_connect_error());
  }
?>