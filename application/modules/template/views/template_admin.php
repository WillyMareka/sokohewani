<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Soko for all">
    <meta name="author" content="sokohewani">

    <title>SokoHewani Admin</title>
    

    <!-- CSS plugins -->

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->

    

    <!-- Latest compiled and minified JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.css'?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>">
    <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/plugins/materialize/css/materialize.css'?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/normalize.css'?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'?>" />
    <!-- <link rel="icon" type="image/x-icon" href="<?php echo base_url.'assets/fonts/soko.ico'?>" /> -->
    <!-- /CSS plugins -->


   
   <!-- JS plugins -->
    
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery-1.12.2.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.js'?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/materialize/js/materialize.js'?>"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/admin.js'?>"></script>
    <!-- /JS plugins -->

</head>

<body>
        <header>
             <?php
                $this->load->view($navbar);
             ?>
             
        </header>
        
        <main>

            <!-- <div class="container"> -->
            <div class="row">
            <div class="col s12">

            <div class="col s3">
             <?php
                $this->load->view($sidebar);
             ?>
            </div>
            <div class="col s9 content-view">
              <div class="view-details">
             <?php
                $this->load->view($content);
             ?>
             </div>
             </div>
             
            </div>
            </div>
       </main>
       <footer class="page-footer">
        <?php
           $this->load->view($footer);
        ?>
       </footer>

       <script type="text/javascript">
            $(document).ready(function() {

            $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
            $('.dataTables_length select').addClass('form-control');
        });
        </script>

</body>

</html>