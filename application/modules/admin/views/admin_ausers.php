 <div class="row">

              

                  <div class="col-lg-12">
                   <h2 class="table-title">Active User Profiles</h2>
                   <p><hr/></p>

                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">
                         <!--<ul class="dropdown-menu">
                           <li class="download"><a class="left red waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createusersview/pdf/active'?>">Export to PDF</a></li>
                           <li class="download"><a class="green waves-effect waves-light btn-large" href="<?php echo base_url(). 'admin/createusersview/excel/active'?>">Export to Excel</a></li>
                         </ul>-->
                       </div>
                     </div>

                     <table class="table table-striped datatable" id="homeuserprofiles"><!-- The table created in the page -->
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
                          <th>Action</th>
                          <!-- <th>Delete</th> -->
                        </tr>
                       </thead>
                        <?php
                          echo $all_users; 
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>

             <!-- Modal Trigger -->
  

  <!-- Modal Structure -->
<!--   <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
  </div> -->