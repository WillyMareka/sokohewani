<h1>Add New Sub-Category</h1>
<p><hr/></p>
<div class="row">
    <form  role="form"  enctype="multipart/form-data" method="POST" action="<?php echo base_url() . 'admin/create_subcategory/create'?>" class="form-horizontal" class="col s12">

      <div class="row">
        <div class="input-field col s6">
          <input id="sub-category-name" name="sub-category-name" type="text" class="validate">
          <label for="sub-category-name">Sub-Category Name</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s6">
          <?php 
              echo $category_combo 
          ?>
          <label>Category Name</label>
        </div>
      </div>
      
      <div class="row">
        <div class="input-field col s6">
          <textarea id="sub-category-description" name="sub-category-description" class="materialize-textarea"></textarea>
          <label for="sub-category-description">Description</label>
        </div>
      </div>




      <div class="row">
        <div class="input-field col s6">
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
        </div>
      </div>


    </form>
  </div>