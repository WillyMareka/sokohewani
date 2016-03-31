                
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        
        <li class="tab col s3"><a href="#approves">Active Products</a></li>
        <li class="tab col s3"><a class="active" href="#awaits">Awaiting Approval</a></li>
        <!-- <li class="tab col s3 disabled"><a href="#test3">Disabled Tab</a></li> -->
        <li class="tab col s3"><a href="#disapproves">Disapproved Products</a></li>
      </ul>
    </div>



    <div id="awaits" class="col s12">
      <div class="row">
        

          <?php if($waits){
                        foreach ($waits as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		//echo '<pre>';print_r($waits);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>

        <div class="col s12 m4">
          <div class="card small hoverable">
             <div class="card-image waves-effect waves-block waves-light">
               <!-- <img class="activator" src="<?php echo $data['photopath']; ?>"> -->
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Product-ID: <?php echo $data['prodid']; ?> Product-Title: <?php echo $data['prodtitle']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a class="" href="<?php echo base_url().'admin/updateproduct/approve/'.$data['prodid'] ?>">Approve</a>
              <a class="" href="<?php echo base_url().'admin/updateproduct/disapprove/'.$data['prodid'] ?>">Disapprove</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $data['prodtitle']; ?> : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p><span class="bold">Category:</span> <?php echo $data['catid']; ?></p>
               <p><span class="bold">Sub-Category:</span> <?php echo $data['subid']; ?></p>
               <p><span class="bold">Date-Added:</span> <?php echo $data['proddate']; ?></p>
               <p><span class="bold">Added-By:</span> <?php echo $data['userid']; ?></p>
               <p><span class="bold">Product-Location:</span> <?php echo $data['prodlocation']; ?></p>
               <p><span class="bold">Price-Given:</span> <?php echo $data['prodprice']; ?></p>
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
                       <div class="col s12 m4">
                         <div class="card medium hoverable">
                           <div class="card-image">
                             <img src="<?php echo base_url().'assets/images/noawaiting.jpg'?>"/>
                             <!-- <span class="card-title">No Products found</span> -->
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



    <div id="approves" class="col s12">
      <div class="row">
        

          <?php if($approves){
                        foreach ($approves as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		// echo '<pre>';print_r($value);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>

         <div class="col s12 m4">
          <div class="card small hoverable">
             <div class="card-image waves-effect waves-block waves-light">
               <!-- <img class="activator" src="<?php echo $data['photopath']; ?>"> -->
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Product-ID: <?php echo $data['prodid']; ?> Product-Title: <?php echo $data['prodtitle']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a class="" href="<?php echo base_url().'admin/updateproduct/disapprove/'.$data['prodid'] ?>">Disapprove</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $data['prodtitle']; ?> : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p><span class="bold">Category:</span> <?php echo $data['catid']; ?></p>
               <p><span class="bold">Sub-Category:</span> <?php echo $data['subid']; ?></p>
               <p><span class="bold">Date-Added:</span> <?php echo $data['proddate']; ?></p>
               <p><span class="bold">Added-By:</span> <?php echo $data['userid']; ?></p>
               <p><span class="bold">Product-Location:</span> <?php echo $data['prodlocation']; ?></p>
               <p><span class="bold">Price-Given:</span> <?php echo $data['prodprice']; ?></p>
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
        <div class="col s12 m4">
          <div class="card medium hoverable">
            <div class="card-image">
              <img src="<?php echo base_url().'assets/images/noapproves.jpg'?>"/>
              <!-- <span class="card-title">No Products found</span> -->
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


    <div id="disapproves" class="col s12">
    <div class="row">
        

          <?php if($disapproves){
                        foreach ($disapproves as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		//echo '<pre>';print_r($value);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>
      
         <div class="col s12 m4">
          <div class="card small hoverable">
             <div class="card-image waves-effect waves-block waves-light">
               <!-- <img class="activator" src="<?php echo $data['photopath']; ?>"> -->
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Product-ID: <?php echo $data['prodid']; ?> Product-Title: <?php echo $data['prodtitle']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a class="" href="<?php echo base_url().'admin/updateproduct/approve/'.$data['prodid'] ?>">Approve</a>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $data['prodtitle']; ?> : <?php echo $data['prodid']; ?><i class="material-icons right">close</i></span>
               <p><span class="bold">Category:</span> <?php echo $data['catid']; ?></p>
               <p><span class="bold">Sub-Category:</span> <?php echo $data['subid']; ?></p>
               <p><span class="bold">Date-Added:</span> <?php echo $data['proddate']; ?></p>
               <p><span class="bold">Added-By:</span> <?php echo $data['userid']; ?></p>
               <p><span class="bold">Product-Location:</span> <?php echo $data['prodlocation']; ?></p>
               <p><span class="bold">Price-Given:</span> <?php echo $data['prodprice']; ?></p>
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
        <div class="col s10 m4">
          <div class="card medium hoverable">
            <div class="card-image">
              <img src="<?php echo base_url().'assets/images/nodisapproves.jpg'?>"/>
              <!-- <span class="card-title">No Products found</span> -->
            </div>
            <div class="card-content">
              <p>There are no currently disapproved products</p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
            </div> -->
          
        </div>
      </div>


				  <?php
					
				   }

				 ?>


        </div>
      </div>
    </div><!-- End of third tab -->



  </div><!-- End of row -->
        



               