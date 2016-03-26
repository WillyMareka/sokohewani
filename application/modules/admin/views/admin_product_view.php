                
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a href="#awaits">Awaiting Approval</a></li>
        <li class="tab col s3"><a class="active" href="#approves">Active Products</a></li>
        <!-- <li class="tab col s3 disabled"><a href="#test3">Disabled Tab</a></li> -->
        <li class="tab col s3"><a href="#disapproves">Disapproved Products</a></li>
      </ul>
    </div>



    <div id="awaits" class="col s12">
      <div class="row">
        <div class="col s12 m6">

          <?php if($waits){
                        foreach ($waits as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		//echo '<pre>';print_r($value);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>


          <div class="card small">
             <div class="card-image waves-effect waves-block waves-light">
               <!-- <img class="activator" src="<?php echo $data['catid']; ?>"> -->
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Product-ID: <?php echo $data['prodid']; ?> Product-Title: <?php echo $data['prodtitle']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a href="#">Approve</a><a href="#">Disapprove</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $data['prodtitle']; ?> : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p>Category: <?php echo $data['catid']; ?></p>
               <p>Sub-Category: <?php echo $data['subid']; ?></p>
               <p>Date-Added: <?php echo $data['proddate']; ?></p>
               <p>Added-By: <?php echo $data['userid']; ?></p>
               <p>Product-Location: <?php echo $data['prodlocation']; ?></p>
               <p>Price-Given: <?php echo $data['prodprice']; ?></p>
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
        <div class="col s12 m7">
          <div class="card">
            <div class="card-image">
              <img src="<?php echo base_url().'assets/images/noawaiting.jpg'?>"/>
              <span class="card-title">No Products found</span>
            </div>
            <div class="card-content">
              <p>There are no currently approved products</p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
            </div> -->
          </div>
        </div>
      </div>


				  <?php
					
				   }

				 ?>



        </div>
      </div>
    </div>



    <div id="approves" class="col s12">
      <div class="row">
        <div class="col s12 m6">

          <?php if($waits){
                        foreach ($approves as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		//echo '<pre>';print_r($value);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>


          <div class="card small">
             <div class="card-image waves-effect waves-block waves-light">
               <!-- <img class="activator" src="<?php echo $data['catid']; ?>"> -->
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Product-ID: <?php echo $data['prodid']; ?> Product-Title: <?php echo $data['prodtitle']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a href="#">Disapprove</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $data['prodtitle']; ?> : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p>Category: <?php echo $data['catid']; ?></p>
               <p>Sub-Category: <?php echo $data['subid']; ?></p>
               <p>Date-Added: <?php echo $data['proddate']; ?></p>
               <p>Added-By: <?php echo $data['userid']; ?></p>
               <p>Product-Location: <?php echo $data['prodlocation']; ?></p>
               <p>Price-Given: <?php echo $data['prodprice']; ?></p>
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
        <div class="col s12 m7">
          <div class="card">
            <div class="card-image">
              <img src="<?php echo base_url().'assets/images/noapproves.jpg'?>"/>
              <span class="card-title">No Products found</span>
            </div>
            <div class="card-content">
              <p>There are no currently approved products</p>
            </div>
          </div>
        </div>
      </div>


				  <?php
					
				   }

				 ?>



        </div>
      </div>
    </div>


    <div id="disapproves" class="col s12">
    <div class="row">
        <div class="col s12 m6">

          <?php if($waits){
                        foreach ($disapproves as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		//echo '<pre>';print_r($value);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>


          <div class="card small">
             <div class="card-image waves-effect waves-block waves-light">
               <!-- <img class="activator" src="<?php echo $data['catid']; ?>"> -->
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Product-ID: <?php echo $data['prodid']; ?> Product-Title: <?php echo $data['prodtitle']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a href="#">Approve</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $data['prodtitle']; ?> : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p>Category: <?php echo $data['catid']; ?></p>
               <p>Sub-Category: <?php echo $data['subid']; ?></p>
               <p>Date-Added: <?php echo $data['proddate']; ?></p>
               <p>Added-By: <?php echo $data['userid']; ?></p>
               <p>Product-Location: <?php echo $data['prodlocation']; ?></p>
               <p>Price-Given: <?php echo $data['prodprice']; ?></p>
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
        <div class="col s12 m7">
          <div class="card">
            <div class="card-image">
              <img src="<?php echo base_url().'assets/images/nodisapproves.jpg'?>"/>
              <span class="card-title">No Products found</span>
            </div>
            <div class="card-content">
              <p>There are no currently disapproved products</p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
            </div> -->
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
        



               