 <div class="container" id="products-container">
	<div class="row">
		<div class="col-md-12">
					 <?php 
					        if($productdata){
					              foreach ($productdata as $key => $value) {
					              foreach ($value as $q => $data) {
					                      		
					              //echo '<pre>';print_r($productdata);echo'</pre>';die();
					             for ($i=0; $i <= $key ; $i++) { 
					                      			
					 ?>







			<div class="col-sm-6 col-md-3">
			    <div class="thumbnail" >
			      <img src="<?php echo $data['photopath']; ?>">
			      <div class="caption">
			       <p>Product Name: <?php echo $data['prodtitle']; ?> </p>
			       <p>Price: <?php echo $data['prodprice']; ?>  </p>
                   <a href="<?php echo base_url(). 'home/addphotos/'?><?php echo $data['prodid'];?>" class="btn waves-effect waves-light btn-small">Add Photos</a>
			       <a href="<?php echo base_url(). 'home/ownproductdetails/'?><?php echo $data['prodid'];?>" class="btn waves-effect waves-light btn-small">View Product</a>
			      </div>
			    </div>
			  </div>







		



<?php 
                }
              }
            } 
         }
?>



                        </div>
	</div>
</div>
