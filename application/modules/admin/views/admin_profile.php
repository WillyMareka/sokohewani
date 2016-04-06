<h1 class="bold">Profile-ID: <?php $profileid = $this->session->userdata('adid');  echo $profileid;?></h1>
<p><hr/></p>

         <?php 

            foreach ($adminprofile as $key => $value) {
            //echo '<pre>';print_r($value);echo'</pre>';die();

               foreach ($value as $q => $data) {       		
                 for ($i=0; $i <= $key ; $i++) { 
                      			
           ?>

<h1><span class="bold">ID : </span><?php echo $data['adid']; ?></h1>
<p><span class="bold">First Name : </span><?php echo $data['adfname']; ?></p>
<p><span class="bold">Last Name : </span><?php echo $data['adlname']; ?></p>
<p><span class="bold">Email Address : </span><?php echo $data['ademail']; ?></p>

<a href="<?php echo base_url(). 'admin/adminview'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Admin Page</a>

<a href="<?php echo base_url(). 'admin/currentprofile/edit/'?><?php echo $this->session->userdata('adid'); ?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">input</i>Edit</a>



<?php 
                             }
                         }
                        
                       }
                        ?>