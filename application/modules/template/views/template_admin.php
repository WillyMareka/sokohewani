<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Soko for all">
    <meta name="author" content="sokohewani">

    <title>Soko Admin</title>
    

    <!-- CSS plugins -->

    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.css'?>">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>">


    
    <!-- <link rel="icon" type="image/x-icon" href="<?php echo base_url.'assets/fonts/soko.ico'?>" /> -->
    <!-- /CSS plugins -->



   <!-- JS plugins -->
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery-1.12.2.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.js'?>"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/admin.js'?>"></script>
    <!-- /JS plugins -->

</head>

<body>
<div class="main">
   <header>
        <?php
           $this->load->view($navbar);
        ?>
   </header>
        <?php
           $this->load->view($sidebar);
        ?>
        <main>
       <div class="container">
        <?php
           $this->load->view($content);
        ?>
       </div>
       </main>
       <footer class="page-footer">
        <?php
           $this->load->view($footer);
        ?>
       </footer>

   
    </div>
</body>

</html>