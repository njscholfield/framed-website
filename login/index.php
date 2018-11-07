<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define('PAGE_TITLE', 'Login');
      include('../partials/head.php');
    ?>
    <title>Login | Noah Scholfield</title>
  </head>
  <body>
    <?php include('../partials/navbar.php'); ?>
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Sign In</h1>
      </div>
    </div>
    <div class="container">
      <?php
        if(!empty($_POST)) {
          require('../partials/database.php');

          // Query database and check username and password
          $query = "SELECT userID, username FROM FramedUsers WHERE username = '{$_POST['username']}' AND password = '{$_POST['password']}';";
          $result = mysqli_query($connection, $query);

          if(!$result || mysqli_num_rows($result) == 0) {
            // Display error if no results are found
            echo "<h5 class=\"text-danger\">Invalid username or password!</h5>";
            mysqli_free_result($result);
            mysqli_close($connection);
          } else {
            // Save userID and username to session and redirect
            $user = mysqli_fetch_assoc($result);
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['userID'] = $user['userID'];
            mysqli_free_result($result);
            mysqli_close($connection);
            echo '<meta http-equiv="refresh" content="0;URL=../">'; // redirect to profile page
            die();
          }
        }
      ?>
      <form action="" method="post">
        <div class="form-group">
          <label>Username</label>
          <input class="form-control" type="text" name="username">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input class="form-control" type="password" name="password">
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Sign In</button>
        </div>
      </form>
    </div>
  </body>
</html>