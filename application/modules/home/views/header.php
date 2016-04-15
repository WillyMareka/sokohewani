<div id="wrapper">


     

            <header><!-- Beginning of header contains the navigation bar-->
              <div class="navigation">
                      <ul style="float:left;">
                      <li><a href="<?php echo base_url(). 'home/sokohome'?>">Home</a></li>
                       <li><a href="<?php echo base_url(). 'home/locate'?>">Location</a></li>
                       <li><a href="<?php echo base_url(). 'home/contact'?>">Contact Us</a></li>
                       <li><a href="<?php echo base_url(). 'home/products'?>">View Products</a></li>
                       <li><a href="<?php echo base_url(). 'home/addproduct'?>">Add Product</a></li>


                      </ul>

                      <ul style="float:right;">
                      <?php $firstname= $this->session->userdata('firstname');
     $lastname= $this->session->userdata('lastname');
     ?>
                      <?php if($this->session->userdata('logged_in')){?>
                        <!--<li><a href="<?php echo base_url(). 'home/logout'?>">Log out</a></li>-->
                        <div class="dropdown">
                          <li type="button" data-toggle="dropdown" >Hi <?php echo "$firstname"." " ."$lastname" ;?>
                          <span class="caret"></span></li>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(). 'home/currentprofile/view/'?><?php echo  $this->session->userdata('userid'); ?>">View profile</a></li>
                            <li><a href="<?php echo base_url(). 'home/addsview'?>">View your adds</a></li>
                            <li><a href="<?php echo base_url(). 'home/logout'?>">Log out</a></li>
                          </ul>
                        </div>
                      <?php }else{?>
                       <li><a href="<?php echo base_url(). 'home/login'?>">Log in</a></li>
                        <li><a href="<?php echo base_url(). 'home/Signup'?>">Sign Up</a></li>
                      <?php } ?>
                           
                       
                      </ul>
                    </div>
            </header><!--End of header-->


            <div class="container"><!-- Nvbar brand and search button-->
              <div class="row">

                <a class="navbar-brand" href="<?php echo base_url(). 'home/products'?>">SOKOHEWANI STORE</a>
                    





                       <div id="custom-search-input">

                                        <div class="input-group col-md-12">

                                      


                                            <span class="input-group-btn">
                                          
                                                <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo base_url() . 'home/productsearch'?>" class="form-horizontal" class="col s12">
                                                  <div class="form-group">
                                                    <input type="text" class="form-control" name="searchproduct" id="searchproduct" placeholder="Search for products by name">
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Search</button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>

  <form style="float:left;"  role="form" enctype="multipart/form-data" method="POST" action="<?php echo base_url() . 'home/filtersearch'?>" class="form-inline col s12">
  <div class="form-group">
    <label class="sr-only" for="searchcategory">Search Category</label>
    <input type="text" class="form-control" name="searchcategory" id="searchcategory" placeholder="Filter by Category">
  </div>
  <div class="form-group">
    <label class="sr-only" for="searchsubcategory">Search SubCategory</label>
    <input type="text" class="form-control" name="searchsubcategory" id="searchsubcategory" placeholder="Filter by SubCategory">
  </div>
 
  <button type="submit" class="btn btn-primary">Filter</button>
</form>
              </div>
            </div><!--End of navbar brand and search button-->