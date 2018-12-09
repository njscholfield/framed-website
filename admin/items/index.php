<?php
  session_start();
  // User must be logged in and an Admin to view this page
  if(!isset($_SESSION['userID']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../");
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      define("PAGE_TITLE", "Items");
      require('../../partials/head.php');
    ?>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css">
    <link rel="stylesheet" href="<?php path('/css/admin.css'); ?>">
  </head>
  <body>
    <div class="f-pusher">
      <?php
        include('../../partials/navbar.php');
        include('../../partials/adminSidebar.php');
      ?>
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Items</h1>
        </div>
      </div>
      <div class="container" id="vue">
        <h4 :class="pageMessage.type">{{ pageMessage.message }}</h4>
        <button id="btn-add" class="btn btn-success float-right" @click="openEditModal(-1)"><span class="fas fa-plus"></span></button>
        <?php
          require('../../partials/database.php');

          $allItemsQuery = "SELECT * FROM FramedProducts;";
          $allItems = mysqli_query($connection, $allItemsQuery);

          echo '<div class="table-responsive"><table class="table"><tr><th>Name</th><th>Photographer</th><th>Description</th><th>Edit</th></tr>';
          while($row = mysqli_fetch_assoc($allItems)) {
            echo <<<HERE
            <tr>
              <td><a href="{$_ENV['SERVER_ROOT']}/item/?id={$row['productID']}">{$row['name']}</a></td>
              <td>{$row['photographer']}</td>
              <td>{$row['description']}</td>
              <td class="text-center"><a class="text-primary" @click="openEditModal({$row['productID']})"><span class="fas fa-edit"></span></a></td>
            </tr>
HERE;
          }
          echo "</table></div>";
          mysqli_free_result($allItems);
          mysqli_close($connection);
       ?>
       <b-modal ref="editModal" title="Item" ok-title="Save" @ok.prevent="submitForm" tabindex="-1" role="dialog" aria-hidden="true">
         <form id="editform">
           <input type="hidden" name="productID" value="" v-model="formData.productID">
           <div class="form-group">
             <label class="col-form-label">Item Name</label>
             <small class="text-danger">{{ errors.name }}</small>
             <input type="text" class="form-control" name="name" v-model="formData.name" maxlength="50">
           </div>
           <div class="form-group">
             <label class="col-form-label">Photographer</label>
             <small class="text-danger">{{ errors.photographer }}</small>
             <input type="text" class="form-control" name="photographer" v-model="formData.photographer" maxlength="50">
           </div>
           <div class="form-group">
             <label class="col-form-label">Image URL</label>
             <small class="text-danger">{{ errors.imageURL }}</small>
             <input type="url" class="form-control" name="imageURL" placeholder="https://source.unsplash.com/..." v-model="formData.imageURL" maxlength="100">
           </div>
           <div class="form-group">
             <label class="col-form-label">Category</label>
             <small class="text-danger">{{ errors.category }}</small>
             <input type="text" class="form-control" name="category" v-model="formData.category" maxlength="50">
           </div>
           <div class="form-group">
             <label class="col-form-label">Color</label>
             <small class="text-danger">{{ errors.color }}</small>
             <input type="text" class="form-control" name="color" v-model="formData.color" maxlength="50">
           </div>
           <div class="form-group">
             <label class="col-form-label">Description</label>
             <small class="text-danger">{{ errors.description }}</small>
             <textarea type="text" class="form-control" name="description" v-model="formData.description" maxlength="500"></textarea>
           </div>
         </form>
       </b-modal>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="<?php path('/js/admin.js'); ?>"></script>
    <script src="<?php path('/js/navbar.js'); ?>"></script>
  </body>
</html>
