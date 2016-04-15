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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url().'assets/plugins/materialize/css/materialize.css'?>" rel="stylesheet">
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
      <?php if ($this->session->userdata('logged_in')==1 || $this->session->userdata('adlname') == null) {?>

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
            <h3>Login Panel</h3>
            <hr/>
            <div class="login-cred container">
                <div class="row ">
                  <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo base_url() . 'admin/validate_admin'?>" class="form-horizontal">
                    <div class="row">
                      <div class="input-field col s12 m12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="loguser" id="loguser" required type="email" class="validate">
                        <label for="loguser">Username</label>
                      </div>
                    </div>
        
                    <div class="row">
                      <div class="input-field col s12 m12 center">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="logpass" name="logpass" required type="password" class="validate">
                        <label for="logpass">Password</label>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="input-field col s12 m12 center">
                         <button class="btn waves-effect waves-light" type="submit" name="action">Login
                            <i class="material-icons right">open_in_browser</i>
                         </button>
                      </div>
                    </div>

                    <a href ="<?php echo base_url() . 'admin/forgot_password'?>" class="btn-flat hover-underline">Forget Password ?</a>

                    
      
                  </form>


                       <?php
                        if (isset($logmessage)){
                        ?>
                           <div class="card-panel black-text white">
                              <?php echo $logmessage; ?>
                           </div>
                        <?php } elseif (!(isset($logmessage))) { ?>
                            <div class="card-panel black-text white">
                              <?php echo "Please enter Username and Password"; ?>
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