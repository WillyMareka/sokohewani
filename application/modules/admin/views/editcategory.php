<h1 class="bold">Category Edit</h1>
<p><hr/></p>

<div class="row margin-space">
    <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'admin/create_category/edit'?>" class="form-horizontal" role="form" class="col s12">

<?php foreach ($categorydetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>
   <div class="controls">
   <input name="category-id" type="hidden"  value="<?php echo $data['catid']; ?>" class="span6 m-wrap form-control "/>
   </div>
   <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['catname']; ?>" id="category-name" required name="category-name" type="text" class="validate">
      <label class="active" for="category-name">Category Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['catdescription']; ?>" id="category-description" required name="category-description" type="text" class="validate">
      <label class="active" for="category-description">Description</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php $state = $data['catstatus']; if ($state == 1) {
        echo "Activated";
      } else {
        echo "Deactivated";
      }
         ?>" id="category-status" required name="category-status" type="text" class="validate">
      <label class="active" for="category-status">Status</label>
    </div>
  </div>

<?php 
                             }
                         }
                        
                       }
                        ?>
<div class="row">
        <div class="input-field col s6">
      <button class="btn waves-effect waves-light" type="submit" name="action">Edit Category
        <i class="material-icons right">system_update_alt</i>
      </button>
        </div>
        
      </div>

      <a href="<?php echo base_url(). 'admin/activecategories'?>
    " class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Categories</a>
                        

        </form>
  </div>