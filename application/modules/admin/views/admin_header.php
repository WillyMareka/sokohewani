
  <nav>
    <div class="nav-wrapper">
      <a href="<?php echo base_url(). 'admin'?>" class="brand-logo center">SokoHewa Limited</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">Menu</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?php echo base_url(). 'admin/development'?>">Photo requests</a></li>
        <li><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="deactivations">Deactivations<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="profile">Mareka Willy<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="<?php echo base_url(). 'admin/development'?>">Photo requests</a></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">Deactivations</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">Messages</a></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">ViewProfile</a></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">LogOut</a></li>
        <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Mareka Willy<i class="material-icons right">arrow_drop_down</i></a></li> -->
       
      </ul>
    </div>
  </nav>

  <ul id="profile" class="dropdown-content">
  <li><a href="<?php echo base_url(). 'admin/development'?>">View Profile</a></li>
  <li><a href="<?php echo base_url(). 'admin/development'?>">Messages</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo base_url(). 'admin/development'?>">LogOut</a></li>
  </ul>

  <ul id="deactivations" class="dropdown-content">
  <li><a href="<?php echo base_url(). 'admin/inactiveusers'?>">Users</a></li>
  <li><a href="<?php echo base_url(). 'admin/development'?>">Photos</a></li>
  <li><a href="<?php echo base_url(). 'admin/inactivecategories'?>">Categories</a></li>
  <li><a href="<?php echo base_url(). 'admin/inactivesubcategories'?>">Sub-Categories</a></li>
  </ul>
       
