<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php 
      DEFINE("PAGE_TITLE", "Store");
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
          <h1 class="display-4">Store</h1>
        </div>
      </div>
      <div class="container">
          <?php 
            $ROOT = ROOT;
            require('../partials/database.php');
            $query = "SELECT * FROM products";
            $colorsQ = "SELECT DISTINCT color FROM products";
            $categoriesQ = "SELECT DISTINCT category FROM products";
            
            if(isset($_GET['category'])) {
              $query .= " WHERE category='{$_GET['category']}'";
            } else if(isset($_GET['color'])) {
              $query .= " WHERE color='{$_GET['color']}'";
            }
            $results = mysqli_query($connection, $query);
            
            if($results) {
              $colors = mysqli_query($connection, $colorsQ);
              $categories = mysqli_query($connection, $categoriesQ);
    
              // filter results
              print_filter_box($colors, $categories);
              
              printItemCards($results);
              
            } else {
              echo '<h4 class="text-primary">No products to show</h4>';
            }
            mysqli_close($connection);
            
            function print_filter_box($colors, $categories) {
              $ROOT = ROOT;
              print <<<HERE
              <button class="btn btn-link" onclick="$('#filter-options').toggleClass('d-none')">Filter <span class="fas fa-chevron-down"></span></button>
              <div id="filter-options" class="d-none"><ul><li>Category<ul><li>
HERE;
                while($catName = mysqli_fetch_array($categories)) {
                  echo "<span class=\"badge badge-pill badge-light\"><a href=\"$ROOT/store/?category={$catName[0]}\">{$catName[0]}</a></span>";
                }
                echo "</li></ul></li><li>Color<ul><li>";
                while($colorName = mysqli_fetch_array($colors)) {
                  echo "<span class=\"badge badge-pill badge-light\"><a href=\"$ROOT/store/?color={$colorName[0]}\">{$colorName[0]}</a></span>";
                }
                echo "</li></ul></li></ul><a class=\"btn btn-sm btn-dark\" href=\"$ROOT/store/\">&times; clear</a></div>";
            }
          ?>
        </div> <!-- /.row -->
        <a class="btn btn-success" href="<?php path('/add-item/'); ?>">+ New Item</a>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>