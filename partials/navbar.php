<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/"><span class="far fa-images"></span> Framed</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php if($pageTitle == 'Home') echo 'active'; ?>" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($pageTitle == 'About') echo 'active'; ?>" href="/about/">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($pageTitle == 'Store') echo 'active'; ?>" href="/store/">Store</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($pageTitle == 'Favorites') echo 'active'; ?>" href="/favorites/">Favorites</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#"><span title="Follow us on Instagram!" class="fab fa-instagram"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><span title="Follow us on Twitter!" class="fab fa-twitter"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><span title="Like us on Facebook!" class="fab fa-facebook-f"></span></a>
      </li>
    </ul>
  </div>
</nav>