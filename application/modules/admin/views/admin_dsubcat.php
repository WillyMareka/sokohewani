 <div class="row">

                

                  <div class="col-lg-12">
                   <h2 class="table-title">Inactive Sub-Category Profiles</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/addsubcategory'?>">Add <?php echo $admin_subtitle?></a> -->
                       
                         <ul class="dropdown-menu">
                           
                           <li><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url().'admin/createsubcategoryview/pdf/inactive'?>">Export to PDF</a></li>
                           <li><a class="green waves-effect waves-light btn-large" href="<?php echo base_url().'admin/createsubcategoryview/excel/inactive'?>">Export to Excel</a></li>
                           <li><a class="blue right waves-effect waves-light btn-large" href="<?php echo base_url().'admin/activesubcategories'?>">Back to Sub-Categories</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="homeinsubcategoryprofiles"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>Sub-Category ID</th>
                          <th>Sub-Category Name</th>
                          <!-- <th>Description</th> -->
                          <th>Date Registered</th>
                          <th>Category ID</th>
                          <th>Sub-Category Status</th>
                          <th>View</th>
                          <th>Change Status</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_dsubcategories; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>