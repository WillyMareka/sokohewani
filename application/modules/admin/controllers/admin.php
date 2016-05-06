<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(1);
class Admin extends MY_Controller {

  //public $logged_in;

     /* class constructor
    ____________________________________________________________*/

  public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->module('export/export');
        $this->load->library('upload');
        $this->load->library('email');

        $this->pic_path = realpath(APPPATH . '../uploads/');
        $username = $this->session->userdata('adlname');
        if ($this->session->userdata('logged_in') && isset($username)) {
            $this->logged_in = TRUE;
         } else {
            //$this->logged_in = FASLE;
         }

    }

    /* index function
    ____________________________________________________________*/

    function index($data=NULL)
    {
        $this->template->call_adminlogin_template($data);

    }

    function forgot_password($data=NULL)
    {

        $this->template->call_adminforgot_template($data);

    }

    function request_password(){
         if (isset($_POST['useremail']) && !empty($_POST['useremail'])) {
             $this->load->library('form_validation');
             $this->form_validation->set_rules('useremail', 'Email Address', 'trim|required|valid_email|xss_clean');
               
               if($this->form_validation->run() == FALSE){
            // echo '<pre>';print_r("Validation Error");echo'</pre>';die;
               $this->template->call_adminforgot_template($data);

               }else{
                 
                 $email = trim($this->input->post('useremail'));
                 //echo '<pre>';print_r($email);echo'</pre>';die;
                 $result = $this->admin_model->username_check($email);
                 //echo '<pre>';print_r($result);echo'</pre>';die;
                 if ($result) {
                     $this->send_reset_password_email($email, $result);

                     //remember to enter check your email for password request update; below
                     $this->template->call_checkmail_template($data);

                 } else {
                     //echo '<pre>';print_r("Username check did not find you");echo'</pre>';die;
                 }
                 
               }

         } else {
             $data['logmessage'] = 'Please your email first';
             $this->template->call_adminforgot_template($data);
         }
         
      }  
    

    function send_reset_password_email($email, $fname){
        $email_code = md5($this->config->item('salt') . $fname);
           $email_data['to'] = $email;
           $email_data['subject'] = "Reset SokoHewani Password";
           $email_data['message'] = "Dear ".$fname.", <br/>";
           $email_data['message'] .= 'We want to reset your SokoHewani Password.<br/> Please <a href="'.base_url().'admin/reset_password_form/'.$email.'/'.$email_code.'">click here</a> to reset password';

           $this->export->phpmailer($email_data);
    }

    function reset_password_form($email,$email_code){
           if (isset($email,$email_code)) {
              $email = trim($email);
              $email_hash = sha1($email . $email_code);
              //echo '<pre>';print_r($email_code);echo'</pre>';die;

              $verified = $this->admin_model->verify_reset_password_code($email,$email_code);
              
              
              if ($verified) {
                     $data['email'] = $email;
                     $data['email_hash'] = $email_hash;
                     $data['email_code'] = $email_code;
                     //echo '<pre>';print_r($data);echo'</pre>';die;
                     $this->template->call_adminupdate_template($data);

              } else {
                $data['logmessage'] = 'Problem on the verification stage';
                 $this->template->call_adminforgot_template($data);
              }
              
           } else {
               $data['logmessage'] = 'Problem on the acquiring email details stage';
                 $this->template->call_adminforgot_template($data);
           }
           
    }

    function update_password(){
       

        if (!isset($_POST['upemail'], $_POST['email_hash']) || $_POST['email_hash'] !== sha1($_POST['upemail'] . $_POST['email_code'])){
            die('Error updating your password');
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('changepass', 'Password', 'trim|min_length[3]|required|max_length[15]|required|xss_clean');

            $this->form_validation->set_rules('changepass2', 'Confirming Password', 'trim|min_length[3]|required|max_length[15]|required|matches[changepass]|xss_clean');

            $this->form_validation->set_rules('upemail', 'Email Address', 'trim|required|valid_email|xss_clean');

            $this->form_validation->set_rules('email_hash', 'Email Hash', 'trim|required');


            if($this->form_validation->run() == FALSE){
             //echo '<pre>';print_r("Validation Error");echo'</pre>';die;

               $this->template->call_adminforgot_template($data);

            }else{
               
               $result = $this->admin_model->update_password();
               //echo '<pre>';print_r($result);echo'</pre>';die;
               if ($result) {
                   $data['logmessage'] = 'Password has been updated successfully. Try logging in';
                   $this->template->call_adminlogin_template($data);
               } else {
                   $data['logmessage'] = 'Password was not updated successfully. Try updating again';
                   $this->template->call_adminlogin_template($data);
               }
               
            }


        }
        
    }

    

     function validate_admin()
    {
       $this->load->library('email');
         
       //$this->export->phpmailer($email_data);

        $this->load->library('form_validation');
        
         $this->form_validation->set_rules('loguser', 'Username', 'trim|min_length[3]|valid_email|required|xss_clean');
        $this->form_validation->set_rules('logpass', 'Password', 'trim|min_length[3]|required|max_length[15]|required|xss_clean');
       
        
        if($this->form_validation->run() == FALSE){
            // echo '<pre>';print_r("Validation Error");echo'</pre>';die;


           
            $this->load->view('template/template_admin_login');

        }else{
            
            $result = $this->admin_model->log_admin();      
            
             //echo '<pre>';print_r($result);echo'</pre>';die;
            switch($result){

                case 'logged_in':

                $data['logmessage'] = 'Welcome';
                // echo '<pre>';print_r("Logged In");echo'</pre>';die;
                    redirect(base_url().'admin/adminview');
                break;

                case 'incorrect_password':
                    // echo '<pre>';print_r("Incorrect Username or Password");echo'</pre>';die;
                    $data['logmessage'] = 'Incorrect Username or Password. Please try again...';

                    $this->template->call_adminlogin_template($data);
                    
                break;

                case 'not_activated':
                $data['logmessage'] = 'Your account is not activated. Please contact administrator...';

                    $this->template->call_adminlogin_template($data);
                break;
            } 

        }
    } 

    


    function log_check(){
        $username = $this->session->userdata('adlname');
      if($this->session->userdata('logged_in')==0 && $username !== null){

          redirect(base_url().'admin');
          //redirect(base_url().'index.php/admin');
      }else{
        return "logged_in";
      }
   }


    function logout()
    {
        $sess_log = $this->session->userdata('session_id');
        $log = $this->admin_model->logoutadmin($sess_log);

        $this->session->sess_destroy();
        redirect(base_url().'admin');
    }



    function adminview($data=NULL)
    {
        $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        

        $data['all_users'] = $this->createusersview('table','active');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_content';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
    }

    function unreadmessages($data=NULL)
    {
        $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        

        $data['all_umessages'] = $this->createmessagesview('table','unread');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_messages';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
    }


    function readmessages($data=NULL)
    {
        $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        

        $data['all_rmessages'] = $this->createmessagesview('table','read');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dmessages';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
    }


    function development($data=NULL)
    {
        $this->log_check();
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_development';
        $data['footer']='admin/admin_footer';
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function sign()
    {

        $this->load->view('signup');

    }

    function signup()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[2]|required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[2]|required|xss_clean');
        $this->form_validation->set_rules('adminemail', 'Email Address', 'trim|required|valid_email|xss_clean|is_unique[admin.ademail]');
        $this->form_validation->set_rules('adminpassword', 'Password', 'trim|min_length[3]|max_length[15]|required|xss_clean');
        $this->form_validation->set_rules('adminpassword2', 'Re-Entered Password', 'trim|required|matches[adminpassword]|xss_clean');

        if($this->form_validation->run() == FALSE){
            
            $this->load->view('signup');
            //echo 'Not working';
        }else{

                $result = $this->admin_model->enter_admin();
               //print_r($result);

              if($result){
                 $this->index();

              }else{
                 echo 'There was a problem with the website.<br/>Please contact the administrator';
              }
            
         }
    }

    function activeusers($data=NULL)
    {
        $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');


        $data['all_users'] = $this->createusersview('table','all');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_ausers';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function activecategories($data=NULL)
    {
        $this->log_check();


        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['all_categories'] = $this->createcategoryview('table','all');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_acategories';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function newcategory($data=NULL)
    {
        $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/addcategory';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function newsubcategory($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['category_combo'] = $this->all_category_combo();

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/addsubcategory';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    
    function inactiveusers($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['all_dusers'] = $this->createusersview('table','inactive');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dusers';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function inactivecategories($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['all_dcategories'] = $this->createcategoryview('table','inactive');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dcategories';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function inactivesubcategories($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['all_dsubcategories'] = $this->createsubcategoryview('table','inactive');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dsubcat';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }



    function productsview($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        // $data['waits'] = $this->productapproving('await');
        // $data['approves'] = $this->productapproving('approved');
        // $data['disapproves'] = $this->productapproving('disapproved');

        $data['waits'] = $this->createproductview('table','await');
        $data['approves'] = $this->createproductview('table','approved');
        $data['disapproves'] = $this->createproductview('table','disapproved');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_product_view';
        $data['footer']='admin/admin_footer';

        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }


    function photorequests($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['approves'] = $this->photoapproving('approves');
        $data['disapproves'] = $this->photoapproving('disapproves');
        $data['photos'] = $this->photoapproving('wait');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/photo_requests';
        $data['footer']='admin/admin_footer';

        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function photosview($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['dphotos'] = $this->photoapproving('disapproves');
        $data['aphotos'] = $this->photoapproving('approves');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_photos';
        $data['footer']='admin/admin_footer';

        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }


    function activesubcategories($data=NULL)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['all_subcategories'] = $this->createsubcategoryview('table','all');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_asubcat';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }



    function createusersview($type,$status)
    {
         $this->log_check();

     
      $users = $this->admin_model->get_all_users($status);

         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Profile Status</th>
            <th>Date Registered</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($users)){

            foreach ($users as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['userstatus'] == 1) {
                    $state = '<span class="btn green">Activated</span>';
                    $states = 'Activated';
                } else if ($data['userstatus'] == 0) {
                    $state = '<span class="btn red">Deactivated</span>';
                    $states = 'Deactivated';
                }

                $date = date("d-m-Y",strtotime($data['regdate']));

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['userid'].'</td>';
                $display .= '<td class="centered">'.$data['firstname'].'</td>';
                $display .= '<td class="centered">'.$data['lastname'].'</td>';
                $display .= '<td class="centered">'.$data['emailaddress'].'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                $display .= '<td class="centered">'.$date.'</td>';
                
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="View Profile" href = "'.base_url().'admin/userdetail/edit/'.$data['userid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['userstatus'] == 0){
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Activate" href = "'.base_url().'admin/userupdate/userrestore/'.$data['userid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['userstatus'] == 1){
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Deactivate" href = "'.base_url().'admin/userupdate/userinactive/'.$data['userid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                // $display .='<div id="deleteuser_'.$count.'" class="modal modal-fixed-footer">
                //            <div class="modal-content">
                //               <h4>Delete User</h4>
                //               <p>Are you sure you want to delete ??</p>
                //             </div>
                //             <div class="modal-footer">
                //               <a href = "'.base_url().'admin/userdelete/'.$data['userid'].'" class="modal-action modal-close waves-effect waves-green btn-flat ">Yes</a>
                //               <a href = "" class="modal-action modal-close waves-effect waves-green btn-flat ">No</a>
                //             </div>
                //           </div>';

                // $display .= '<td class="centered"><a data-position="top" data-delay="50" data-tooltip="Click to Delete" class="modal-trigger waves-effect waves-light btn modal-close" href="#deleteuser_'.$count.'">Delete</a></td>';

                
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['userid'], $data['firstname'], $data['lastname'], $data['email_address'], $states, $date)); 

                break;

            case 'pdf':
            
            
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['userid'].'</td>';
                $html_body .= '<td>'.$data['firstname'].'</td>';
                $html_body .= '<td>'.$data['lastname'].'</td>';
                $html_body .= '<td>'.$data['email_address'].'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
            $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'User Excel Report', 'file_name' => 'Profile Report', 'excel_topic' => 'Profiles Report');
            $column_data = array('No.','User ID','First Name','Last Name','Email address','Profile Status','Date Registered');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Profile PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Profile Report', 'pdf_topic' => 'Profiles');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
            
              $display .= "</tbody>";



              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }



    function createmessagesview($type,$status)
    {
         $this->log_check();

     
      $users = $this->admin_model->get_all_messages($status);

         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Date/Time Submitted</th>
            <th>Subject</th>
            <th>Message</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($users)){

            foreach ($users as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['messstatus'] == 1) {
                    $state = '<span class="btn green">Read</span>';
                    $states = 'Activated';
                } else if ($data['messstatus'] == 0) {
                    $state = '<span class="btn red">Unread</span>';
                    $states = 'Deactivated';
                }

                $date = $data['messrecieved'];

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$date.'</td>';
                $display .= '<td class="centered">'.$data['messsubject'].'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                
                
                $display .= '<td class="centered"><a  class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to View" href = "'.base_url().'admin/messagedetail/edit/'.$data['messid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['messstatus'] == 0){
                $display .= '<td  class="tooltipped" data-position="top" data-delay="50" data-tooltip="Mark as Read" href = "'.base_url().'admin/messageupdate/messageread/'.$data['messid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['messstatus'] == 1){
                $display .= '<td class="centered"><a  class="tooltipped" data-position="top" data-delay="50" data-tooltip="Mark as Unread" " href = "'.base_url().'admin/messageupdate/messageunread/'.$data['messid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                // $display .= '<td class="centered"><a  class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Delete" " href = "'.base_url().'admin/messagedelete/'.$data['messid'].'"><i class="material-icons">delete</i></a></td>';

                $display .='<div id="deletemessage_'.$count.'" class="modal modal-fixed-footer">
                           <div class="modal-content">
                              <h4>Delete User</h4>
                              <p>Are you sure you want to delete ??</p>
                            </div>
                            <div class="modal-footer">
                              <a href = "'.base_url().'admin/messagedelete/'.$data['messid'].'" class="modal-action modal-close waves-effect waves-green btn-flat ">Yes</a>
                              <a href = "" class="modal-action modal-close waves-effect waves-green btn-flat ">No</a>
                            </div>
                          </div>';

                $display .= '<td class="centered"><a data-position="top" data-delay="50" data-tooltip="Click to Delete" class="modal-trigger waves-effect red darken-4 waves-light btn modal-close" href="#deletemessage_'.$count.'">Delete</a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $date, $data['messsubject'], $data['messmessage'] )); 
                 

                break;

            case 'pdf':
            
            
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= '<td>'.$data['messsubject'].'</td>';
                $html_body .= '<td>'.$data['messmessage'].'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
            $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'Message Excel Report', 'file_name' => 'Message Report', 'excel_topic' => 'Message Report');
            $column_data = array('No.','Date/Time Recieved','Subject','Message');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Message PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Message Report', 'pdf_topic' => 'Messages');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
              $display .= "</tbody>";

              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }


    function createproductview($type,$status)
    {
         $this->log_check();

      
       $products = $this->admin_model->get_approving_status($status);           


         //echo "<pre>";print_r($products);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Category</th>
            <th>SubCategory</th>
            <th>SubmittedBy</th>
            <th>Price</th>
            <th>Location</th>
            <th>DateSubmitted</th>
            <th>Photo</th>
            <th>View</th>
            <th>Status</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($products)){

            foreach ($products as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['prodapproval'] == 1) {
                    $state = '<span class="btn green">Activated</span>';
                    $states = 'Activated';
                } else if ($data['prodapproval'] == 0) {
                    $state = '<span class="btn red">Deactivated</span>';
                    $states = 'Deactivated';
                } else if ($data['prodapproval'] == 2) {
                    $state = '<span class="btn orange">Awaiting</span>';
                    $states = 'Deactivated';
                }

                $date = date("d-m-Y",strtotime($data['proddate']));

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['prodid'].'</td>';
                $display .= '<td class="centered">'.$data['prodtitle'].'</td>';
                $display .= '<td class="centered">'.$data['catname'].'</td>';
                $display .= '<td class="centered">'.$data['subname'].'</td>';
                $display .= '<td class="centered">'.$data['userid'].'</td>';
                $display .= '<td class="centered">'.$data['prodprice'].'</td>';
                $display .= '<td class="centered">'.$data['prodlocation'].'</td>';
                $display .= '<td class="centered">'.$date.'</td>';
                
                //$display .= '<td class="centered">'.$date.'</td>';
                $display .='<div id="viewpic_'.$count.'" class="modal modal-fixed-footer">
                           <div class="modal-content">
                              <h4>'.$data['prodtitle'].'</h4>
                              <p><img src="'.$data['photopath'].'"/></p>
                            </div>
                            <div class="modal-footer">
                              <a class="modal-action modal-close waves-effect waves-green btn-flat ">Exit</a>
                            </div>
                          </div>';

                


                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to View" href = "'.base_url().'admin/productdetail/'.$data['prodid'].'"><i class="material-icons">contacts</i></a></td>';

                $display .= '<td class="centered">'.$state.'</td>';
                
                
                
              
               //          if($data['subcatstatus'] == 0){
               //  $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Activate" href = "'.base_url().'admin/subcatupdate/subcatrestore/'.$data['subid'].'"><i class="material-icons">lock_outline</i></td>';
               // }else if($data['subcatstatus'] == 1){
               //  $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Deactivate" href = "'.base_url().'admin/subcatupdate/subcatinactive/'.$data['subid'].'"><i class="material-icons">lock_open</i></td>';
               //  }
                
                // $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Delete" href = "'.base_url().'admin/subcatdelete/'.$data['subcatid'].'"><i class="material-icons">delete</i></a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['prodid'], $data['prodtitle'], $data['catname'], $data['subname'], $date, $data['prodid'], $data['prodprice'], $data['prodapproval'], $data['prodavail'], $data['proddescription'], $states)); 
                 

                break;

            case 'pdf':
       
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['prodid'].'</td>';
                $html_body .= '<td>'.$data['prodtitle'].'</td>';
                $html_body .= '<td>'.$data['catname'].'</td>';
                $html_body .= '<td>'.$data['subname'].'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= '<td>'.$data['userid'].'</td>';
                $html_body .= '<td>'.$data['prodprice'].'</td>';
                $html_body .= '<td>'.$data['prodapproval'].'</td>';
                $html_body .= '<td>'.$data['prodavail'].'</td>';
                $html_body .= '<td>'.$data['proddescription'].'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
        $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'Products Excel Report', 'file_name' => 'Products Report', 'excel_topic' => 'Products Report');
             $column_data = array('No.','Products ID','Title','Category','SubCategory','Date Submitted','Submitted By','Price','Approval','Availability');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Products PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Products Report', 'pdf_topic' => 'Products');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
              $display .= "</tbody>";

              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }


    


    function createcategoryview($type,$status)
    {
         $this->log_check();

        $categories = $this->admin_model->get_all_categories($status);

         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Date Registered</th>
            <th>Profile Status</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($categories)){

            foreach ($categories as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['catstatus'] == 1) {
                    $state = '<span class="btn green">Activated</span>';
                    $states = 'Activated';
                } else if ($data['catstatus'] == 0) {
                    $state = '<span class="btn red">Deactivated</span>';
                    $states = 'Deactivated';
                }

                $date = date("d-m-Y",strtotime($data['catdate']));

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['catid'].'</td>';
                $display .= '<td class="centered">'.$data['catname'].'</td>';
                // $display .= '<td class="centered">'.$data['catdescription'].'</td>';
                $display .= '<td class="centered">'.$date.'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to View" href = "'.base_url().'admin/categorydetail/edit/'.$data['catid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['catstatus'] == 0){
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Activate" href = "'.base_url().'admin/catupdate/catrestore/'.$data['catid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['catstatus'] == 1){
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Deactivate" href = "'.base_url().'admin/catupdate/catinactive/'.$data['catid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                // $display .= '<td class="centered"><a  class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Delete" href = "'.base_url().'admin/catdelete/'.$data['catid'].'"><i class="material-icons">delete</i></a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['catid'], $data['catname'], $data['catdescription'], $date, $states)); 
                 

                break;

            case 'pdf':
       
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['catid'].'</td>';
                $html_body .= '<td>'.$data['catname'].'</td>';
                $html_body .= '<td>'.$data['catdescription'].'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
        $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'Category Excel Report', 'file_name' => 'Category Report', 'excel_topic' => 'Categories Report');
             $column_data = array('No.','Category ID','Category Name','Description','Date Registered','Category Status');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Category PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Category Report', 'pdf_topic' => 'Categories');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
              $display .= "</tbody>";

              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }


    function createsubcategoryview($type,$status)
    {
         $this->log_check();

      
       $subcategories = $this->admin_model->get_all_subcategories($status);           


         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Sub-Category ID</th>
            <th>Sub-Category Name</th>
            <th>Description</th>
            <th>Date Registered</th>
            <th>Category</th>
            <th>Profile Status</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($subcategories)){

            foreach ($subcategories as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['subcatstatus'] == 1) {
                    $state = '<span class="btn green">Activated</span>';
                    $states = 'Activated';
                } else if ($data['subcatstatus'] == 0) {
                    $state = '<span class="btn red">Deactivated</span>';
                    $states = 'Deactivated';
                }

                $date = date("d-m-Y",strtotime($data['subdate']));

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['subid'].'</td>';
                $display .= '<td class="centered">'.$data['subname'].'</td>';
                // $display .= '<td class="centered">'.$data['subdescription'].'</td>';
                $display .= '<td class="centered">'.$date.'</td>';
                $display .= '<td class="centered">'.$data['catname'].'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to View" href = "'.base_url().'admin/subcategorydetail/edit/'.$data['subid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['subcatstatus'] == 0){
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Activate" href = "'.base_url().'admin/subcatupdate/subcatrestore/'.$data['subid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['subcatstatus'] == 1){
                $display .= '<td class="centered"><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click to Deactivate" href = "'.base_url().'admin/subcatupdate/subcatinactive/'.$data['subid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                // $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Delete" href = "'.base_url().'admin/subcatdelete/'.$data['subcatid'].'"><i class="material-icons">delete</i></a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['subid'], $data['subname'], $data['subdescription'], $date, $data['catname'], $states)); 
                 

                break;

            case 'pdf':
       
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['subid'].'</td>';
                $html_body .= '<td>'.$data['subname'].'</td>';
                $html_body .= '<td>'.$data['subdescription'].'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= '<td>'.$data['catname'].'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
        $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'Sub-Category Excel Report', 'file_name' => 'Sub-Category Report', 'excel_topic' => 'Sub-Categories Report');
             $column_data = array('No.','Sub-Category ID','Sub-Category Name','Description','Date Registered','Category','Sub-Category Status');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Sub-Category PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Sub-Category Report', 'pdf_topic' => 'Sub-Categories');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
              $display .= "</tbody>";

              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }

    function editproduct()
  {
     $this->log_check();

    // $this->load->library('form_validation');

  
                    // $this->form_validation->set_rules('category-name', 'Category Name', 'required');
                    // $this->form_validation->set_rules('category-status', 'Category Status', 'required');


    // if($this->form_validation->run() == FALSE){


        // $data['waitproductnumber']  = $this->getproductnumber('wait');
        // $data['approveproductnumber']  = $this->getproductnumber('approve');
        // $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        // $data['waitphotonumber']  = $this->getphotonumber('wait');

        // $data['allusernumber']  = $this->getusernumber('all');
        // $data['allphotonumber']  = $this->getphotonumber('all');
        // $data['allcategorynumber']  = $this->getcategorynumber('all');
        // $data['umessagenumber']  = $this->getmessagenumber('unread');
        // $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        // $data['inusernumber']  = $this->getusernumber('inactive');
        // $data['inphotonumber']  = $this->getphotonumber('inactive');
        // $data['incategorynumber']  = $this->getcategorynumber('inactive');
        // $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        // $data['rmessagenumber']  = $this->getmessagenumber('read');

        // $data['navbar']='admin/admin_header';
        // $data['sidebar']='admin/admin_sidebar';
        // $data['content']='admin/editproduct';
        // $data['footer']='admin/admin_footer';
      
        // //echo "<pre>";print_r($data);die();
        // $this->template->call_admin_template($data);
   
    // }else{
   
                    $result = $this->admin_model->product_edit();
              
        if($result){
            
              $this->productsview();

          }else{
             echo 'No Update';die();
                //$this->productsview();
        }
        
    // }
       
  }

     function create_category($type)
  {
     $this->log_check();

    $this->load->library('form_validation');

    switch ($type) {
                case 'create':
                    //$this->form_validation->set_rules('category-name', 'Category Name', 'required|callback_category_check');
                    $this->form_validation->set_rules('category-name', 'Category Name', 'required');
                    break;

                case 'edit':
                    $this->form_validation->set_rules('category-name', 'Category Name', 'required');
                    $this->form_validation->set_rules('category-status', 'Category Status', 'required');
                    break;
                
            }
        
        
          
        

    if($this->form_validation->run() == FALSE){


        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/addcategory';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

        
    }else{

        switch ($type) {
            case 'create':
                   
                    $catcheck = $this->admin_model->cat_check();
                    break;

                case 'edit':
                    $catcheck = 0;
                    break;
        }

        if ($catcheck == 1) {

        $data['logmessage'] = "The category given already exists";
           
           $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/addcategory';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

        } else {     

        switch ($type) {
                case 'create':
                    $result = $this->admin_model->enter_category();
                    break;

                case 'edit':
                    $result = $this->admin_model->category_edit();
                    break;
                
            }

        if($result){
            
                redirect(base_url() .'admin/activecategories');

          }else{
            // echo 'No Update';die();
                redirect(base_url() .'admin/activecategories');
        }
        }
    }
       
  }

    function create_subcategory($type)
  {
     $this->log_check();

    $this->load->library('form_validation');

    switch ($type) {
        case 'create':
           $this->form_validation->set_rules('sub-category-name', 'Sub-Category Name', 'trim|required|xss_clean');
           // $this->form_validation->set_rules('category-id', 'Category ID', 'required|trim|xss_clean');
           break;

        case 'edit':
            $this->form_validation->set_rules('sub-category-name', 'Sub-Category Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('category-id', 'Category ID', 'required');
            $this->form_validation->set_rules('sub-category-status', 'Sub-Category Status', 'required');
            break;
       
    }

    if($this->form_validation->run() == FALSE){
       $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['category_combo'] = $this->all_category_combo();

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/addsubcategory';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);
        
    }else{

        switch ($type) {
            case 'create':
                   
                    $subcatcheck = $this->admin_model->subcat_check();
                    break;

                case 'edit':
                    $subcatcheck = 0;
                    break;
        }

        if ($subcatcheck == 1) {

        $data['logmessage'] = "The subcategory given already exists";
           
        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');

        $data['category_combo'] = $this->all_category_combo();

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/addsubcategory';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);
        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

        } else { 

           switch ($type) {
                case 'create':
                    $result = $this->admin_model->enter_subcategory();
                    break;

                case 'edit':
                    $result = $this->admin_model->sub_category_edit();
                    break;
                
            }

        if($result){

            
                redirect(base_url() .'admin/activesubcategories');

          }else{
                redirect(base_url() .'admin/activesubcategories');
        }
        }
    }
       
  }


  public function currentprofile($type,$adid)
    {
        $this->log_check();

        $results = $this->admin_model->ownprofile($adid);

        foreach ($results as $key => $values) {
            $admindetails['ownprofile'][] = $values;  
        }

        $data['adminprofile'] = $admindetails;
        

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        
        switch ($type) {
            case 'view':
                $data['content']='admin/admin_profile';
                break;

            case 'edit':
                $data['content']='admin/profile_edit';
                break;
            
        }
        

        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
    }


   function userdetail($type,$id)
    {
         $this->log_check();

        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->userprofile($id);

        foreach ($results as $key => $values) {
            $details['users'][] = $values;  
        }
        
        
        $data['userdetails'] = $details;

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        switch ($type) {
          case 'view':
              $data['content']='admin/view_user';
              break;

          case 'edit':
             $data['content']='admin/edituser';
              break;
        }
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }

    function messagedetail($type,$id)
    {
         $this->log_check();

        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->messageprofile($id);

        foreach ($results as $key => $values) {
            $details['messages'][] = $values;  
        }
        
        
        $data['messagedetails'] = $details;

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        switch ($type) {
          case 'view':
              $data['content']='admin/view_message';
              break;

          case 'edit':
             $data['content']='admin/editmessage';
              break;
        }
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }


    function productdetail($id)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
        //$this->log_check();
        $userdet = array();

        
        $product = $this->admin_model->productprofile($id);

        foreach ($product as $key => $values) {  
           //$proddet[] = $values;
        }


        //echo '<pre>';print_r($values);echo '</pre>';die;

        
        $data['productdetails'] = $values;

        //echo '<pre>';print_r($data);echo '</pre>';die;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/editproduct';
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }


    function categorydetail($type,$id)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->categoryprofile($id);
        //echo '<pre>';print_r($results);echo '</pre>';die;
        foreach ($results as $key => $values) {
            $details['categories'][] = $values;  
        }
        
        
        $data['categorydetails'] = $details;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';

         switch ($type) {
          case 'view':
              $data['content']='admin/view_category';
              break;

          case 'edit':
             $data['content']='admin/editcategory';
              break;
      }
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }

    function subcategorydetail($type,$id)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
        $data['getcategories'] = $this->all_category_combotwo();
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->subcategoryprofile($id);
         // echo '<pre>';print_r($results);echo '</pre>';die;
        foreach ($results as $key => $values) {
            $details['subcategories'][] = $values;  
        }
        
        
        $data['subcategorydetails'] = $details;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';

      switch ($type) {
          case 'view':
              $data['content']='admin/view_subcategory';
              break;

          case 'edit':
             $data['content']='admin/editsubcategory';
              break;
      }

        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }

    function subpercategory($id)
    {
         $this->log_check();

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->subpercategory($id);

        foreach ($results as $key => $values) {
            $details['subcategories'][] = $values;  
        }
        
        
        $data['subcategorydetails'] = $details;

        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/view_subpercategory';
        $data['footer']='admin/admin_footer';      
        
        $this->template->call_admin_template($data);
 
    }



    function userdelete($id)
    {
         $this->log_check();

        //$this->log_check();

        $results = $this->admin_model->delete_user($id);

        
        
            switch ($results) {

                case 'deleted':
                    $this->activeusers();
                    //$this->users();
                    break;

                case 'notdeleted':
                    $this->activeusers();
                    //$this->users();
                    break;
                
                default:
                    # code...
                    break;
            }
 
    }

    function messagedelete($id)
    {
         $this->log_check();

        //$this->log_check();

        $results = $this->admin_model->delete_message($id);

        
        
            switch ($results) {

                case 'deleted':

                    $this->unreadmessages();
                    
                    break;

                case 'notdeleted':

                    $this->unreadmessages();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
 
    }

    function catdelete($id)
    {
         $this->log_check();

        //$this->log_check();

        $results = $this->admin_model->delete_cat($id);

        
        
            switch ($results) {

                case 'deleted':
                    $this->activecategories();
                    //$this->users();
                    break;

                case 'notdeleted':
                    $this->activecategories();
                    //$this->users();
                    break;
                
                default:
                    # code...
                    break;
            }
 
    }

    


    function userupdate($type, $user_id)
    {
         $this->log_check();

        $update = $this->admin_model->updateuser($type, $user_id);

        if($update)
        {
            switch ($type) {

                case 'userinactive':
                    $this->activeusers();
                    
                    break;

                case 'userrestore':
                    $this->activeusers();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }


    function messageupdate($type, $mess_id)
    {
         $this->log_check();

        $update = $this->admin_model->updatemessage($type, $mess_id);

        if($update)
        {
            switch ($type) {

                case 'messageunread':
                    $this->unreadmessages();
                    
                    break;

                case 'messageread':
                    $this->unreadmessages();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }

    function catupdate($type, $cat_id)
    {
         $this->log_check();

        $update = $this->admin_model->updatecategory($type, $cat_id);

        if($update)
        {
            switch ($type) {

                case 'catinactive':
                    $this->activecategories();    
                    break;

                case 'catrestore':
                    $this->activecategories();
                    break;
                
            }
        }
    }



    function subcatupdate($type, $subcat_id)
    {
         $this->log_check();

        $update = $this->admin_model->updatesubcategory($type, $subcat_id);

        if($update)
        {
            switch ($type) {

                case 'subcatinactive':
                    $this->activesubcategories();
                    
                    break;

                case 'subcatrestore':
                    $this->activesubcategories();
                    
                    break;
                
            }
        }
    }


    function productapproving($prodapprovestate)
  {
     $this->log_check();

    $proddet = array();
    switch ($prodapprovestate) {

        case 'await':
            $results = $this->admin_model->get_approving_status($prodapprovestate);
            break;

        case 'approved':
            $results = $this->admin_model->get_approving_status($prodapprovestate);
            break;

        case 'disapproved':
            $results = $this->admin_model->get_approving_status($prodapprovestate);
            break;
    }
       
       foreach ($results as $key => $values) {  
           $proddet['proddet'][] = $values;
       }

        //echo '<pre>';print_r($proddet);echo '</pre>';die;

        return $proddet;
  }

  function photoapproving($type)
  {

    $proddet = array();
    
    $results = $this->admin_model->photo_approving_status($type);
            
       
       foreach ($results as $key => $values) {  
           $proddet['proddet'][] = $values;
       }

        //echo '<pre>';print_r($proddet);echo '</pre>';die;

        return $proddet;
  }



  function updateproduct($type, $prod_id)
  {


    //print_r($prod_id);die();
    $update = $this->admin_model->updateproduct($type, $prod_id);
    if($update)
    {
      //echo '<pre>';print_r($update);echo '</pre>';die;
      switch ($type) {
        case 'approve':
         
          $this->productsview();
          break;

        case 'disapprove':
         
          $this->productsview();
          break;
        
        default:
          # code...
          break;
      }
    }else{
      echo '<pre>';print_r("Problem found when updating status");echo '</pre>';die;
    }
  }

  function updatephoto($type, $photo_id)
  {


    //print_r($prod_id);die();
    $update = $this->admin_model->updatephoto($type, $photo_id);
    if($update)
    {
      //echo '<pre>';print_r($update);echo '</pre>';die;
      switch ($type) {
        case 'approve':
         
          $this->photosview();
          break;

        case 'disapprove':
         
          $this->photosview();
          break;
        
        default:
          # code...
          break;
      }
    }else{
      echo '<pre>';print_r("Problem found when updating status");echo '</pre>';die;
    }
  }

  

  function edituser(){

     
       $this->load->library('form_validation');
        
       $this->form_validation->set_rules('user-status', 'User Status', 'required');
        
        

    if($this->form_validation->run() == FALSE){
       echo 'Validation error';die();
      //redirect(base_url() .'admin/activeusers');
        
    }else{
 
          $result = $this->admin_model->user_edit();
               //print_r($result);

        if($result){
                redirect(base_url() .'admin/activeusers');

          }else{
                redirect(base_url() .'admin/activeusers');
                 // echo 'There was a problem with the website.<br/>Please contact the administrator';
        }
        }
         
    
  }


  function editprofile(){

       $this->log_check();
     
       $this->load->library('form_validation');
        
       $this->form_validation->set_rules('email-address', 'Email Address', 'trim|required|valid_email|xss_clean');
        
    if($this->form_validation->run() == FALSE){
       echo 'Validation error';die();
      //redirect(base_url() .'admin/activeusers');
        
    }else{ 
        //
 
          $result = $this->admin_model->profile_edit();
              //echo "<pre>";print_r($result);echo "</pre>";die();
               //print_r($result);die();

        if($result){
                redirect(base_url() .'admin/adminview');

          }else{

                redirect(base_url() .'admin/development');
                  
        }
        }
         
    
  }


  function editprofilepass(){
      $this->log_check();

      $id = $this->input->post('ad-id');
      $oldpass = sha1($this->config->item('salt') . $this->input->post('oldpassword'));
      $newpass = sha1($this->config->item('salt') . $this->input->post('newpassword'));
      $newpass2 = sha1($this->config->item('salt') . $this->input->post('newpassword2'));

      $get_validation = $this->admin_model->check_password($id,$oldpass);

        if ($get_validation == 0) {

        $data['logmessage'] = "Old Password entered does not match your credentials.";

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/profile_edit';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
            
        } else {

            if ($oldpass == $newpass) {
                 $data['logmessage'] = "Old Password entered should not match with New Password";

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/profile_edit';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
                # code...
            }else{
            

       $this->load->library('form_validation');
        
       $this->form_validation->set_rules('newpassword', 'New Password', 'required|xss_clean');
       $this->form_validation->set_rules('newpassword2', 'Confirm Password', 'matches[newpassword]|required|xss_clean');
        
        

    if($this->form_validation->run() == FALSE){

        $data['logmessage'] = "The passwords entered do not match";

        $data['waitproductnumber']  = $this->getproductnumber('wait');
        $data['approveproductnumber']  = $this->getproductnumber('approve');
        $data['diapproveproductnumber']  = $this->getproductnumber('disapprove');
        $data['waitphotonumber']  = $this->getphotonumber('wait');

        $data['allusernumber']  = $this->getusernumber('all');
        $data['allphotonumber']  = $this->getphotonumber('all');
        $data['allcategorynumber']  = $this->getcategorynumber('all');
        $data['umessagenumber']  = $this->getmessagenumber('unread');
        $data['allsubcategorynumber']  = $this->getsubcategorynumber('all');
        
        $data['inusernumber']  = $this->getusernumber('inactive');
        $data['inphotonumber']  = $this->getphotonumber('inactive');
        $data['incategorynumber']  = $this->getcategorynumber('inactive');
        $data['insubcategorynumber']  = $this->getsubcategorynumber('inactive');
        $data['rmessagenumber']  = $this->getmessagenumber('read');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/profile_edit';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_admin_template($data);
        
    }else{

      

      $result = $this->admin_model->profilepass_edit($id,$newpass);

        if($result){
                redirect(base_url() .'admin/adminview');

          }else{
                redirect(base_url() .'admin/adminview');
                 // echo 'There was a problem with the website.<br/>Please contact the administrator';
          }
        }
     }

    }
         
    
  }

  function all_category_combo()
    {
        $categories = $this->admin_model->get_avail_categories();
         
        $this->categories_combo .= '<select name="category-id" id="category-id">';
        // $this->categories_combo .= '<option value="" selected>Choose your option</option>';
        foreach ($categories as $key => $value) {
            $this->categories_combo .= '<option value="'.$value['catid'].'">'.$value['catname'].'</option>';
            //echo "<pre>";print_r($value);die();
        }
        $this->categories_combo .= '</select>';

        return $this->categories_combo;
    }


    function all_category_combotwo()
    {
        $categories = $this->admin_model->get_avail_categories();
         
        $this->categories_combo .= '';
        // $this->categories_combo .= '<option value="" selected>Choose your option</option>';
        foreach ($categories as $key => $value) {
            $this->categories_combo .= '<option value="'.$value['catid'].'">'.$value['catname'].'</option>';
            //echo "<pre>";print_r($value);die();
        }
        

        return $this->categories_combo;
    }


  

    public function getusernumber($type)
    {
          $results = $this->admin_model->usernumber($type);

          return $results;

          //echo '<pre>'; print_r($results); echo '</pre>';die;
    }

    public function getproductnumber($type)
    {
          $results = $this->admin_model->productnumber($type);

          return $results;

          //echo '<pre>'; print_r($results); echo '</pre>';die;
    }

    public function getphotonumber($type)
    {
          $results = $this->admin_model->photonumber($type);

          return $results;

          //echo '<pre>'; print_r($results); echo '</pre>';die;
    }

    public function getcategorynumber($type)
    {
          $results = $this->admin_model->categorynumber($type);

          return $results;

          //echo '<pre>'; print_r($results); echo '</pre>';die;
    }

    public function getsubcategorynumber($type)
    {
          $results = $this->admin_model->subcategorynumber($type);

          return $results;

          //echo '<pre>'; print_r($results); echo '</pre>';die;
    }

    public function getmessagenumber($type)
    {
          $results = $this->admin_model->messagenumber($type);

          return $results;

          //echo '<pre>'; print_r($results); echo '</pre>';die;
    }







  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */