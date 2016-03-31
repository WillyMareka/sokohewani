 <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Active Categories</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/addcategory'?>">Add <?php echo $admin_subtitle?></a> -->
                       <!-- <a class="left blue waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/newcategory'?>">Add New Category</a> -->
                         
                         <ul class="dropdown-menu">

                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createcategoryview/pdf/active'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createcategoryview/excel/active'?>">Export to Excel</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="homeactcategoryprofiles"><!-- The table created in the page -->
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
                          echo $all_categories; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>