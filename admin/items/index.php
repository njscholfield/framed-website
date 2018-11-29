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
            <form method="post" action="">
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
                <input type="url" class="form-control" name="imageURL">
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
            $updateQuery = "UPDATE FramedProducts
                            SET name = '{$clean['name']}', photographer = '{$clean['photographer']}', imageURL = '{$clean['imageURL']}', category = '{$clean['category']}', color = '{$clean['color']}', description = '{$clean['description']}'
                            WHERE ProductID = {$_POST['productID']};";
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
              <td><a data-toggle="modal" data-target="#editModal" data-id="{$row['productID']}"><span class="fas fa-edit"></span></a></td>
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
    <script>
      // Code adapted from Bootstrap Documentation http://getbootstrap.com/docs/4.1/components/modal/#modal
      $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this)
        let itemData = "";
        fetch(`../../item/info.php/?id=${id}`)
          .then(blob => blob.json())
          .then(data => {
            modal.find('.modal-body #product-id').val(id)
            modal.find("input[name*='name']").val(data.name);
            modal.find("input[name*='photographer']").val(data.photographer);
            modal.find("input[name*='imageURL']").val(data.imageURL);
            modal.find("input[name*='category']").val(data.category);
            modal.find("input[name*='color']").val(data.color);
            modal.find("textarea[name*='description']").html(data.description);
          });
      });
    </script>
  </body>
</html>
