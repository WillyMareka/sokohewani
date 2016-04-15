
<div class="container">
	<div class="row">
		<div class="col-md-12">



			<div class="col-md-4">
					<div class="panel panel-success" id="location-panel">
						<div class="panel-heading">
							<h4 class="panel-title">Our Location</h4>
						</div>
						<div class="panel-content" id="location-content">
						<h5>We are located at:</h5>
						<p>**************</p>
						<p>**************</p>
						<p>**************</p>
						<h5>Phone Numbers:</h5>
						<p>**************</p>
						<p>**************</p>
						<p>**************</p>
					    </div>
					</div>
					<li style="padding:10px; text-decoration: none;"><a href="#">GOOGLE MAP</a></li>
				</div>




			    <div class="col-md-8">
						<div class="panel panel-default" id="contact-panel">
							<div class="panel-heading">
								<h4 class="panel-title">Contact Us</h4>
							</div>
							<form class="form-horizontal" id="contact-form" method="POST" action="<?php echo base_url(). 'home/sendContact'?>"><!-- 
							<div class="form-group">
								<label>Names</label>
								<input type="text" name="conName" class="form-control" placeholder="Please enter your names">
								<?php echo form_error('conName'); ?>
							</div> -->
							<div class="form-group">
								<label>Email Address</label>
								<input type="email" name="conEmail" class="form-control" placeholder="Please enter your email address eg: abc@mail.com">
								<?php echo form_error('conEmail'); ?>
							</div>
							<div class="form-group">
								<label>Comment</label>
								<textarea class="form-control" rows="5" name="Com"></textarea>
								<?php echo form_error('Com'); ?>
							</div>
							<div class="form-group">
								<button type="submit" value="Submit" class="btn btn-info" name="submit">Send Comment</button>
							</div>
						    </form>
						</div>
				</div>


        </div>
    </div>
</div>

