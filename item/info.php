<?php
  if(!isset($_ENV['SERVER_ROOT'])) {
    require('../partials/env.php');
  }
  if(isset($_GET) && isset($_GET['id'])) {
    require('../partials/database.php');
    $itemQuery = "SELECT * FROM FramedProducts WHERE productID = {$_GET['id']}";
    $itemInfo = mysqli_query($connection, $itemQuery);

    if($itemInfo && mysqli_num_rows($itemInfo) == 1) {
      echo json_encode(mysqli_fetch_assoc($itemInfo), true);
      mysqli_free_result($itemInfo);
    }
    mysqli_close($connection);
  }
?>
