<?php
  session_start();
  // User must be logged in and an Admin to view this page
  if(!isset($_SESSION['userID']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../");
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define("PAGE_TITLE", "Dashboard");
      require('../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/admin.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php
        include('../partials/navbar.php');
        include('../partials/adminSidebar.php');
        include('../partials/database.php');
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Dashboard</h1>
        </div>
      </div>
      <div class="container">
        <div class="card">
          <div class="card-header text-white bg-success">
            Pending Orders
          </div>
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
              $orderQuery = "SELECT FramedOrders.orderID, FramedProducts.productID, FramedProducts.name, frame, imageURL, shippingMethod, status, timestamp
                             FROM FramedOrders JOIN FramedOrderItems ON FramedOrders.orderID = FramedOrderItems.orderID
                                          LEFT JOIN FramedProducts ON FramedProducts.productID = FramedOrderItems.productID
                             WHERE status = 'Processing';";
              $results = mysqli_query($connection, $orderQuery);
              if($results) {
                $last = 0;
                while($row = mysqli_fetch_assoc($results)) {
                  $orderID = ($last == $row['orderID']) ? '' : $row['orderID']; // only show the order id for the first item
                  $dateString = date('M j, Y g:i A', strtotime($row['timestamp']));
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
                mysqli_free_result($results);
              }
              mysqli_close($connection);
            ?>
          </table>
        </div>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>
