<!DOCTYPE html>
<html>
  <head>
    <?php 
      $pageTitle = "Favorites";
      require('../partials/head.php');
    ?>
    <link rel="stylesheet" href="/css/store.css">
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
            displayResults();
          } else {
            $_GET['username'] = 'njs69';
            displayResults();
            // displayForm();
          }
        
          function displayForm() {
            print <<<HERE
            <form action="" method="GET">
              <fieldset>
                <div class="form-group">
                  <label>Username</label>
                  <input class="form-control" type="text" name="username" required>
                </div>
              </fieldset>
              <div class="form-group">
                <button class="btn btn-primary">Search</button>
              </div>
            </form>
HERE;
          }
        
          function displayResults() {
            require('../partials/database.php');
            
            $query = "SELECT products.productID, name, photographer, category, color, imageURL, description FROM products JOIN favorites JOIN users WHERE products.productID = favorites.productID && users.userID = favorites.userID && username = '{$_GET['username']}'";
            
            $results = mysqli_query($connection, $query);
            
            if($results) {
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
          }
        ?>
      </div> <!-- /.row -->
    </div>
  </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>