<!DOCTYPE html>
<html>
  <head>
    <?php
      DEFINE("PAGE_TITLE", "About");
      require('../partials/head.php');
    ?>
    <link rel="stylesheet" href="<?php path('/css/about.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php include('../partials/navbar.php'); ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">About Us</h1>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md">
            <p>Framed sells prints of a wide variety of different photos from space images, to city scapes, to nature. You can get just a plain print or have it professionally framed in one of several high quality frames. Several different size options are available so you can get just the right size to fill that empty space on your wall.</p>
            <p>Whether you are moving into a new apartment, dorm, house, or just have an empty space on your wall we are here to provide you with the perfect high quality print. We have all sorts of images with your choice of frame so you can get something that fits the look you are going for.</p>
            <p>All of out prints are printed on high quality paper with premium inks to make sure they look great for years.</p>
            <p>If you have any questions about our products, materials, or your order, please reach out to us! We will be happy to assist you!</p>
          </div>
          <form class="col-md" action="#">
            <h3>What can we help you with?</h3>
            <p>Fill out this form and we will get back to you as soon as possible</p>
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="name" placeholder="Noah">
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input class="form-control" type="email" name="email" placeholder="noah@framed.com">
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input class="form-control" type="tel" name="phone" placeholder="412-555-0121">
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control" rows="5" name="message"></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include('../partials/footer.php'); ?>
  </body>
</html>