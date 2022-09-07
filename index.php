<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      DEFINE("PAGE_TITLE", "Home");
      require('/workspace/partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/home.css'); ?>">
  </head>
  <body>
    <?php include('./partials/navbar.php'); ?>
    <div class="full-image">
      <div class="container">
        <h1 class="display-4">Put these images on your wall</h1>
      </div>
    </div>
    <?php include('/workspace/partials/footer.php'); ?>
  </body>
</html>