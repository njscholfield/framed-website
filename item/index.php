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

          if(isset($_POST) && !empty($_POST['action']) && isset($_SESSION['loggedIn'])) {
            if($_POST['action'] == "AddFavorite") {
              addItemToFavorites($itemID);
            } elseif($_POST['action'] == "AddToCart") {
              addItemToCart($itemID);
            }
          }

          function addItemToFavorites($itemID) {
            global $connection;
            $insertQuery = "INSERT INTO FramedFavorites VALUES({$_SESSION['userID']}, {$itemID});";
            $result = mysqli_query($connection, $insertQuery);
            if(!$result) {
              echo '<h4 class="text-danger">Error adding item to favorites!</h4>';
            }
          }

          function addItemToCart($itemID) {
            // NEED TO COME BACK AND VERIFY PRICE - CAN CURRENTLY CHANGE FORM TO MAKE ITEM $0
            if(!isset($_SESSION['cart'])) {
              $_SESSION['cart'] = [$itemID=>[["frame"=>$_POST['frame'], "price"=>$_POST['price']]]];
            } else {
              $_SESSION['cart'][$itemID][] = ["frame"=>$_POST['frame'], "price"=>$_POST['price']];
            }
          }

          $itemInfoQuery = "SELECT * FROM FramedProducts WHERE productID = {$itemID}";
          $result = mysqli_query($connection, $itemInfoQuery);

          if($result && mysqli_num_rows($result) != 0):
          $row = mysqli_fetch_assoc($result); ?>
            <div class="row">
              <div class="col-md-6 img-container">
                <img id="js-img-item" class="none" src="<?php echo $row['imageURL']; ?>" alt="<?php echo $row['name']; ?>">
                <div class="btn-group mt-2" role="group" aria-label="Frame options">
                  <button data-class="wood-border" data-price="5" class="btn btn-dark border-toggle">Wood</button>
                  <button data-class="gray-border" data-price="3" class="btn btn-dark border-toggle">Gray</button>
                  <button data-class="none" data-price="0" class="btn btn-dark border-toggle">None</button>
                </div>
              </div>
              <div class="col-md-6 img-container">
                <div class="text-center">
                  <h1><?php echo $row['name']; ?></h1>
                  <h3 class="text-muted"><?php echo $row['photographer']; ?></h3>
                  <h5 id="js-price">$10</h5>
                  <p><?php echo $row['description']; ?></p>
                  <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true):
                      $isFavoritedQuery = "SELECT productID FROM FramedFavorites WHERE userID = {$_SESSION['userID']} AND productID = {$itemID}";
                      $favResult = mysqli_query($connection, $isFavoritedQuery);
                      $faved = ($favResult && mysqli_num_rows($favResult) != 0) ? 'true' : 'false';
                  ?>
                      <button data-type="rectangle" data-item="<?php echo $itemID; ?>" class="btn btn-success fav-btn" title="Click to favorite this item"><span class="fas fa-heart"></span> Favorite</button>
                      <form class="d-inline" method="post">
                        <input type="hidden" name="action" value="AddToCart">
                        <input id="form-frame-type" type="hidden" name="frame" value="None">
                        <input id="form-price" type="hidden" name="price" value="10">
                        <button type="submit" class="btn btn-primary"><span class="fas fa-cart-plus"></span> Add to Cart</button>
                      </form>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php else: ?>
            <h4 class="text-primary">Invalid product id. Try again!</h4>
          <?php endif;
            mysqli_close($connection);
          ?>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
    <script src="<?php path('/js/item.js'); ?>"></script>
    <script src="<?php path('/js/favorite.js'); ?>"></script>
  </body>
</html>
