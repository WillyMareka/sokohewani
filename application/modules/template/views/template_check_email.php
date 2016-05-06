<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Soko for all">
    <meta name="author" content="sokohewani">

    <title>Admin Login</title>

    <!-- CSS plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.css'?>">
    <link href="<?php echo base_url().'assets/plugins/materialize/css/materialize.css'?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'?>" />
    <!-- /CSS plugins -->


    <!-- JS plugins -->
    
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery-1.12.2.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/jquery-ui-1.11.4/jquery-ui.min.js'?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugins/materialize/js/materialize.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/admin.js'?>"></script>
    <!-- /JS plugins -->


 </head>
 <body>


 <header>
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">Admin Login</a>
      <?php $username = $this->session->userdata('adlname');
            if (isset($username) && $username !="") {?>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo base_url().'admin/adminview'?>">Admin Page</a></li>
            <li><a href="<?php echo base_url().'admin/logout'?>">Logout</a></li>
        </ul> 

     <?php } else { ?>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="#"></a></li>
        </ul> 
    <?php  } ?>

      <!-- <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul> -->
    </div>
  </nav>
 </header>


 <main class="container center">

    <div class="row log-box center">
        <div class="col s12 m12 log-panel">
            <h3>Email Sent</h3>
            <hr/>
            <div class="login-cred container">
                <div class="row ">
                  
                  <h2>Check your email to change your password</h2>
                  <div class="progress">
                     <div class="indeterminate"></div>
                  </div>

                  <a href="<?php echo base_url(). 'admin'?>" class="btn waves-effect waves-light btn-small"><i class="material-icons left">skip_previous</i>Back to Login Page</a>


                       <?php
                        if (isset($logmessage)){
                        ?>
                           <div class="card-panel black-text white">
                              <?php echo $logmessage; ?>
                           </div>
                        <?php } elseif (!(isset($logmessage))) { ?>
                            <div class="card-panel black-text white">
                              <?php echo "Enter all fields please"; ?>
                            </div>
                        <?php } elseif (null !== validation_errors()) { ?>
                            <div class="card-panel black-text white">
                              <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>
                        
                </div>
               </div>

        </div>
    </div>

 </main>
  

<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Admin Page</h5>
                <p class="grey-text text-lighten-4">Footer content</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Visit us on</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2016 Copyright All rights reserved
            <a class="grey-text text-lighten-4 right" href="#!">www.sokohewani.com</a>
            </div>
          </div>
          </div>
        </footer>







</body>

</html>