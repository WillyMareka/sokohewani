<h1 class="bold">User View</h1><?php echo $data['catid']; ?>
<p><hr/></p>

<?php foreach ($userdetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>



<h1><span class="bold">ID : </span><?php echo $data['userid']; ?></h1>
<p><hr/></p>
<p><span class="bold">First Name : </span><?php echo $data['firstname']; ?></p>
<p><span class="bold">Last Name : </span><?php echo $data['lastname']; ?></p>
<p><span class="bold">Email Address : </span><?php echo $data['emailaddress']; ?></p>
<p><span class="bold">Registration Date : </span><?php echo $data['regdate']; ?></p>
<p><span class="bold">Status : </span><?php echo $data['userstatus']; ?></p>

<a href="<?php echo base_url(). 'admin/activeusers'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Users</a>

<a href="<?php echo base_url(). 'admin/userdetail/edit/'?><?php echo $data['userid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">input</i>Edit</a>



<?php 
                             }
                         }
                        
                       }
                        ?>