<h1 class="bold">Message View</h1><?php echo $data['messid']; ?>
<p><hr/></p>

<?php foreach ($messagedetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>



<h1><span class="bold">Subject : </span><?php echo $data['messsubject']; ?></h1>
<p><span class="bold">Date/Time Recieved : </span><?php echo $data['messrecieved']; ?></p>
<p><span class="bold">Message : </span><?php echo $data['messmessage']; ?></p>

<p><a href="<?php echo base_url(). 'admin/messagedelete/'?><?php echo $data['messid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">delete</i>Delete Message</a></p>


<a href="<?php echo base_url(). 'admin/unreadmessages'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Unread Messages</a>

<a href="<?php echo base_url(). 'admin/unreadmessages'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_next</i>Read Messages</a>



<?php 
                             }
                         }
                        
                       }
                        ?>