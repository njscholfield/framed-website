<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php 
      DEFINE("PAGE_TITLE", "Favorites");
      require('../partials/head.php');
      require('../partials/itemCard.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/store.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
    <?php include('../partials/navbar.php'); ?>
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Favorites</h1>
      </div>
    </div>
    <div class="container">
        <?php 
          if (filter_has_var(INPUT_GET, "username")){
            // ALSO NEED TO CHECK IF FAVORITES ARE PUBLIC AND SHOW ACCESS DENIED
            displayResults();
          } else {
            $_GET['username'] = $_SESSION['username'];
            displayResults();
          }
        
          function displayResults() {
            require('../partials/database.php');
            
            $query = "SELECT products.productID, name, photographer, category, color, imageURL, description FROM products JOIN favorites JOIN users WHERE products.productID = favorites.productID && users.userID = favorites.userID && username = '{$_GET['username']}'";
            
            $results = mysqli_query($connection, $query);
            
            if($results) {
              printItemCards($results);
            } else {
              echo '<h4 class="text-primary">No products to show</h4>';
            }
            mysqli_close($connection);
          }
        ?>
      </div> <!-- /.row -->
    </div>
  </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>