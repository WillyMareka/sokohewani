<h1 class="bold">Category View</h1>
<p><hr/></p>

<?php foreach ($categorydetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($categorydetails);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>



<h1><span class="bold">Product Name : </span><?php echo $data['prodtitle']; ?></h1>
<p><hr/></p>
<p><span class="bold">Category : </span><?php echo $data['catname']; ?></p>
<p><span class="bold">Sub-Category : </span><?php echo $data['subname']; ?></p>
<p><span class="bold">Price : </span><?php echo $data['prodprice']; ?></p>
<p><span class="bold">Description : </span><?php echo $data['proddesc']; ?></p>

<a href="<?php echo base_url(). 'admin/activecategories'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Categories</a>

<a href="<?php echo base_url(). 'admin/categorydetail/edit/'?><?php echo $data['catid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">input</i>Edit</a>

<a href="<?php echo base_url(). 'admin/subpercategory/'?><?php echo $data['catid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">view_list</i>View Sub-Categories</a>


<?php 
                             }
                         }
                        
                       }
                        ?>