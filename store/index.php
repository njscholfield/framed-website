<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store | Framed </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.0/yeti/bootstrap.min.css" integrity="sha256-vbJ7pUbGkPDqyJtw7J9dSR0HPU1TURYQ7/DnkRqTjWg=" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/store.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="f-pusher">
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/"><span class="far fa-images"></span> Framed</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about/">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/store/">Store</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/favorites/">Favorites</a>
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
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Store</h1>
        </div>
      </div>
      <div class="container">
          <?php 
            $connection = mysqli_connect("127.0.0.1", "njscholf_labs", "CS 334 Labs", "njscholf_cs334");
            if (!$connection) {
              echo "Error: Unable to connect to MySQL." . PHP_EOL;
              echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
              echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
              exit;
            }
            
            $query = "SELECT * FROM products";
            $colorsQ = "SELECT DISTINCT color FROM products";
            $categoriesQ = "SELECT DISTINCT category FROM products";
            
            if(isset($_GET['category'])) {
              $query .= " WHERE category='{$_GET['category']}'";
            } else if(isset($_GET['color'])) {
              $query .= " WHERE color='{$_GET['color']}'";
            }
            $results = mysqli_query($connection, $query);
            
            if($results) {
              $colors = mysqli_query($connection, $colorsQ);
              $categories = mysqli_query($connection, $categoriesQ);
    
              // filter results
              print_filter_box($colors, $categories);
              
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
            
            function print_filter_box($colors, $categories) {
              print <<<HERE
              <button class="btn btn-link" onclick="$('#filter-options').toggleClass('d-none')">Filter <span class="fas fa-chevron-down"></span></button>
              <div id="filter-options" class="d-none"><ul><li>Category<ul><li>
HERE;
                while($catName = mysqli_fetch_array($categories)) {
                  echo "<span class=\"badge badge-pill badge-light\"><a href=\"/store/?category={$catName[0]}\">{$catName[0]}</a></span>";
                }
                echo "</li></ul></li><li>Color<ul><li>";
                while($colorName = mysqli_fetch_array($colors)) {
                  echo "<span class=\"badge badge-pill badge-light\"><a href=\"/store/?color={$colorName[0]}\">{$colorName[0]}</a></span>";
                }
                echo "</li></ul></li></ul><a class=\"btn btn-sm btn-dark\" href=\"/store/\">&times; clear</a></div>";
            }
          ?>
        </div> <!-- /.row -->
        <a class="btn btn-success" href="/add-item/">+ New Item</a>
      </div>
    </div>
    <footer>
      <div class="row">
        <p class="col">Images from <a href="https://unsplash.com/collections/1953059/framed" target="_blank" rel="noopener noreferrer">Unsplash</a></p>
        <h6 class="col">Designed and built by <a href="https://noahscholfield.com/" target="_blank">Noah Scholfield</h6>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha256-C8oQVJ33cKtnkARnmeWp6SDChkU+u7KvsNMFUzkkUzk=" crossorigin="anonymous"></script>
  </body>
</html>