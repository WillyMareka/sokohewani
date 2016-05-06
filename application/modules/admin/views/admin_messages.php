 <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Unread Messages</h2>
                   <p><hr/></p>

                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">
                        <!-- <ul class="dropdown-menu">
                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createmessagesview/pdf/unread'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createmessagesview/excel/unread'?>">Export to Excel</a></li>
                         </ul>-->
                       </div>
                     </div>

                     <table class="table table-striped datatable" id="umessageprofiles"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>Date/Time Submitted</th>
                          <th>Subject</th>  
                          <th>Mark Status</th>  
                          <th>View</th>
                          <th>Mark as Read</th>
                          <th>Delete</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_umessages; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>