<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php 
      define("PAGE_TITLE", "Item");
      require('../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/item.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php include('../partials/navbar.php'); ?>
      <div class="container">
        <?php 
          $itemID = $_GET['id'];
          require('../partials/database.php');
          $query = "SELECT * FROM products WHERE productID = $itemID";
          $result = mysqli_query($connection, $query);
          
          if($result && mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            print <<<HERE
            <div class="row">
              <div class="col-md-6 img-container">
                <img id="js-img-item" class="none" src="{$row['imageURL']}" alt="{$row['name']}">
                <div class="btn-tray">
                  <button data-class="wood-border" data-price="5" class="btn btn-dark border-toggle">Wood</button>
                  <button data-class="gray-border" data-price="3" class="btn btn-dark border-toggle">Gray</button>
                  <button data-class="none" data-price="0" class="btn btn-dark border-toggle">None</button>
                </div>
              </div>
              <div class="col-md-6 img-container">
                <div class="text-center">
                  <h1>{$row['name']}</h1>
                  <h3 class="text-muted">{$row['photographer']}</h3>
                  <h5 id="js-price">$10</h5>
                  <p>{$row['description']}</p>
                  <a class="btn btn-success" href="#"><span class="fas fa-heart"></span> Favorite</a>
                  <a class="btn btn-primary" href="#"><span class="fas fa-cart-plus"></span> Add to Cart</a>
                </div>
              </div>
            </div>
HERE;
          } else {
            echo '<h4 class="text-primary">Invalid product id. Try again!</h4>';
          }
          mysqli_close($connection);
        ?>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
    <script src="<?php path('/js/border.js'); ?>"></script>
  </body>
</html>