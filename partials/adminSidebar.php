<div class="sidebar">
  <ul class="sidebar-container">
    <li><a class="<?php if(PAGE_TITLE == 'All Orders') echo 'active'; ?>" href="<?php path('/admin/orders/'); ?>" title="View all orders"><span class="fas fa-shopping-bag"></span></a></li>
    <li><a class="<?php if(PAGE_TITLE == 'Items') echo 'active'; ?>" href="<?php path('/admin/items/'); ?>" title="Edit item details"><span class="fas fa-edit"></span></a></li>
    <li><a class="<?php if(PAGE_TITLE == 'Add Item') echo 'active'; ?>" href="<?php path('/admin/add-item/'); ?>" title="Add new item"><span class="fas fa-plus"></span></a></li>
  </ul>
</div>
