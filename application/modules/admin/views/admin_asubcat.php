 <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Active Sub-Categories</h2>
                   <p><hr/></p>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/addsubcategory'?>">Add <?php echo $admin_subtitle?></a> -->
                       <a class="left blue waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/newsubcategory'?>">Add New Sub-Category</a>
                         
                         <ul class="dropdown-menu">

                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createsubcategoryview/pdf/active'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createsubcategoryview/excel/active'?>">Export to Excel</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="homeactsubcategoryprofiles"><!-- The table created in the page -->
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
                          echo $all_subcategories; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>