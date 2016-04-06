<h1 class="bold">Sub-Category Edit</h1>
<p><hr/></p>

<div class="row margin-space">
    <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'admin/create_subcategory/edit'?>" class="form-horizontal" role="form" class="col s12">

<?php foreach ($subcategorydetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>
   <div class="controls">
   <input name="sub-category-id" type="hidden" value="<?php echo $data['subid']; ?>" class="span6 m-wrap form-control "/>
   </div>

   <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['subname']; ?>" id="sub-category-name" name="sub-category-name" type="text" class="validate">
      <label class="active" for="sub-category-name">Category Name</label>
    </div>
  </div>

   <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['catid']; ?>" id="category-id" name="category-id" type="text" class="validate">
      <label class="active" for="category-id">Category</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['subdescription']; ?>" id="sub-category-description" name="sub-category-description" type="text" class="validate">
      <label class="active" for="sub-category-description">Description</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['subcatstatus']; ?>" id="sub-category-status" name="sub-category-status" type="text" class="validate">
      <label class="active" for="sub-category-status">Status</label>
    </div>
  </div>


<?php 
                             }
                         }
                        
                       }
                        ?>
<div class="row">
        <div class="input-field col s6">
      <button class="btn waves-effect waves-light" type="submit" name="action">Edit Sub-Category
        <i class="material-icons right">system_update_alt</i>
      </button>
        </div>
        
      </div>

      <a href="<?php echo base_url(). 'admin/subcategorydetail/view/'?><?php echo $data['subid']; ?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to View</a>
                        

        </form>
  </div>