<?php
  // DB constants are defined in env.php which is only on the SIS server so it is not public anywhere
  $connection = mysqli_connect($_SERVER['DB_HOSTNAME'], $_SERVER['DB_USERNAME'], $_SERVER['DB_PASSWORD'], $_SERVER['DB_DATABASE']);
  if(mysqli_connect_errno()) {
    die("Error connecting to the database: ". mysqli_connect_error());
  }
?>
