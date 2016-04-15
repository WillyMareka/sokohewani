Product ID : <?php echo $productid;?>

<form  enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() . 'home/addingphoto' ?>" method="POST">

        <div class="controls">
   <input name="productid" type="hidden"  value="<?php echo $productid; ?>" class="span6 m-wrap form-control "/>
   </div>



    <div class="form-group">
        <label for="picture" class="col-md-3 control-label">Picture</label>
        <div class="col-md-9">
            <input type="file" name="files[]" id="filer_input" multiple="multiple"></input>
        </div>
    </div>

   

        <div class="form-group">
					<button type="submit" value="Submit" class="btn btn-primary" name="submit" style="float:right;" >Submit Photos</button>
				</div>

</form>