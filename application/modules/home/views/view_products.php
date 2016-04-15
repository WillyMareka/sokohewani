<h1 class="bold">Product View</h1>
<p><hr/></p>

<?php foreach ($productdetails as $key => $value) {
              foreach ($value as $q => $data) {
?> 

<div class="col s12 m6 slider">
    <ul class="slides">

    <?php 
        

        $photopaths = $data['photopath'];
        $path = explode(',', $photopaths);
        $s=0;
        foreach ($path as $key => $img) {
          $number = count($path);
          if($s==$number-1) break; 
          ?>
          
          <li><img src="<?php echo $img; ?>"></li>

      <?php            
            $s++;
        }
      ?>

    </ul>
  </div>

  <?php }}?>

  

<?php 
      if($productdetails){
foreach ($productdetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($productdetails);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>


<!-- <img src="<?php echo $data['photopath']; ?>"> -->


<h1><span class="bold">Product Name : </span><?php echo $data['prodtitle']; ?></h1>

<p><span class="bold">Category : </span><?php echo $data['catname']; ?></p>
<p><span class="bold">Sub-Category : </span><?php echo $data['subname']; ?></p>
<p><span class="bold">Price : </span><?php echo $data['prodprice']; ?></p>
<p><span class="bold">Description : </span><?php echo $data['proddesc']; ?></p>

<a href="<?php echo base_url(). 'home/products'?>" class="btn waves-effect waves-light btn-small">Back to View Products</a>



<?php 
                             }
                         }
                        
                       }
                   }else{ ?>                  

                    <div>No products are available</div>

                   <?php
                       }
                    ?>
