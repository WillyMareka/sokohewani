<ul id="slide-out" class="side-nav fixed">

      <li class="sidebarmenu"><a href="<?php echo base_url(). 'admin/adminview'?>">Menu</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url(). 'admin/activeusers'?>">Users<span class="badge"><?php echo $allusernumber ?></span></a></li>
      <li><a href="<?php echo base_url(). 'admin/productsview'?>">Products<span class="new badge"><?php echo $waitproductnumber ?></span></a></li>
      <li><a class="dropdown-button" data-beloworigin="true" href="<?php echo base_url(). 'admin/activecategories'?>" data-activates="catdropdown">Categories<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
      

      <ul id='catdropdown' class='dropdown-content'>
        <li><a href="<?php echo base_url(). 'admin/activecategories'?>">Categories<span class="badge"><?php echo $allcategorynumber ?></a></li>
        <li><a href="<?php echo base_url(). 'admin/newcategory'?>">Add Category</a></li>
        <li><a href="<?php echo base_url(). 'admin/activesubcategories'?>">Sub-Categories<span class="badge"><?php echo $allsubcategorynumber ?></a></li>
        <li><a href="<?php echo base_url(). 'admin/newsubcategory'?>">Add Sub-Categories</a></li>
      </ul>

</ul>

<a href="#" data-activates="slide-out" class="button-collapse"><i class="sidebar small mdi-navigation-menu"></i></a>