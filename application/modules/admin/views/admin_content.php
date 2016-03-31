<h1 class="table-title">Admin Home Page</h1>
                   <p><hr/></p>

                   <div class="row">

        <div class="col s12 m6">
          <div class="card hoverable  teal darken-3">
            <div class="card-content white-text">
              <span class="card-title">Users</span>
              <p>View the currently active users and inactive users that have signed into the system</p>
            </div>
            <div class="card-action">
              <a href="<?php echo base_url(). 'admin/activeusers'?>">Active Users</a>
              <a href="<?php echo base_url(). 'admin/inactiveusers'?>">Inactive Users</a>
            </div>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="card hoverable blue darken-3">
            <div class="card-content white-text">
              <span class="card-title">Products</span>
              <p>Check the newly submitted products as well as the active and inactive existing products</p>
            </div>
            <div class="card-action">
              <a href="<?php echo base_url(). 'admin/productsview'?>">View Products</a>
            </div>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="card hoverable grey darken-3">
            <div class="card-content white-text">
              <span class="card-title">Categories</span>
              <p>View the active and inactive categories together with their sub-categories</p>
            </div>
            <div class="card-action">
              <a href="<?php echo base_url(). 'admin/activecategories'?>">Active Categories</a>
              <a href="<?php echo base_url(). 'admin/inactivecategories'?>">Inactive Categories</a>
            </div>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="card hoverable red darken-3">
            <div class="card-content white-text">
              <span class="card-title">Photos</span>
              <p>Check out the new photo submitted by users and view the existing deactivated ones</p>
            </div>
            <div class="card-action">
              <a href="<?php echo base_url(). 'admin/photosview'?>">New Photos</a>
              <a href="<?php echo base_url(). 'admin/inactivephotos'?>">Rejected Photos</a>
            </div>
          </div>
        </div>

</div>

