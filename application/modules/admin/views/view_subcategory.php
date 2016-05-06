<h1 class="bold">Sub-Category View</h1>
<p><hr/></p>

<?php foreach ($subcategorydetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>



<h1><span class="bold">Sub-Category Name : </span><?php echo $data['subname']; ?></h1>
<p><hr/></p>
<p><span class="bold">Category Name : </span><?php echo $data['catid']; ?></p>
<p><span class="bold">Date Registered : </span><?php echo $data['subdate']; ?></p>
<p><span class="bold">Status : </span><?php if($data['subcatstatus'] == 0){
                  	echo "Deactivated";
                  }elseif ($data['subcatstatus'] == 1) {
                  	echo "Activated";
                  }
 
	// echo $data['subcatstatus']; ?></p>
<p><span class="bold">Description : </span><?php echo $data['subdescription']; ?></p>

<a href="<?php echo base_url(). 'admin/activesubcategories'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Sub-Categories</a>

<a href="<?php echo base_url(). 'admin/subcategorydetail/edit/'?><?php echo $data['subid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">input</i>Edit</a>



<?php 
                             }
                         }
                        
                       }
                        ?>