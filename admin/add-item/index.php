<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      DEFINE("PAGE_TITLE", "Add Item");
      require('../../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/item.css'); ?>">
    <link rel="stylesheet" href="<?php path('/css/admin.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php
        include('../../partials/navbar.php');
        include('../../partials/adminSidebar.php');
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Add New Item</h1>
        </div>
      </div>
      <div class="container">
        <h4 class="text-danger">Need to validate input</h4>
        <?php
          if (isset($_POST) && isset($_POST['name'])){
            addItem();
          } else {
            displayForm();
          }

          function displayForm() {
            print <<<HERE
              <form action="" method="POST">
                <fieldset>
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" type="text" placeholder="Milky Way Galaxy" required>
                  </div>
                  <div class="form-group">
                    <label>Photographer</label>
                    <input class="form-control" name="photographer" type="text" placeholder="John Smith" required>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <input class="form-control" name="category" type="text" placeholder="space" required>
                  </div>
                  <div class="form-group">
                    <label>Color</label>
                    <input class="form-control" name="color" type="text" placeholder="blue" required>
                  </div>
                  <div class="form-group">
                    <label>Image URL</label>
                    <input class="form-control" name="imageURL" type="url" placeholder="https://source.unsplash.com/..." required>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="5" maxlength="500" required></textarea>
                  </div>
                </fieldset>
                <div class="form-group">
                  <button class="btn btn-success" type="submit">Add Item</button>
                </div>
              </form>
HERE;
          }

          function sanitizeInput($connection) {
            $clean = array();

            foreach ($_POST as $key => $value) {
              $clean[$key] = htmlspecialchars(mysqli_escape_string($connection, $value));
            }
            return $clean;
          }

          function addItem() {
            require('../../partials/database.php');

            $clean = sanitizeInput($connection);

            $newItemQuery = "INSERT INTO FramedProducts (name, photographer, category, color, imageURL, description)
                             VALUES ('{$clean['name']}', '{$clean['photographer']}', '{$clean['category']}', '{$clean['imageURL']}', '{$clean['description']}')";
            $successful = mysqli_query($connection, $newItemQuery);

            if ($successful) {
              echo '<h4 class="text-success">Item successfully added!</h4>';
            } else {
              echo '<h4 class="text-danger">Error adding the item. Please try again!</h4>';
            }
            mysqli_close($connection);
          }
        ?>
      </div>
    </div>
    <?php include('../../partials/footer.php'); ?>
  </body>
</html>
