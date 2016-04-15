
<div class="container" id="products-container">
<div class="panel panel-default" id="login-panel">
	<div class="panel-heading">
		<h4 class="panel-title">Login Form</h4>
	</div><!--End of head tag-->
	<form class="form-horizontal" method="POST" action="<?php echo base_url(). 'home/login_user'?>" id="login-form">
		<div class="form-group">
			<label class="control-label">Email Address</label>
			<input type="text" autofocus="autofocus" class="form-control" name="user_email" placeholder="Email Address eg: abc@mail.com" value="<?php echo set_value('user_email');?>" >
			<?php echo form_error('user_email'); ?>
		</div>

		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="user_pass" placeholder="Enter your password" >
			<?php echo form_error('user_pass'); ?>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info btn-lg btn-block"  name="submit" value="Submit">Log In</button>
		</div>

		<h6 style="float:right;"><a href="#">Forgot password?</a></h6>
		<h6 style="float:left;"><a href="#">Do not have an account?</a></h6>
	</form>

	</div><!--End of form tag-->
</div><!--End of panel tag-->
</div>



