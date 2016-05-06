                
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
                      			
                      		?>




          <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Awaiting Products</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
           
                         
                        <!-- <ul class="dropdown-menu">

                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createproductview/pdf/active'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createproductview/excel/active'?>">Export to Excel</a></li>
                         </ul>-->
                       </div>
                     </div>
                     <table class="table table-striped" id="homeactiveproducts"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>ProductID</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>SubCategory</th>
                          <th>UserID</th>
                          <th>Price</th>
                          <th>Location</th>
                          <th>DateSubmitted</th>
                          <th>View</th>
                          <th>Status</th>
                        </tr>
                       </thead>
                        <?php
                          echo $waits; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>
                        
                  
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
                      			
                      		?>


            <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Active Products</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
   
                         
                     <!--    <ul class="dropdown-menu">

                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createproductview/pdf/active'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createproductview/excel/active'?>">Export to Excel</a></li>
                         </ul>-->
                       </div>
                     </div>
                     <table class="table table-striped" id="homeinactiveproducts"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>ProductID</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>SubCategory</th>
                          <th>UserID</th>
                          <th>Price</th>
                          <th>Location</th>
                          <th>DateSubmitted</th>
                          <th>View</th>
                          <th>Status</th>
                        </tr>
                       </thead>
                        <?php
                          echo $approves; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>
                        
                  
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
		
                      		?>



           <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Awaiting Products</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      

                         
                      <!--   <ul class="dropdown-menu">

                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createproductview/pdf/active'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createproductview/excel/active'?>">Export to Excel</a></li>
                         </ul>-->
                       </div>
                     </div>
                     <table class="table table-striped" id="homewaitingproducts"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>ProductID</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>SubCategory</th>
                          <th>UserID</th>
                          <th>Price</th>
                          <th>Location</th>
                          <th>DateSubmitted</th>
                          <th>View</th>
                          <th>Status</th>
                        </tr>
                       </thead>
                        <?php
                          echo $disapproves; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>
                        
                  
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
        



               