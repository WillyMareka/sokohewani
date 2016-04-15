 <?php 
     $userid= $this->session->userdata('userid');
     $firstname= $this->session->userdata('firstname');
     $lastname= $this->session->userdata('lastname');
     $email= $this->session->userdata('emailaddress');
 ?>
<div class="container" id="products-container">
	<div class="col-md-10" style="margin-left:auto;margin-right:auto;">
		<div class="panel-heading">
			<h4 class="title" style="margin-top:20px;margin-bottom:20px;">View Your Profile</h4>

		</div>
		<hr>
		<div class="col-md-4">
			<div class="userprofile-image"></div>
		</div>


<div class="col-md-8">

<div class="userprofile-details">
	<div class="form-group"><input type="text" class="input-box" style="" placeholder="Firstname" disabled value="<?php echo "$firstname"?>"></div>
	<div class="form-group"><input type="text" class="input-box" style="" placeholder="Lastname" disabled value="<?php echo "$lastname"?>"></div>
	<div class="form-group"><input type="email" class="input-box" placeholder="Email Address" disabled value="<?php echo "$email"?>"></div>
	<!-- <div class="form-group"><input type="text" class="input-box" placeholder="Phone Number" disabled ></div> -->
	<hr>
	<!-- <div class="form-group"><button type="submit" value="Submit" class="btn btn-primary" style="float:right;">Edit Profile</button></div> -->
	<a href="<?php echo base_url(). 'home/currentprofile/edit/'?><?php echo $this->session->userdata('userid'); ?>" class="btn waves-effect waves-light btn-small">Edit</a>
	
</div>
</div>


</div>
</div>

