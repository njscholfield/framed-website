<!DOCTYPE html>
<html>
  <head>
    <?php 
      $pageTitle = "Store";
      require('../partials/head.php');
    ?>
    <link rel="stylesheet" href="/css/store.css">
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
              
              echo '<div class="row align-items-stretch">';
              while($row = mysqli_fetch_assoc($results)) {
                print <<<HERE
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                  <div class="card">
                    <img class="card-img-top" src="{$row['imageURL']}/500x500/" alt="{$row['name']}">
                    <div class="card-body">
                      <h5 class="card-title">{$row['name']}</h5>
                      <h6 class="text-muted">By {$row['photographer']}</h6>
                      <span class="badge badge-pill badge-success">{$row['category']}</span>
                      <p class="card-text">{$row['description']}</p>
                    </div>
                    <div class="card-footer">
                      <a href="/item/?id={$row['productID']}" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div>
HERE;
              }
            } else {
              echo '<h4 class="text-primary">No products to show</h4>';
            }
            mysqli_close($connection);
            
            function print_filter_box($colors, $categories) {
              print <<<HERE
              <button class="btn btn-link" onclick="$('#filter-options').toggleClass('d-none')">Filter <span class="fas fa-chevron-down"></span></button>
              <div id="filter-options" class="d-none"><ul><li>Category<ul><li>
HERE;
                while($catName = mysqli_fetch_array($categories)) {
                  echo "<span class=\"badge badge-pill badge-light\"><a href=\"/store/?category={$catName[0]}\">{$catName[0]}</a></span>";
                }
                echo "</li></ul></li><li>Color<ul><li>";
                while($colorName = mysqli_fetch_array($colors)) {
                  echo "<span class=\"badge badge-pill badge-light\"><a href=\"/store/?color={$colorName[0]}\">{$colorName[0]}</a></span>";
                }
                echo "</li></ul></li></ul><a class=\"btn btn-sm btn-dark\" href=\"/store/\">&times; clear</a></div>";
            }
          ?>
        </div> <!-- /.row -->
        <a class="btn btn-success" href="/add-item/">+ New Item</a>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>