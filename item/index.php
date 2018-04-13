<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item Page | Framed </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.0.0/yeti/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha256-NJWeQ+bs82iAeoT5Ktmqbi3NXwxcHlfaVejzJI2dklU=" crossorigin="anonymous" /> -->
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
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
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
      </div>
    </nav>
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Store</h1>
      </div>
    </div>
    <div class="container">
      <div class="row align-items-stretch">
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
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
              <div class="card">
                <img class="card-img-top" src="{$row['imageURL']}/500x500/" alt="{$row['name']}">
                <div class="card-body">
                  <h5 class="card-title">{$row['name']}</h5>
                  <h6 class="text-muted">By {$row['photographer']}</h6>
                  <p class="card-text">{$row['description']}</p>
                  <a href="/item/?id={$row['productID']}" class="btn btn-primary">Details</a>
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha256-C8oQVJ33cKtnkARnmeWp6SDChkU+u7KvsNMFUzkkUzk=" crossorigin="anonymous"></script>
  </body>
</html>