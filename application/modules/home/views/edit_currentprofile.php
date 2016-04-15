<h1 class="bold">Profile-ID: <?php echo $this->session->userdata('adid'); ?> Edit</h1>
<p><hr/></p>

<div class="row margin-space">
    <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'home/editprofile'?>" role="form" class="col s12 m6">


   <div class="controls">
   <input name="user-id" type="hidden"  value="<?php echo $this->session->userdata('userid'); ?>" class="span6 m-wrap form-control "/>
   </div>

   <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $this->session->userdata('firstname'); ?>" id="first-name" required name="first-name" type="text" class="validate">
      <label class="active" for="first-name">First Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $this->session->userdata('lastname'); ?>" id="last-name" required name="last-name" type="text" class="validate">
      <label class="active" for="last-name">Last Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $this->session->userdata('emailaddress'); ?>" id="email-address" required name="email-address" type="email" class="validate">
      <label class="active" for="email-address">Email Address</label>
    </div>
  </div>




       <div class="row">
        <div class="input-field col s6">
          <button class="btn waves-effect waves-light" type="submit" name="action">Edit Profile
          </button>
        </div>
       </div>

      
                        

        </form>

        <a href="<?php echo base_url(). 'home/currentprofile/view/'?><?php echo  $this->session->userdata('userid'); ?>" class="btn waves-effect waves-light btn-small">Back to View</a>

     <?php
        if (isset($logmessage)){
         ?>
            <div class="card-panel black-text white">
              <?php echo $logmessage; ?>
           </div>
         <?php } elseif (!(isset($logmessage))) { ?>
            <div class="card-panel black-text white">
                              <?php echo "All fields must be entered"; ?>
            </div>
        <?php } elseif (null !== validation_errors()) { ?>
             <div class="card-panel black-text white">
               <?php echo validation_errors(); ?>
             </div>
        <?php } ?>
 




  </div>


