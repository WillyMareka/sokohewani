 <div class="row">

                

                  <div class="col-lg-12">
                   <h2 class="table-title">Inactive User Profiles</h2>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                      
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/adduser'?>">Add <?php echo $admin_subtitle?></a> -->
                       
                         <ul class="dropdown-menu">
                           
                           <li><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createusersview/pdf/inactive'?>">Export to PDF</a></li>
                           <li><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createusersview/excel/inactive'?>">Export to Excel</a></li>
                           <li><a class="blue right waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/activeusers'?>">Back to Users</a></li>
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
                          <th>Profile Status</th>
                          <th>Date Registered</th>
                          <th>View</th>
                          <th>Status</th>
                          <th>Delete</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_dusers; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>