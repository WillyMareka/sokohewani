


<div class="container" id="products-container">
<div class="panel panel-default" id="signup-panel">
	<div class="panel-heading">
		<h4 class="panel-title">Sign Up</h4>
	</div>
	<form class="form-horizontal" id="signup-form" method="post" action="<?php echo base_url(). 'home/add_user'?>">
		<div class="form-group">
			<label>Firstname</label>
			<input type="text" autofocus="autofocus"  class="form-control" name="firstname" placeholder="Enter Firstname" value="<?php echo set_value('firstname');?>">
			<?php echo form_error('firstname'); ?>
		</div>
		<div class="form-group">
			<label>Lastname</label>
			
			<input type="text" class="form-control" name="lastname" placeholder="Enter Lastname" value="<?php echo set_value('lastname');?>">
			<?php echo form_error('lastname'); ?>
		</div>
		<div class="form-group">
			<label>Email Address</label>
			
			<input type="email" class="form-control" name="email" placeholder="Email address eg: abc@mail.com" value="<?php echo set_value('email');?>">
			<?php echo form_error('email'); ?>
		</div>
		<div class="form-group">
			<label>Password</label>
			
			<input type="password" class="form-control" name="upassword" placeholder="Enter password">
			<?php echo form_error('upassword'); ?>
		</div>
		<div class="form-group">
			<label>Confirm password</label>
			
			<input type="password" class="form-control" name="passconf" placeholder="Confirm password">
			<?php echo form_error('passconf'); ?>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-info btn-lg btn-block" name="signup" value="Submit">Join Us</button>
		</div>

		<h6 style="float:right;"><a href="#">Forgot password?</a></h6>
	</form>
	</div><!--End of form tag-->
</div><!--End of panel tag-->
</div>


