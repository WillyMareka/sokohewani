<div class="row">
        

          <?php if($photos){
                        foreach ($photos as $key => $value) {
                      	 foreach ($value as $q => $data) {
                      		
                      		//echo '<pre>';print_r($waits);echo'</pre>';die();
                      		for ($i=0; $i <= $key ; $i++) { 
                      			
                      		?>
<!-- <div class="col s12 m4 hoverable margin-space"> 

  <img class="materialboxed" data-caption="For Product-ID:<?php echo $data['prodid'];?> -- <?php echo $data['photoinfo'];?>" width="350" src="<?php echo base_url(). 'assets/images/mareka.jpg'?>">
  <div class="caption left-align">
          <h3>This is our big Tagline!</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
          
</div> -->


<div class="col s12 m4">
<img class="materialboxed" width="350" src="<?php echo base_url(). 'assets/images/mareka.jpg'?>">
               <!-- <img class="activator" src="<?php echo $data['photopath']; ?>"> -->
          <div class="card small hoverable">
             <!-- <div class="card-image waves-effect waves-block waves-light"> -->
               
             <!-- </div> -->
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">Photo-ID: <?php echo $data['photoid']; ?> Product For Product-ID: <?php echo $data['prodid']; ?><i class="material-icons right">more_vert</i></span>
             </div>
             <div class="card-action">
              <a class="" href="<?php echo base_url().'admin/updateproduct/approve/'.$data['prodid'] ?>">Approve</a>
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
                       <div class="col s12 m4">
                         <div class="card small">
                           <div class="card-image">
                             
                           <img class="materialboxed" data-caption="A picture of some deer and tons of trees" width="250" src="http://th01.deviantart.net/fs70/PRE/i/2013/126/1/e/nature_portrait_by_pw_fotografie-d63tx0n.jpg">
          
                             <!-- <span class="card-title">No Products found</span> -->
                           </div>
                           <div class="card-content">
                             <p>There are no currently pending approvals</p>
                           </div>
                         </div>
                       </div>
                     </div>


				  <?php
					
				   }

				 ?>



        
      </div>