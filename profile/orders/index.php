<?php
  session_start();
  if(!isset($_SESSION['userID'])) {
    header("Location: ../../");
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define("PAGE_TITLE", "My Orders");
      require('../../partials/head.php');
    ?>
  </head>
  <body>
    <div class="f-pusher">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">My Orders</h1>
        </div>
      </div>
      <div class="container">
        <?php require('../../partials/navbar.php'); ?>
        <table class="table">
          <tr>
            <th>Order #</th>
            <th>Item Name</th>
            <th>Frame</th>
            <th>Shipping</th>
            <th>Status</th>
            <th>Date Ordered</th>
          </tr>
          <?php
            require('../../partials/database.php');
            $orderQuery = "SELECT FramedOrders.orderID, FramedProducts.productID, FramedProducts.name, frame, imageURL, shippingMethod, status, timestamp
                           FROM FramedOrders JOIN FramedOrderItems ON FramedOrders.orderID = FramedOrderItems.orderID
                                             LEFT JOIN FramedProducts ON FramedProducts.productID = FramedOrderItems.productID
                           WHERE userID = {$_SESSION['userID']};";
            $orders = mysqli_query($connection, $orderQuery);
            if(!$orders) {
              echo '<h4 class="text-danger">Error loading past orders</h4>';
            } else if(mysqli_num_rows($orders) == 0) {
              echo '<h4 class="text-info">Looks like you haven\'t ordered anything yet</h4>';
            } else {
              while($row = mysqli_fetch_assoc($orders)) {
                $dateString = date('M j, Y g:i A', strtotime($row['timestamp']));
                echo <<<HERE
                <tr>
                  <td>{$row['orderID']}</td>
                  <td><a href="{$_ENV["SERVER_ROOT"]}/item/?id={$row['productID']}">{$row['name']}</a></td>
                  <td>{$row['frame']}</td>
                  <td>{$row['shippingMethod']}</td>
                  <td>{$row['status']}</td>
                  <td>{$dateString}</td>
                </tr>
HERE;
              }
            }
          ?>
        </table>
      </div>
    </div>
    <?php include('../../partials/footer.php'); ?>
  </body>
</html>
