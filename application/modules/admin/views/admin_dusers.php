 <div class="row">

                

                  <div class="col-lg-12">
                   <h2 class="table-title">User Profiles</h2>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/adduser'?>">Add <?php echo $admin_subtitle?></a> -->
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'index.php/admin/adduser'?>">Add <?php echo $admin_subtitle?></a> -->
                         <button data-toggle="dropdown" class="btn dropdown-toggle right ">Download Active Users <span class="caret"></span></button>
                         <ul class="dropdown-menu">
                           
                           <li><a href="<?php echo base_url(). 'admin/createusersview/inactive/pdf'?>">Export to PDF</a></li>
                           <li><a href="<?php echo base_url(). 'admin/createusersview/inactive/excel'?>">Export to Excel</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="homeinuserprofiles"><!-- The table created in the page -->
                       <thead>
                        <tr>

                          <th>#</th>
                          <th>User ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email Address</th>
                          <th>Status</th>
                          <th>Date Registered</th>
                          <th>View</th>
                          <th>Status</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_dusers; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>