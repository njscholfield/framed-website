<?php
  session_start();
  if(!isset($_SESSION['userID'])) {
    header("Location: /workspace//workspace/");
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define("PAGE_TITLE", "My Orders");
      require('/workspace/partials/head.php');
    ?>
  </head>
  <body>
    <div class="f-pusher">
      <?php require('/workspace/partials/navbar.php'); ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">My Orders</h1>
        </div>
      </div>
      <div class="container">
        <?php
          require('/workspace/partials/database.php');
          // Query all orders for a user
          $orderQuery = "SELECT FramedOrders.orderID, FramedProducts.productID, FramedProducts.name, frame, imageURL, shippingMethod, status, timestamp
                         FROM FramedOrders JOIN FramedOrderItems ON FramedOrders.orderID = FramedOrderItems.orderID
                                           LEFT JOIN FramedProducts ON FramedProducts.productID = FramedOrderItems.productID
                         WHERE userID = {$_SESSION['userID']};";
          $orders = mysqli_query($connection, $orderQuery);
          if(!$orders) {
            echo '<h4 class="text-danger">Error loading past orders</h4>';
          } else if(mysqli_num_rows($orders) == 0) {
            echo '<h4 class="text-info">Looks like you haven\'t ordered anything yet.</h4>';
          } else {
            echo '<table class="table"><tr><th>Order #</th><th>Item Name</th><th>Frame</th><th>Shipping</th><th>Status</th><th>Date Ordered</th></tr>';
            $last = 0;
            while($row = mysqli_fetch_assoc($orders)) {
              $orderID = ($last == $row['orderID']) ? '' : $row['orderID']; // only show the order id for the first item
              $dateString = date('M j, Y g:i A', strtotime($row['timestamp'])); // make timestamp nicer
              echo <<<HERE
              <tr>
                <td>$orderID</td>
                <td><a href="{$_ENV["SERVER_ROOT"]}/item/?id={$row['productID']}">{$row['name']}</a></td>
                <td>{$row['frame']}</td>
                <td>{$row['shippingMethod']}</td>
                <td>{$row['status']}</td>
                <td>{$dateString}</td>
              </tr>
HERE;
              $last = $row['orderID'];
            }
            echo "</table>";
            mysqli_free_result($orders);
          }
          mysqli_close($connection);
        ?>
      </div>
    </div>
    <?php include('/workspace/partials/footer.php'); ?>
  </body>
</html>
