<?php 
     $firstname= $this->session->userdata('firstname');
     $lastname= $this->session->userdata('lastname');
     $email= $this->session->userdata('emailaddress');
 ?>


	<script type="text/javascript">

  </script>

  
<div class="container" id="products-container">
<div class="addpro-box" style="width:800px;">
	<form  enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() . 'home/addingproduct' ?>" method="POST">

	<div class="form-heading">
		<h4 class="form-title">Submit An advert</h4>
	</div>

	            <hr>
	
				<div class="form-group">
					<label style="float:left; margin-right:20px;">Title<span style="color:red;">* </span></label>
					<input type="text" class="form-control" name="title" style="width:400px;margin-left:100px;" >
					<div class="addppro-errors"><?php echo form_error('title'); ?></div>
				</div>

				<hr>

				 <div class="form-group">
			      <label style="float:left; margin-right:20px;">Category</label>
			     
			        <?php echo $category;?>

			      <div class="addppro-errors"><?php echo form_error('category'); ?></div>
                </div>





                <div class="form-group other_categories">
			      <label for="subcategory" style="float:left; margin-right:20px;">Sub-Category</label>
			     
			        <?php //echo $subcategory;  ?>

			      <select name = "sub_category" id = "sub_category" class="form-control" style="width:400px;"> 
			      	
			      	//this has been mentioned in the get method
                       //leave this empty
                 </select>
                </div>

              <!--  <?php $subcategories['#'] = 'Please Select SubCategory'; ?>
               <label for="subcategories">SubCategory: </label><?php echo form_dropdown('subid', $subcategories, '#', 'id="subcategories"'); ?><br /> -->





                
                <div class="form-group">
					<label style="float:left; margin-right:20px;">Price<span style="color:red;">* </span></label>
					<input type="text" class="form-control" name="price" style="width:400px;margin-left:100px;" >
					<div class="addppro-errors"><?php echo form_error('price'); ?></div>
				</div>
					
              

               <hr>

				<div class="form-group">
					<label style="float:left;margin-right:10px;">Description<span style="color:red;">* </span></label>
					<textarea class="form-control" rows="5" style="width:400px;margin-left:100px;" name="descript"></textarea>
					<div class="addppro-errors "><?php echo form_error('descript'); ?></div>
					
				</div>

				 <hr>

   								<div class="form-group">
                                    <label for="picture" class="col-md-3 control-label">Picture</label>
                                    <div class="col-md-9">
                                        <!-- <input type="file" class="form-control" id="picture" name="picture" > -->
                                        <input type="file" name="files[]" id="filer_input" multiple="multiple"></input>
                                    </div>
                                </div>

                                <hr>



				<br>

		
				<div class="form-group">
					<label style="float:left;">Phone Number<span style="color:red;">* </span></label>		
					<input type="phoneNo" class="form-control" name="phoneNo" style="width:400px;margin-left:150px;">
					<div class="addppro-errors_2"><?php echo form_error('phoneNo'); ?></div>
				</div>  

<hr>

<div class="form-group">
					<label style="float:left;margin-right:10px;">Your Location<span style="color:red;">* </span></label>
					<input type="text" id="myPlaceTextBox"  class="form-control" name="neighbourhood"/>
					<?php echo $map['html']; ?>
					<div class="addppro-errors_2"><?php echo form_error('neighbourhood'); ?></div>
</div>
<hr>

				<div class="form-group">
					<button type="submit" value="Submit" class="btn btn-primary" name="submit" style="float:right;" >Submit Product</button>
				</div>

				<br>




</form>
</div>

</div>