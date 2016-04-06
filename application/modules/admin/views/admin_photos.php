                
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        
        <li class="tab col s3"><a class="active" href="#actives">Active Photos</a></li>
        <li class="tab col s3"><a href="#disapproves">Photo Rejects</a></li>
      </ul>
    </div>



    <div id="actives" class="col s12">
      <div class="row">
        

          <?php if($aphotos){
                        foreach ($aphotos as $key => $value) {
                         foreach ($value as $q => $data) {
                          
                          //echo '<pre>';print_r($waits);echo'</pre>';die();
                          for ($i=0; $i <= $key ; $i++) { 
                            
                          ?>

<div class="col s12 m4">
               
                 <img class="materialboxed" height="250" width="250" src="<?php echo base_url(). 'assets/images/mareka.jpg'?>">
                 <!-- <img class="activator" src="<?php echo $data['photopath']; ?>"> -->
               
               
               
          <div class="card small hoverable">
             <!-- <div class="card-image waves-effect waves-block waves-light"> -->
               
             <!-- </div> -->
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Photo-ID: <?php echo $data['photoid']; ?> Product For Product-ID: <?php echo $data['prodid']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a class="" href="<?php echo base_url().'admin/updatephoto/disapprove/'.$data['photoid'] ?>">Disapprove</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Product ID : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p><span class="bold">Date Submitted:</span> <?php echo $data['photodate']; ?></p>
               <p><span class="bold">Information given:</span> </p>
               <p><?php echo $data['photoinfo']; ?></p>
             </div>
           </div>
           </div>


                  <?php 
                          }
                        }
                    } 
                  ?>
                        
                  
                  <?php    
                  }else{
          ?>
                  
            <div class="row">
              <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">No reject photos</span>
                    <p>There are no disapproved photos yet</p>
                  </div>
                  <div class="card-action">
                    <a href="<?php echo base_url(). 'admin/adminview'?>">Admin Home Page</a>
                    <a href="<?php echo base_url(). 'admin/photosview'?>">Pending Photos</a>
                  </div>
                </div>
              </div>
            </div>

          <?php
          
           }

         ?>



        
      </div>
    </div>


    <div id="disapproves" class="col s12">
    <div class="row">
        

            <?php if($dphotos){
                        foreach ($dphotos as $key => $value) {
                         foreach ($value as $q => $data) {
                          
                          //echo '<pre>';print_r($waits);echo'</pre>';die();
                          for ($i=0; $i <= $key ; $i++) { 
                            
                          ?>

<div class="col s12 m4">
               
                 <img class="materialboxed" height="250" width="250" src="<?php echo base_url(). 'assets/images/mareka.jpg'?>">
                 <!-- <img class="activator" src="<?php echo $data['photopath']; ?>"> -->
               
               
               
          <div class="card small hoverable">
             <!-- <div class="card-image waves-effect waves-block waves-light"> -->
               
             <!-- </div> -->
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Photo-ID: <?php echo $data['photoid']; ?> Product For Product-ID: <?php echo $data['prodid']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a class="" href="<?php echo base_url().'admin/updatephoto/approve/'.$data['photoid'] ?>">Approve</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Product ID : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p><span class="bold">Date Submitted:</span> <?php echo $data['photodate']; ?></p>
               <p><span class="bold">Information given:</span> </p>
               <p><?php echo $data['photoinfo']; ?></p>
             </div>
           </div>
           </div>


                  <?php 
                          }
                        }
                    } 
                  ?>
                        
                  
                  <?php    
                  }else{
          ?>
                  
            <div class="row">
              <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">No reject photos</span>
                    <p>There are no disapproved photos yet</p>
                  </div>
                  <div class="card-action">
                    <a href="<?php echo base_url(). 'admin/adminview'?>">Admin Home Page</a>
                    <a href="<?php echo base_url(). 'admin/photosview'?>">Pending Photos</a>
                  </div>
                </div>
              </div>
            </div>

          <?php
          
           }

         ?>


        </div>
      </div>
    </div><!-- End of third tab -->



  </div><!-- End of row -->
        



