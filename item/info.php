<?php 
  if(!isset($_ENV['SERVER_ROOT'])) {
    require('../partials/env.php');
  }
  require('../partials/database.php');
  if(isset($_GET) && isset($_GET['id'])) {
    $itemQuery = "SELECT * FROM FramedProducts WHERE productID = {$_GET['id']}";
    $itemInfo = mysqli_query($connection, $itemQuery);
    
    if($itemInfo && mysqli_num_rows($itemInfo) == 1) {
      echo json_encode(mysqli_fetch_assoc($itemInfo), true);
    }
  }
?>