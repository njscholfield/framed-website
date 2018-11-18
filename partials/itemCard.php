<?php 
  function printItemCards($results) {
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
            <a href="{$_ENV['SERVER_ROOT']}/item/?id={$row['productID']}" class="btn btn-primary">Details</a>
            <button data-item="{$row['productID']}" class="btn btn-success fav-btn"><span class="fas fa-heart"></span> Favorite</button>
          </div>
        </div>
      </div>
HERE;
    }
  }
?>