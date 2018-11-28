<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="<?php path('/'); ?>"><span class="far fa-images"></span> Framed</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php if(PAGE_TITLE == 'Home') echo 'active'; ?>" href="<?php path('/'); ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if(PAGE_TITLE == 'About') echo 'active'; ?>" href="<?php path('/about/'); ?>">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if(PAGE_TITLE == 'Store') echo 'active'; ?>" href="<?php path('/store/'); ?>">Store</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
        <li class="nav-item">
          <div class="dropdown">
            <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-user"></span></a>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
              <a class="dropdown-item" href="<?php path('/profile/'); ?>"><span class="fas fa-cog"></span> Settings</a>
              <a class="dropdown-item" href="<?php path('/profile/orders/'); ?>">My Orders</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/logout/">Sign Out</a>
            </div>
          </div>
        </li>
        <li class="nav-item d-flex align-items-center">
          <a href="<?php path('/cart/'); ?>" class="fa-layers fa-fw nav-link">
            <span class="fas fa-shopping-cart"></span>
            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
              <span class="fa-layers-counter" style="background:Tomato"></span>
            <?php endif; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php path('/favorites/'); ?>"><span title="View your favorites" class="fas fa-heart"></span></a>
        </li>
        
      <?php else: ?>
        <div class="ml-auto">
          <a class="btn btn-secondary navbar-btn" href="<?php path('/login/'); ?>">Sign In</a>
          <a class="btn btn-success navbar-btn" href="<?php path('/register/'); ?>">Register</a>
        </div>
      <?php endif; ?>
    </ul>
  </div>
</nav>