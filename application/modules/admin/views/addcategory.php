<h1>Add New Category</h1>
<p><hr/></p>
<div class="row">
    <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo base_url() . 'admin/create_category/create'?>" class="form-horizontal" class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input id="category-name" required name="category-name" type="text" class="validate">
          <label for="category-name">Category Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <textarea id="category-description" name="category-description" class="materialize-textarea"></textarea>
          <label for="category-description">Description</label>
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

    <?php
                        if (isset($logmessage)){
                        ?>
                           <div class="card-panel black-text white">
                              <?php echo $logmessage; ?>
                           </div>
                        <?php } elseif (!(isset($logmessage))) { ?>
                           
                        <?php } elseif (null !== validation_errors()) { ?>
                            <div class="card-panel black-text white">
                              <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>