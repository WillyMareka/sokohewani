<h1 class="bold">Sub-Category View of Category-ID </h1><?php echo $data['catid']; ?>
<p><hr/></p>

<div class="row">
        

<?php foreach ($subcategorydetails as $key => $value) {
                            foreach ($value as $q => $data) {
                            
                           //echo '<pre>';print_r($user);echo'</pre>';die();
                            for ($i=0; $i <= $key ; $i++) { 
                                
                            ?>
<div class="col s12 m6">
<div class="card white z-depth-3">

<div class="card-content black-text">
    <h1><span class="card-title">Sub-Category Name : </span><?php echo $data['subname']; ?></h1>
    <p><hr/></p>
    <p><span class="bold">Category Name : </span><?php echo $data['catid']; ?></p>
    <p><span class="bold">Date Registered : </span><?php echo $data['subdate']; ?></p>
    <p><span class="bold">Status : </span><?php echo $data['subcatstatus']; ?></p>
    <p><span class="bold">Description : </span><?php echo $data['subdescription']; ?></p>
</div>

<div class="card-action">
<a href="<?php echo base_url(). 'admin/categorydetail/view/'?><?php echo $data['catid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Category View</a>

<a href="<?php echo base_url(). 'admin/subcategorydetail/edit/'?><?php echo $data['subid'];?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">input</i>Edit</a>
</div>
</div>
  </div>
<?php 
                             }
                         }
                        
                       }
                        ?>

 
      </div>


          
            
              
            
            
        
       