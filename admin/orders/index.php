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
        require('../../partials/database.php');
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">All Orders</h1>
        </div>
      </div>
      <div class="container" id="vue">
        <?php
          if(isset($_POST) && isset($_POST['orderID']) && is_numeric($_POST['orderID'])) {
            $updateQuery = "UPDATE FramedOrders
                            SET status = '{$_POST['status']}'
                            WHERE orderID = {$_POST['orderID']}";
            $successful = mysqli_query($connection, $updateQuery);
            if($successful) {
              echo '<h4 class="text-success">Successfully updated status!</h4>';
            } else {
              echo '<h4 class="text-danger">Error updating status!</h4>';
            }
          }
        ?>
        <h4 class="text-warning">Filter orders by user, item(reports?), status, date</h4>
        <form action="" method="get">
          <div class="form-group">
            <label>Status</label>
            <div class="input-group">
              <select class="form-control" name="status">
                <option value="">Any</option>
                <option <?php if(!empty($_GET['status']) && $_GET['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                <option <?php if(!empty($_GET['status']) && $_GET['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                <option <?php if(!empty($_GET['status']) && $_GET['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Apply</button>
              </div>
            </div>
          </div>
        </form>
        <?php
          $orderQuery = "SELECT FramedOrders.orderID, FramedOrders.name AS custName, FramedProducts.productID, FramedProducts.name, frame, shippingMethod, status, timestamp
                         FROM FramedOrders JOIN FramedOrderItems ON FramedOrders.orderID = FramedOrderItems.orderID
                                           LEFT JOIN FramedProducts ON FramedProducts.productID = FramedOrderItems.productID";
          if(isset($_GET) && !empty($_GET['status'])) {
            $statusOptions = ["Processing", "Shipped", "Delivered"];
            $statusFilter = (in_array($_GET['status'], $statusOptions)) ? $_GET['status'] : null;
          }

         $orderQuery .= (isset($statusFilter)) ? " WHERE status = '{$_GET['status']}';" : ";";
         $orders = mysqli_query($connection, $orderQuery);
         if (!$orders) {
           echo '<h4 class="text-danger">Error loading past orders</h4>';
         } else if(mysqli_num_rows($orders) == 0) {
           echo '<h4 class="text-info">No matching orders found.</h4>';
         } else {
           echo '<table class="table"><tr><th>Order #</th><th>Item Name</th><th>Customer</th><th>Frame</th><th>Shipping</th><th>Status</th><th>Date Ordered</th></tr>';
           $last = 0;
           while($row = mysqli_fetch_assoc($orders)) {
             $orderID = ($last == $row['orderID']) ? '' : $row['orderID']; // only show the order id for the first item
             $dateString = date('M j, Y g:i A', strtotime($row['timestamp']));
             echo <<<HERE
             <tr>
               <td><a class="btn btn-link text-primary" @click="openOrderModal($orderID)">$orderID</a></td>
               <td><a href="{$_ENV["SERVER_ROOT"]}/item/?id={$row['productID']}">{$row['name']}</a></td>
               <td>{$row['custName']}</td>
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
       <b-modal ref="orderModal" title="Order Info" @ok="submitForm" ok-title="Save" tabindex="-1" role="dialog" aria-hidden="true">
         <h6>Order #</h6>
         <p>{{ orderInfo.orderID }}</p>
         <h6>Shipping Address</h6>
         <p class="mb-0">{{ orderInfo.name }}</p>
         <p class="mb-0">{{ orderInfo.stAddress }}</p>
         <p class="mb-0">{{ orderInfo.stAddress2 }}</p>
         <p>{{ orderInfo.city }}, {{ orderInfo.state }} {{ orderInfo.zip}}</p>
         <h6>Shipping Method</h6>
         <p>{{ orderInfo.shippingMethod }}</p>
         <h6>Phone</h6>
         <p>{{ orderInfo.phone }}</p>
         <h6>Items Ordered</h6>
         <div class="table-responsive">
           <table class="table">
             <tr>
               <th>Name</th>
               <th>Photographer</th>
               <th>Frame</th>
               <th>Description</th>
             </tr>
             <tr v-for="item in orderInfo.items">
               <td><a :href="'<?php echo $_ENV['SERVER_ROOT'];?>/item?id=' + item.productID" target="_blank">{{ item.name }}</a></td>
               <td>{{ item.photographer }}</td>
               <td>{{ item.frame }}</td>
               <td>{{ item.description }}</td>
             </tr>
           </table>
         </div>
         <h6>Order Date</h6>
         <p>{{ orderInfo.timestamp }}</p>
         <h6>Order Status</h6>
         <form action="" method="POST" id="form">
           <input type="hidden" name="orderID" :value="orderInfo.orderID">
           <select class="form-control" name="status">
             <option :selected="orderInfo.status === 'Processing'">Processing</option>
             <option :selected="orderInfo.status === 'Shipped'">Shipped</option>
             <option :selected="orderInfo.status === 'Delivered'">Delivered</option>
           </select>
         </form>
         <br>
       </b-modal>
     </div>
    </div>
    <?php include('../../partials/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="<?php path('/js/orderInfo.js'); ?>"></script>
  </body>
</html>
