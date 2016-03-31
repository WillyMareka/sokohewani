 <div class="row">

                

                  <div class="col-lg-12">
                   <h2 class="table-title">Inactive Category Profiles</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/addcategory'?>">Add <?php echo $admin_subtitle?></a> -->
                       
                         <ul class="dropdown-menu">
                           
                           <li><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url().'admin/createcategoryview/pdf/inactive'?>">Export to PDF</a></li>
                           <li><a class="green waves-effect waves-light btn-large" href="<?php echo base_url().'admin/createcategoryview/excel/inactive'?>">Export to Excel</a></li>
                           <li><a class="blue right waves-effect waves-light btn-large" href="<?php echo base_url().'admin/activecategories'?>">Back to Categories</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="homeincategoryprofiles"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>Category ID</th>
                          <th>Category Name</th>
                          <!-- <th>Description</th> -->
                          <th>Date Registered</th>
                          <th>Category Status</th>
                          <th>View</th>
                          <th>Change Status</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_dcategories; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>