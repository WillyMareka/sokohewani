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
              <a href="<?php echo base_url(). 'admin/activeusers'?>">All Users</a>
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
              <p>View the active and inactive categories and their sub-categories</p>
            </div>
            <div class="card-action">
              <a href="<?php echo base_url(). 'admin/activecategories'?>">All Categories</a>
              <a href="<?php echo base_url(). 'admin/inactivecategories'?>">Inactive Categories</a>
            </div>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="card hoverable red darken-3">
            <div class="card-content white-text">
              <span class="card-title">Messages</span>
              <p>Check out the new messages submitted by users</p>
            </div>
            <div class="card-action">
              <a href="<?php echo base_url(). 'admin/unreadmessages'?>">View Messages</a>
            </div>
          </div>
        </div>

</div>

