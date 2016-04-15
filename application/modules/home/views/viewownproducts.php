<h1 class="bold">Product View</h1>
<p><hr/></p>

<?php 
      if($productdetails){
foreach ($productdetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($productdetails);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>


<div class="row margin-space">
    <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'home/editproduct'?>" role="form" class="col s12 m6">


   <div class="controls">
   <input name="productid" type="hidden"  value="<?php echo $data['prodid']; ?>" class="span6 m-wrap form-control "/>
   </div>

   <div class="row">
    <div class="input-field col s6">
      <label class="active" for="title">Product Title</label>
      <input value="<?php echo $data['prodtitle']; ?>" id="title" required name="title" type="text" class="validate">
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
    <label class="active" for="title">Category Name</label>
      <?php 
              echo $categorycombo 
          ?>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <label class="active" for="subcategory">Sub Category</label>
      <?php 
              echo $subcategorycombo 
          ?>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <label class="active" for="description">Description</label>
      <textarea class="form-control" rows="5" style="width:400px;margin-left:100px;" name="description"><?php echo $data['proddesc']; ?></textarea>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <label class="active" for="price">Price</label>
      <input value="<?php echo $data['prodprice']; ?>" id="price" required name="price" type="text" class="validate">
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <label class="active" for="location">Location</label>
      <input value="<?php echo $data['prodlocation']; ?>" id="location" required name="location" type="text" class="validate">
    </div>
  </div>




       <div class="row">
        <div class="input-field col s6">
          <button class="btn waves-effect waves-light" type="submit" name="action">Edit Profile
          </button>
        </div>
       </div>

      
                        

        </form>

        <a href="<?php echo base_url(). 'home/addsview'?>" class="btn waves-effect waves-light btn-small">Back to Own Adds</a>

     <?php
        if (isset($logmessage)){
         ?>
            <div class="card-panel black-text white">
              <?php echo $logmessage; ?>
           </div>
         <?php } elseif (!(isset($logmessage))) { ?>
            <div class="card-panel black-text white">
                              <?php echo "All fields must be entered"; ?>
            </div>
        <?php } elseif (null !== validation_errors()) { ?>
             <div class="card-panel black-text white">
               <?php echo validation_errors(); ?>
             </div>
        <?php } ?>
 




  </div>



<?php 
                             }
                         }
                        
                       }
                   }else{ ?>                  

                    <div>No products are available</div>

                   <?php
                       }
                    ?>
