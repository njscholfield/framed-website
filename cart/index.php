<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define("PAGE_TITLE", "Cart");
      require('../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/cart.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php include('../partials/navbar.php'); ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Cart</h1>
        </div>
      </div>
      <div class="container">
        <?php
          // Remove an item from the cart
          if(isset($_GET) && !empty($_GET['delete'])) {
            $id = $_GET['delete'];
            unset($_SESSION['cart'][$id][$_GET['i']]);
            $_SESSION['cart'][$id] = array_values($_SESSION['cart'][$id]);
          }
        ?>
        
        <?php if(!empty($_SESSION['cart'])):
          require('../partials/database.php');
          $totalPrice = 0;
          $ids = join(", ", array_keys($_SESSION['cart'])); 
          $itemsQuery = "SELECT productID, name, photographer, imageURL FROM FramedProducts WHERE productID IN ($ids);";
          $items = mysqli_query($connection, $itemsQuery);
        ?>
          <?php 
            while($row = mysqli_fetch_assoc($items)) {
              $cartItemArr = $_SESSION['cart'][$row['productID']];
              for($index = 0; $index < count($cartItemArr); $index++) {
                $cartItem = $cartItemArr[$index];
                $totalPrice += $cartItem['price'];
                echo <<<HERE
                <div class="cart-item row align-items-center">
                  <div class="col-auto">
                    <img class="cart-image" src="{$row['imageURL']}/350x250/">
                  </div>
                  <div class="col d-flex justify-content-between">
                    <div>
                      <a href="{$_ENV['SERVER_ROOT']}/item/?id={$row['productID']}"><h5>{$row['name']}</h5></a>
                      <h6>{$row['photographer']}</h6>
                      <small class="text-muted">Frame: {$cartItem['frame']}</small>
                    </div>
                    <div>
                      <p><strong>\${$cartItem['price']}</strong></p>
                      <a class="btn btn-sm btn-danger" href="./?delete={$row['productID']}&i={$index}"><span class="fas fa-times"></span></a>
                    </div>
                  </div>
                </div>
HERE;
              }
            }
            echo "<h4 class=\"text-right\">Total: \$$totalPrice</h4>";
          ?>
        <?php else: ?>
          <h4 class="text-info">You don't seem to have anything in your cart.</h4>
        <?php endif; ?>
      </div>
    </div>
    <?php include('../partials/footer.php') ?>
  </body>
</html>