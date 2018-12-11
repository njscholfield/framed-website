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
        <transition name="slide">
          <div class="message" v-show="messageVisible">
            <h6 :class="pageMessage.type">{{ pageMessage.message }}</h6>
          </div>
        </transition>
        <button id="btn-add" class="btn btn-success float-right" @click="openEditModal(-1)"><span class="fas fa-plus"></span></button>
        <div class="table-responsive" id="item-table">
          <table class="table">
            <tr>
              <th>Name</th>
              <th>Photographer</th>
              <th>Description</th>
              <th>Edit</th>
            </tr>
            <tr v-for="item in items" :key="item.productID">
              <td><a :href="'<?php echo $_ENV['SERVER_ROOT']; ?>/item/?id='+item.productID">{{ item.name }}</a></td>
              <td>{{ item.photographer }}</td>
              <td>{{ item.description }}</td>
              <td class="text-center"><a class="text-primary" @click="openEditModal(item.productID)"><span class="fas fa-edit"></span></a></td>
            </tr>
          </table>
        </div>
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
             <input id="img-preview" type="url" class="form-control" name="imageURL" placeholder="https://source.unsplash.com/..." v-model="formData.imageURL" maxlength="100">
             <b-popover target="img-preview" title="Image Preview" triggers="hover focus" placement="top">
               <template>
                 <img id="preview" :src="formData.imageURL">
               </template>
             </b-popover>
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
           <div id="btn-delete" v-show="formData.action === 'update'" class="btn btn-danger"><span class="fas fa-trash"></span> Delete Item</div>
            <b-popover target="btn-delete" title="Are you sure?" triggers="click blur">
              <template>
                <h6>This cannot be undone</h6>
                <button class="btn btn-danger" @click.prevent="deleteItem(formData.productID)"><span class="fas fa-check"></span> Confirm</button>
                <b-btn class="btn btn-secondary" @click.prevent="dismissPopover"><span class="fas fa-times"></span> Cancel</b-btn>
              </template>
            </b-popover>
         </form>
       </b-modal>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.20/vue.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="<?php path('/js/admin.js'); ?>"></script>
    <script src="<?php path('/js/navbar.js'); ?>"></script>
  </body>
</html>
