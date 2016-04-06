<h1 class="bold">Profile-ID: <?php echo $this->session->userdata('adid'); ?> Edit</h1>
<p><hr/></p>

<div class="row margin-space">
    <form enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'admin/editprofile'?>" role="form" class="col s12 m6">


   <div class="controls">
   <input name="ad-id" type="hidden"  value="<?php echo $data['adid']; ?>" class="span6 m-wrap form-control "/>
   </div>

   <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $this->session->userdata('adfname'); ?>" id="first-name" required name="first-name" type="text" class="validate">
      <label class="active" for="first-name">First Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $this->session->userdata('adlname'); ?>" id="last-name" required name="last-name" type="text" class="validate">
      <label class="active" for="last-name">Last Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $this->session->userdata('ademail'); ?>" id="email-address" required name="email-address" type="email" class="validate">
      <label class="active" for="email-address">Email Address</label>
    </div>
  </div>




       <div class="row">
        <div class="input-field col s6">
          <button class="btn waves-effect waves-light" type="submit" name="action">Edit Profile
            <i class="material-icons right">system_update_alt</i>
          </button>
        </div>
       </div>

      <a href="<?php echo base_url(). 'admin/currentprofile/view/'?><?php echo $this->session->userdata('adid'); ?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to View</a>
                        

        </form>

    <div class="row">

    <h4>Change Password</h4>
    <hr/>


    <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'admin/editprofilepass'?>" role="form" class="col s12 m6">
    <div class="controls">
      <input name="ad-id" type="hidden"  value="<?php echo $this->session->userdata('adid'); ?>" class="span6 m-wrap form-control "/>
    </div>
     <?php
        if (isset($logmessage)){
         ?>
            <div class="card-panel black-text white">
              <?php echo $logmessage; ?>
           </div>
         <?php } elseif (!(isset($logmessage))) { ?>
            <div class="card-panel black-text white">
                              <?php echo "Fill all fields in change password form to change password"; ?>
            </div>
        <?php } elseif (null !== validation_errors()) { ?>
             <div class="card-panel black-text white">
               <?php echo validation_errors(); ?>
             </div>
        <?php } ?>
      <div class="row">
        <div class="input-field col s12">
          <input id="oldpassword" required name="oldpassword" type="password" class="validate">
          <label for="oldpassword">Old Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="newpassword" required name="newpassword" type="password" class="validate">
          <label for="newpassword">New Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="newpassword2" required name="newpassword2" type="password" class="validate">
          <label for="newpassword2">Confirm Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button class="btn waves-effect waves-light" type="submit" name="action">Change Password
            <i class="material-icons right">system_update_alt</i>
          </button>
        </div>
       </div>

      
      
    </form>


  </div>


  </div>


