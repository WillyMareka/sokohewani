<h1>SignUp Admin Page</h1>
<hr/>

<?php 
      if(isset($new_user)){
          echo $new_user;
      }else{
          echo "Please fill all details";
      }
    ?>

<br/><br/>
<div class="row">
    <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo base_url() . 'admin/signup'?>" class="form-horizontal">
      <div class="row">
        <div class="input-field col s6">
          <label for="first_name">First Name:</label>
          <input name="first_name" id="first_name" required type="text" class="validate">
        </div>
        <div class="input-field col s6">
          <label for="last_name">Last Name:</label>
          <input name="last_name" id="last_name" required type="text" class="validate">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="email">Email:</label>
          <input name="adminemail" id="adminemail" required type="email" class="validate">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="password">Password:</label>
          <input name="adminpassword" id="adminpassword" required type="password" class="validate">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="password">Confirm Password:</label>
          <input name="adminpassword2" id="adminpassword2" required type="password" class="validate">
        </div>
      </div>
      <button id="btn-signup" name="signup_button" type="submit" class="btn btn-success signup"> Sign Up</button>  
    </form>
  </div>