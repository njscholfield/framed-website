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
      define("PAGE_TITLE", "Items");
      require('../../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/admin.css'); ?>">
  </head>
  <body>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="" id="editform">
              <input type="hidden" name="productID" value="" id="product-id">
              <div class="form-group">
                <label class="col-form-label">Item Name</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label class="col-form-label">Photographer</label>
                <input type="text" class="form-control" name="photographer">
              </div>
              <div class="form-group">
                <label class="col-form-label">Image URL</label>
                <input type="url" class="form-control" name="imageURL" placeholder="https://source.unsplash.com/...">
              </div>
              <div class="form-group">
                <label class="col-form-label">Category</label>
                <input type="text" class="form-control" name="category">
              </div>
              <div class="form-group">
                <label class="col-form-label">Color</label>
                <input type="text" class="form-control" name="color">
              </div>
              <div class="form-group">
                <label class="col-form-label">Description</label>
                <textarea type="text" class="form-control" name="description"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="f-pusher">
      <?php
        include('../../partials/navbar.php');
        include('../../partials/adminSidebar.php');
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Items</h1>
        </div>
      </div>
      <div class="container">
        <h4 class="text-danger">Need to validate input for edited info</h4>
        <button class="btn btn-success float-right" data-toggle="modal" data-target="#editModal" data-id="-1"><span class="fas fa-plus"></span> New</button>
        <?php
          require('../../partials/database.php');

          function sanitizeInput($connection) {
            $clean = array();

            foreach ($_POST as $key => $value) {
              $clean[$key] = htmlspecialchars(mysqli_escape_string($connection, $value));
            }
            return $clean;
          }

          if(isset($_POST) && isset($_POST['productID'])) {
            $clean = sanitizeInput($connection);
            // If adding a new item I set the productID field to -1
            if($_POST['productID'] == -1) {
              $updateQuery = "INSERT INTO FramedProducts
                              (name, photographer, category, color, imageURL, description)
                              VALUES ('{$clean['name']}', '{$clean['photographer']}', '{$clean['category']}', '{$clean['color']}', '{$clean['imageURL']}', '{$clean['description']}');";
            } else {
              $updateQuery = "UPDATE FramedProducts
                              SET name = '{$clean['name']}', photographer = '{$clean['photographer']}', imageURL = '{$clean['imageURL']}', category = '{$clean['category']}', color = '{$clean['color']}', description = '{$clean['description']}'
                              WHERE ProductID = {$_POST['productID']};";
            }
            $result = mysqli_query($connection, $updateQuery);
            if($result) {
              echo '<h4 class="text-success">Item updated!</h4>';
            } else {
              echo '<h4 class="text-danger">Error updating item</h4>';
            }
          }

          $allItemsQuery = "SELECT * FROM FramedProducts;";
          $allItems = mysqli_query($connection, $allItemsQuery);

          echo '<table class="table"><tr><th>Name</th><th>Photographer</th><th>Description</th><th>Edit</th></tr>';
          while($row = mysqli_fetch_assoc($allItems)) {
            echo <<<HERE
            <tr>
              <td><a href="{$_ENV['SERVER_ROOT']}/item/?id={$row['productID']}">{$row['name']}</a></td>
              <td>{$row['photographer']}</td>
              <td>{$row['description']}</td>
              <td class="text-center"><a class="text-primary" data-toggle="modal" data-target="#editModal" data-id="{$row['productID']}"><span class="fas fa-edit"></span></a></td>
            </tr>
HERE;
          }
          echo "</table>";
          mysqli_free_result($allItems);
          mysqli_close($connection);
       ?>
      </div>
    </div>
    <?php include('../../partials/footer.php'); ?>
    <script src="<?php path('/js/admin.js'); ?>"></script>
  </body>
</html>
