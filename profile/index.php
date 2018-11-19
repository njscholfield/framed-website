<?php
  session_start();
  if(!isset($_SESSION['userID'])) {
    header("Location: ../");
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php 
      define("PAGE_TITLE", "Account Settings");
      require('../partials/head.php');
    ?>
  </head>
  <body>
    <?php include('../partials/navbar.php'); ?>
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Account Settings</h1>
      </div>
    </div>
    <div class="container">
      <?php 
        require('../partials/database.php');
        
        if(!empty($_POST) && isset($_POST['visibility'])) {
          // Check for valid input before updating visibility
          if(($_POST['visibility'] == 0 || $_POST['visibility'] == 1)) {
            $updateVisibility = "UPDATE FramedUsers
                                 SET publicProfile = {$_POST['visibility']}
                                 WHERE userID = {$_SESSION['userID']}";
            $result = mysqli_query($connection, $updateVisibility);
            if(!result) {
              echo '<h4 class="text-danger">Error updating favorites visibility</h4>';
            }
          }
        }
        
        $accountQuery = "SELECT userID, firstName, lastName, username, email, publicProfile
                         FROM FramedUsers
                         WHERE userID = {$_SESSION['userID']}";
        $userData = mysqli_query($connection, $accountQuery);
        if($userData && mysqli_num_rows($userData) == 1) :
          $data = mysqli_fetch_assoc($userData);
          foreach ($data as $key => $value) {
            echo "<p><strong>$key:</strong> $value</p>";
          }
        ?>
        <form action="" method="post">
          <legend>Change Favorites Visibility</legend>
          <small class="text-muted">Do you want other people to be able to see your favorites? Make it public to share with friends!</small>
            <div class="form-group">
              <label for="visibility">Favorites Visibility</label>
              <select class="form-control" name="visibility">
                <option value="0" <?php echo ($data['publicProfile'] == 0) ? "selected" : "" ?>>Private</option>
                <option value="1" <?php echo ($data['publicProfile'] == 1) ? "selected" : "" ?>>Public</option>
              </select>
            </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </form>
        <?php $favURL = "{$_SERVER['SERVER_NAME']}/favorites/?user={$_SESSION['username']}"; ?>
        <h6>If your favorites are public, people can see them at <a href="//<?php path($favURL); ?>"><?php path($favURL); ?></a></h5>
        <?php else : ?>
          <h4 class="text-danger">Error loading account info</h4>
        <?php endif;
          mysqli_free_result($userData);
          mysqli_close($connection);
        ?>
      <a class="btn btn-danger" href="<?php path('/logout/'); ?>">Log Out</a>
    </div>
  </body>
</html>