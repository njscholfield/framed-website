<?php
  session_start();
  // User must be logged in and an Admin to view this page
  if(!isset($_SESSION['userID']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../../");
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define("PAGE_TITLE", "All Orders");
      require('../../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/admin.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php
        include('../../partials/navbar.php');
        include('../../partials/adminSidebar.php');
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">All Orders</h1>
        </div>
      </div>
      <div class="container">
        <h4 class="text-danger">Need to add person who ordered each item, another join...</h4>
        <h4 class="text-warning">Filter orders by user, item(reports?), status, date</h4>
        <?php
          require('../../partials/database.php');
          $orderQuery = "SELECT FramedOrders.orderID, FramedProducts.productID, FramedProducts.name, frame, imageURL, shippingMethod, status, timestamp
                         FROM FramedOrders JOIN FramedOrderItems ON FramedOrders.orderID = FramedOrderItems.orderID
                                           LEFT JOIN FramedProducts ON FramedProducts.productID = FramedOrderItems.productID;";
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
           echo "</table>";
           mysqli_free_result($orders);
         }
         mysqli_close($connection);
       ?>
     </div>
    </div>
    <?php include('../../partials/footer.php'); ?>
  </body>
</html>
