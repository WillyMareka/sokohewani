<ul id="slide-out" class="side-nav fixed">
      <li><a href="<?php echo base_url(). 'admin/development'?>">Menu</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url(). 'admin/activeusers'?>">Users</a></li>
      <li><a href="<?php echo base_url(). 'admin/productsview'?>">Products</a></li>
      <!-- <li><a href="<?php echo base_url(). 'admin/activecategories'?>">Categories</a></li> -->
      <!-- <li><a href="<?php echo base_url(). 'admin/activesubcategories'?>">Sub-Categories</a></li> -->
      <li><a class="dropdown-button" data-beloworigin="true" href="<?php echo base_url(). 'admin/activecategories'?>" data-activates="catdropdown">Categories<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
      <ul id='catdropdown' class='dropdown-content'>
        <li><a href="<?php echo base_url(). 'admin/activecategories'?>">View Categories</a></li>
        <li><a href="<?php echo base_url(). 'admin/newcategory'?>">Add Category</a></li>
        <li><a href="<?php echo base_url(). 'admin/activesubcategories'?>">View Sub-Categories</a></li>
        <li><a href="<?php echo base_url(). 'admin/newsubcategory'?>">Add Sub-Categories</a></li>
      </ul>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="small mdi-navigation-menu"></i></a>