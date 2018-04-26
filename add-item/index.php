<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Item | Framed </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.0/yeti/bootstrap.min.css" integrity="sha256-vbJ7pUbGkPDqyJtw7J9dSR0HPU1TURYQ7/DnkRqTjWg=" crossorigin="anonymous">
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
        <h1 class="display-4">Add New Item</h1>
      </div>
    </div>
    <div class="container">
      <?php 
        if (filter_has_var(INPUT_POST, "name")){
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
      
        function addItem() {
          @$db = new mysqli("127.0.0.1", "njscholf_labs", "CS 334 Labs", "njscholf_cs334");
          if (mysqli_connect_errno()) {
            echo '<h4 class="text-danger">Error: Could not connect to database.</h4>';
            exit;
          }
          
          $query = "INSERT INTO products VALUES(NULL, ?, ?, ?, ?, ?, ?)";
          $stmt = $db->prepare($query);
          $stmt->bind_param('ssssss', $_POST['name'], $_POST['photographer'], $_POST['category'], $_POST['color'], $_POST['imageURL'], $_POST['description']);
          $stmt->execute();
          
          if ($stmt->affected_rows > 0) {
            echo  '<h4 class="text-success">Item successfully added!</h4>';
          } else {
            echo '<h4 class="text-danger">Error adding the item. Please try again!</h4>';
          }
          $db->close();
        }
      ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha256-C8oQVJ33cKtnkARnmeWp6SDChkU+u7KvsNMFUzkkUzk=" crossorigin="anonymous"></script>
  </body>
</html>