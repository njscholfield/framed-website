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
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Dashboard</h1>
        </div>
      </div>
      <div class="container">
        <h1>Actions</h1>
        <ul>
          <li><a href="orders/">View All Orders</a></li>
          <li><a href="items/">Edit Item Details</a></li>
          <li><a href="add-item/">Add Item Details</a></li>
        </ul>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>
