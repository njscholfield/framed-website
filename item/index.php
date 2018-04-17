<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item Page | Framed </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.0.0/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/item.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
  </head>
  <body>
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
            <a class="nav-link" href="/store/">Store</a>
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
    <div class="container">
      <?php 
        $itemID = $_GET['id'];
        $connection = mysqli_connect("127.0.0.1", "njscholf_labs", "CS 334 Labs", "njscholf_cs334");
        if (!$connection) {
          echo "Error: Unable to connect to MySQL." . PHP_EOL;
          echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
          echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
          exit;
        }
        $query = "SELECT * FROM products WHERE productID = ".$itemID;
        $result = mysqli_query($connection, $query);
        
        if($result) {
          $row = mysqli_fetch_assoc($result);
          print <<<HERE
          <div class="row">
            <div class="col-md-6 img-container">
              <img id="js-img-item" class="none" src="{$row['imageURL']}" alt="{$row['name']}">
              <div class="btn-tray">
                <button data-class="wood-border" class="btn btn-dark border-toggle">Wood</button>
                <button data-class="gray-border" class="btn btn-dark border-toggle">Gray</button>
                <button data-class="none" class="btn btn-dark border-toggle">None</button>
              </div>
            </div>
            <div class="col-md-6 img-container">
              <div class="text-center">
                <h1>{$row['name']}</h1>
                <h3 class="text-muted">{$row['photographer']}</h3>
                <p>{$row['description']}</p>
              </div>
            </div>
          </div>
HERE;
        } else {
          echo '<h4 class="text-primary">Invalid product id. Try again!</h4>';
        }
        mysqli_close($connection);
      ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha256-C8oQVJ33cKtnkARnmeWp6SDChkU+u7KvsNMFUzkkUzk=" crossorigin="anonymous"></script>
    <script src="/js/border.js"></script>
  </body>
</html>