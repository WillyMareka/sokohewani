 <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Read Messages</h2>
                   <p><hr/></p>

                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">
                        <!-- <ul class="dropdown-menu">
                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createmessagesview/pdf/read'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createmessagesview/excel/read'?>">Export to Excel</a></li>
                         </ul>-->
                       </div>
                     </div>

                     <table class="table table-striped datatable" id="rmessageprofiles"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>Date/Time Submitted</th>
                          <th>Subject</th>  
                          <th>Mark Status</th>  
                          <th>View</th>
                          <th>Mark as Unread</th>
                          <th>Delete</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_rmessages; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>