<h1 class="bold">User Edit</h1>
<p><hr/></p>

<div class="row margin-space">
    <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'admin/edituser'?>" class="form-horizontal" role="form" class="col s12 m6">

<?php foreach ($userdetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>
   <div class="controls">
   <input name="user-id" type="hidden"  value="<?php echo $data['userid']; ?>" class="span6 m-wrap form-control "/>
   </div>

   <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $data['firstname']; ?>" required id="first-name" name="first-name" type="text" class="validate">
      <label class="active" for="first-name">First Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $data['lastname']; ?>" required id="last-name" name="last-name" type="text" class="validate">
      <label class="active" for="last-name">Last Name</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $data['emailaddress']; ?>" required id="email-address" name="email-address" type="email" class="validate">
      <label class="active" for="email-address">Email Address</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $data['regdate']; ?>" id="reg-date" required name="reg-date" type="text" class="validate">
      <label class="active" for="reg-date">Registration Date</label>
    </div>
  </div>

  <!-- <div class="row">
    <div class="input-field col s6">
      <input value="<?php echo $data['userstatus']; ?>" id="user-status" name="user-status" type="text" class="validate">
      <label class="active" for="user-status">Status</label>
    </div>
  </div> -->

  <div class="input-field col s12">
    <select id="user-status" name="user-status">
      <option value="<?php echo $data['userstatus']; ?>" selected><?php 
     $state = $data['userstatus'];
if($state == 1){
  echo "Activated";
}else{
  echo "Deactivated";
}
      


      ?></option>
      <option value="1">Activate</option>
      <option value="0">Deactivate</option>
    </select>
    <label>Status</label>
  </div>

<?php 
                             }
                         }
                        
                       }
                        ?>
<div class="row">
        <div class="input-field col s6">
      <button class="btn waves-effect waves-light" type="submit" name="action">Edit User
        <i class="material-icons right">system_update_alt</i>
      </button>
        </div>
        
      </div>

      <a href="<?php echo base_url(). 'admin/userdetail/view/'?><?php echo $data['userid']; ?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to View</a>
                        

        </form>
  </div>


  