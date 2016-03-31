<div class="navbar-fixed">

  <!-- <nav id="introduction" class="section scrollspy"> -->
  <nav>
    <div class="nav-wrapper">
      <a href="<?php echo base_url(). 'admin'?>" class="brand-logo center">SokoHewani Limited</a>
      <a href="<?php echo base_url(). 'admin'?>" data-activates="mobile-demo" class="button-collapse">Menu</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?php echo base_url(). 'admin/photosview'?>">Photo requests<span class="new badge"><?php echo $waitphotonumber ?></span></a></li>
        <li><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="deactivations">Deactivations<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="profile">MarekaWilly<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="<?php echo base_url(). 'admin/photosview'?>">Photo requests</a></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">Deactivations</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">Messages</a></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">ViewProfile</a></li>
        <li><a href="<?php echo base_url(). 'admin/development'?>">LogOut</a></li>
        <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Mareka Willy<i class="material-icons right">arrow_drop_down</i></a></li> -->
       
      </ul>
    </div>
  </nav>
</div>

  <ul id="profile" class="dropdown-content">
  <li><a href="<?php echo base_url(). 'admin/development'?>">View Profile</a></li>
  <li><a href="<?php echo base_url(). 'admin/development'?>">Messages</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo base_url(). 'admin/development'?>">LogOut</a></li>
  </ul>

  <ul id="deactivations" class="dropdown-content">
  <li><a href="<?php echo base_url(). 'admin/inactiveusers'?>">Users<span class="badge"><?php echo $inusernumber ?></span></a></li>
  <li><a href="<?php echo base_url(). 'admin/inactivephotos'?>">Photos<span class="badge"><?php echo $inphotonumber ?></span></a></li>
  <li><a href="<?php echo base_url(). 'admin/inactivecategories'?>">Categories<span class="badge"><?php echo $incategorynumber ?></span></a></li>
  <li><a href="<?php echo base_url(). 'admin/inactivesubcategories'?>">Sub-Categories<span class="badge"><?php echo $insubcategorynumber ?></span></a></li>
  </ul>
 



  
       
