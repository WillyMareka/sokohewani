<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $admin_title?> <small><?php echo $admin_subtitle?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <i class="fa fa-dashboard"></i>
                                   <!-- <a class="crumbs" href="<?php echo base_url(). 'admin'?>">Manager Dashboard</a> -->
                                   <a class="crumbs" href="<?php echo base_url(). 'index.php/admin'?>">Manager Dashboard</a>
                                   <?php if($passmessage){ ?>
                                   <!-- <a href="<?php echo base_url().'admin/viewemployee/'.$this->session->userdata('emp_id')?>" class="animated flash red"> <?php echo $passmessage ?> </a> -->
                                   <a href="<?php echo base_url().'index.php/admin/viewemployee/'.$this->session->userdata('emp_id')?>" class="animated flash red"> <?php echo $passmessage ?> </a>
                                    <?php }else{$passmessage="";echo $passmessage;} ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $clientnumber?></div>
                                        <div>Clients</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="<?php echo base_url(). 'admin/clients'?>"> -->
                            <a href="<?php echo base_url(). 'index.php/admin/clients'?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View More</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-gift fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $productnumber?></div>
                                        <div>Products</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="<?php echo base_url(). 'admin/products'?>"> -->
                            <a href="<?php echo base_url(). 'index.php/admin/products'?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View More</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-sitemap fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $categorynumber?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="<?php echo base_url(). 'admin/categories'?>"> -->
                            <a href="<?php echo base_url(). 'index.php/admin/categories'?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View More</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $commentnumber?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="<?php echo base_url(). 'admin/comments'?>"> -->
                            <a href="<?php echo base_url(). 'index.php/admin/comments'?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View More</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12"><hr/></div>


                                <div class="row">
                  <div class="col-lg-12">
                   <h2 class="table-title">Categories</h2>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">
                       <a class="left adminadd" href="<?php echo base_url(). 'index.php/admin/addcategory'?>">Add Category</a>
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'index.php/admin/addcategory'?>">Add Category</a> -->
                         <button data-toggle="dropdown" class="btn dropdown-toggle right ">Download <?php echo $admin_subtitle?> <span class="caret"></span></button>
                         <ul class="dropdown-menu">
                           <!-- <li><a href="<?php echo base_url(). 'admin/allcategories/pdf'?>">Download <?php echo $admin_subtitle?> to PDF</a></li>
                           <li><a href="<?php echo base_url(). 'admin/allcategories/excel'?>">Download <?php echo $admin_subtitle?> to Excel</a></li> -->

                           <li><a href="<?php echo base_url(). 'index.php/admin/allcategories/active/pdf'?>">Download <?php echo $admin_subtitle?> to PDF</a></li>
                           <li><a href="<?php echo base_url(). 'index.php/admin/allcategories/active/excel'?>">Download <?php echo $admin_subtitle?> to Excel</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="category-table">
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>Category Name</th>
                          <th>Category Status</th>
                          <th>View</th>
                          <!-- <th>Edit</th> -->
                          <th>Action</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_categories;
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>
                <!-- /.row -->
                  <div class="col-lg-12"><hr/></div>

                <div class="row">
                  <div class="col-lg-12">
                   <h2 class="table-title">Products</h2>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/addproduct'?>">Add Product</a> -->
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'index.php/admin/addproduct'?>">Add Product</a> -->
                         <button data-toggle="dropdown" class="btn dropdown-toggle right ">Download <?php echo $admin_subtitle?> <span class="caret"></span></button>
                         <ul class="dropdown-menu">
                           <!-- <li><a href="<?php echo base_url(). 'admin/allcategories/pdf'?>">Save as PDF</a></li>
                           <li><a href="<?php echo base_url(). 'admin/allcategories/excel'?>">Download <?php echo $admin_subtitle?> to Excel</a></li> -->

                           <li><a href="<?php echo base_url(). 'index.php/admin/allcategories/active/pdf'?>">Save as PDF</a></li>
                           <li><a href="<?php echo base_url(). 'index.php/admin/allcategories/active/excel'?>">Download <?php echo $admin_subtitle?> to Excel</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="product-table">
                       <thead>
                        <tr>
                           <th>#</th>
                          <th>Product Name</th>
                          <th>Product Description</th>
                          <th>Product Price</th>
                          <th>Status</th>
                          <th>View</th>
                          <!-- <th>Edit</th> -->
                          <th>Action</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_products;
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>
                <!-- /.row -->

                <div class="col-lg-12"><hr/></div>

                <div class="row">
                  <div class="col-lg-12">
                   <h2 class="table-title">Employees</h2>
                   <div class="table-responsive">
                     <div class="table-toolbar">
                       <div class="btn-group pull-right table-buttons">

                       
                       <!-- <a class="left adminadd" href="<?php echo base_url(). 'admin/addemployee'?>">Add Employees</a> -->
                       <a class="left adminadd" href="<?php echo base_url(). 'index.php/admin/addemployee'?>">Add Employees</a>
                         <button data-toggle="dropdown" class="btn dropdown-toggle right ">Download <?php echo $admin_subtitle?> <span class="caret"></span></button>
                         <ul class="dropdown-menu">
                           <!-- <li><a href="<?php echo base_url(). 'admin/allemployees/pdf'?>">Download <?php echo $admin_subtitle?> to PDF</a></li>
                           <li><a href="<?php echo base_url(). 'admin/allemployees/excel'?>">Download <?php echo $admin_subtitle?> to Excel</a></li> -->

                           <li><a href="<?php echo base_url(). 'index.php/admin/allemployees/active/pdf'?>">Download <?php echo $admin_subtitle?> to PDF</a></li>
                           <li><a href="<?php echo base_url(). 'index.php/admin/allemployees/active/excel'?>">Download <?php echo $admin_subtitle?> to Excel</a></li>
                         </ul>
                       </div>
                     </div>
                     <table class="table table-striped" id="administrator-table"><!-- The table created in the page -->
                       <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Occupation</th>
                          <th>Date Registered</th>
                          <th>Status</th>
                          <th>View</th>
                          <th>Action</th>
                        </tr>
                       </thead>
                        <?php
                          echo $all_administrators;
                        ?>
                   </table>

                     
                   </div>
                 </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12"><hr/></div>

                

           
            <!-- /.container-fluid -->

        </div>

        </div>
        <!-- /#page-wrapper -->


        <script type="text/javascript">
              $('#category-table').dataTable();
              $('#product-table').dataTable();
              $('#administrator-table').dataTable();

              
            $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
            $('.dataTables_length select').addClass('form-control');
        </script>