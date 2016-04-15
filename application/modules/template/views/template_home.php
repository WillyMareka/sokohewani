<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Soko for all">
    <meta name="author" content="sokohewani">

    <title>SokoHewani Limited</title>
    

    <!-- CSS plugins -->

    

    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jquery.filer/css/jquery.filer.css'?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/main.css'?>" />

   
   <!-- JS plugins -->
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery-1.12.2.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery-1.12.2.min.js'?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    

    
    
    <script type="text/javascript" charset="utf-8" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">$(document).ready(function(){base_url = '<?php echo base_url();?>'});</script>
      <?php echo $map['js']; ?> 
      <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
      <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/jquery.filer/js/jquery.filer.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/main.js'?>"></script>
    <!-- /JS plugins -->

</head>

<body>
<?php

     $this->load->view($header);
     $this->load->view($content_page);
     $this->load->view($footer);
     
 ?>



</body>
</html>