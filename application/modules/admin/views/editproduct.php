
<h1 class="bold">Product Edit</h1>
<p><hr/></p>

<div class="row margin-space">


<div class="col s12 m12">
    <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url(). 'admin/editproduct'?>" class="form-horizontal" role="form" >

          <?php 

               //echo '<pre>';print_r($productdetails);echo '</pre>';die;
                               
          ?>

    <div class="controls">
   <input name="productid" type="hidden"  value="<?php echo $productdetails['prodid']; ?>" class="span6 m-wrap form-control "/>
   </div>

   <div class="row">
   <div class="col s6">

   <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['prodtitle']; ?>" id="prodtitle" required name="prodtitle" type="text" class="validate">
      <label class="active" for="prodtitle">Product Title</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['catname']; ?>" id="categoryname" required name="categoryname" type="text" class="validate">
      <label class="active" for="categoryname">Category</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['subname']; ?>" id="subcategoryname" required name="subcategoryname" type="text" class="validate">
      <label class="active" for="subcategoryname">SubCategroy</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['proddesc']; ?>" id="description" required name="description" type="text" class="validate">
      <label class="active" for="description">Description</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['prodlocation']; ?>" id="location" required name="location" type="text" class="validate">
      <label class="active" for="location">Product Location</label>
    </div>
  </div>

</div>
 <div class="col s6">


  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['proddate']; ?>" id="date" required name="date" type="text" class="validate">
      <label class="active" for="date">Date Submitted</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['userid']; ?>" id="userid" required name="userid" type="text" class="validate">
      <label class="active" for="userid">Submitted By UserID</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s6">
      <input disabled value="<?php echo $productdetails['prodprice']; ?>" id="price" required name="price" type="text" class="validate">
      <label class="active" for="price">Price</label>
    </div>
  </div>

<div class="row">
  <div class="input-field col s6">
    <select id="approval" name="approval">
      <option value="<?php echo $productdetails['prodapproval']; ?>" selected><?php if($productdetails['prodapproval'] == 1){echo "Activated";}else{echo "Deactivated";} ?></option>
      <option value="1">Activate</option>
      <option value="0">Deactivate</option>
    </select>
    <label>Product Approval Status</label>
  </div>
</div>

</div>
</div>





<div class="col s12 m12 slider">
    <ul class="slides">

    <?php 
        

        $photopaths = $productdetails['photopath'];
        $path = explode(',', $photopaths);
        $s=0;
        foreach ($path as $key => $img) {
          $number = count($path);
          if($s==$number) break; 
          ?>
          
          <li><img src="<?php echo $img; ?>"></li>

      <?php            
            $s++;
        }
      ?>

    </ul>
  </div>








<!-- <div class="row"> -->
        <div class="input-field col s12">
        <a href="<?php echo base_url(). 'admin/productsview'?>
    " class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Products</a>
       
      <button class="btn waves-effect waves-light" type="submit" name="action">Edit Product
        <i class="material-icons right">system_update_alt</i>
      </button>
        </div>
        
     <!--  </div> -->

                       

        </form>

  </div>



   

  </div>