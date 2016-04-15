<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

  //public $logged_in;

     /* class constructor
    ____________________________________________________________*/

  public function __construct()
    {

        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('form_validation');
        $this->load->library('googlemaps'); 
      
        $this->form_validation->set_error_delimiters('<span class="error" style="color:#FF0000;">', '</span>');
        $this->load->library('session');
        $this->load->library('upload');

        if ($this->session->userdata('logged_in')) {
          $this->logged_in = TRUE;
         } else {
          //$this->logged_in = FASLE;
         }

         $this->pic_path = realpath(APPPATH . '../uploads/');
     
    }

    function  MY_Upload($config = array())
{
    parent::__construct($config);
}

    

    /* index function
    ____________________________________________________________*/

    function index($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/home_view';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }
     /* brand function
    ____________________________________________________________*/

function log_check(){
      if($this->session->userdata('logged_in') == 0){

          redirect(base_url().'home/login');
          //redirect(base_url().'index.php/admin');
      }else{
        return "logged_in";
      }
   }

    function sokohome($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/home_view';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }

    function addsview($data=NULL)
    {
      $userid = $this->session->userdata('userid');

      $results = $this->home_model->getownproducts($userid);
            
       
       foreach ($results as $key => $values) {  
           $proddet['proddet'][] = $values;
       }

       $data['productdata'] = $proddet;
  
        $data['header']='home/header';
        $data['content_page']='home/viewadds';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }

    function ownproductdetails($id)
    {
      $data['categorycombo'] = $this->all_category_combo();
      $data['subcategorycombo'] = $this->all_subcategory_combo();

      $results = $this->home_model->productprofile($id);
        //echo '<pre>';print_r($results);echo '</pre>';die;
        foreach ($results as $key => $values) {
            $details['products'][] = $values;  
        }
        
        
        $data['productdetails'] = $details;
  
        $data['header']='home/header';
        $data['content_page']='home/viewownproducts';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }
     /* Location function
    ____________________________________________________________*/

    function locate($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/location';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }




 /* login function
    ____________________________________________________________*/

    function login($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/login';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }

     /* validate login function
    ____________________________________________________________*/

    function login_user(){
         $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
         $this->form_validation->set_rules('user_pass', 'Password', 'trim|required');

          if ($this->form_validation->run() == FALSE)
                {
                        $this->login();
                }else{
                     $useremail = $this->input->post('user_email');
                     $userpassword = md5($this->input->post('user_pass'));
                     //echo '<pre>';print_r($useremail);echo '</pre>';die;
                     $insert = $this->home_model->user_login($useremail,$userpassword);

                     switch($insert){

                            case 'logged_in':
                                
                               $this->index();

                            break;

                            case 'incorrect_password':
                           echo "<pre>";print_r("Incorrect Username or password");echo "</pre>";die();
                            //$error=array("Incorrect Username or password");
                             
                               //echo "<pre>";print_r("Incorrect Username or Password");echo "</pre>";die();
                               
                            break;

                            case 'not_activated':
                            echo "<pre>";print_r("Your Account had been deactivated");echo "</pre>";die();
                            
                            break;

                            case 'check_email':
                            echo "<pre>";print_r("Check email for activation");echo "</pre>";die();
                            
                            break;

                            default:
                                // echo '';
                            break;
                   
                 }
            }

}
 /* logout link function
    ____________________________________________________________*/

function Logout_check(){
     $data['header']='home/header';
     $data['content_page']='home/logout';
     $data['footer']='home/footer';
     $this->template->call_home_template($data);


    }

  function logout(){
        $sess_log = $this->session->userdata('session_id');
        $this->home_model->logoutuser($sess_log);

        $this->session->sess_destroy();
        $this->Logout_check();


  }
  


 /* Sign up a user function
    ____________________________________________________________*/

    function Signup($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/signup';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }

    function add_user(){

        $email = $this->input->post('email');
        $fname = $this->input->post('firstname');

        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('upassword', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[upassword]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.emailaddress]');


                if ($this->form_validation->run() == FALSE)
                {
                        $this->Signup();
                }
                else
                {
                    $customer=array(
                    'firstname'=>$this->input->post('firstname'),
                    'lastname'=>$this->input->post('lastname'),
                    'emailaddress'=>$this->input->post('email'),
                    'password'=>md5($this->input->post('upassword'))
                    );

                    $insert = $this->home_model->add_user($customer);

                    $email_code = md5($this->config->item('salt') . $fname);

                    $email_data['to'] = $email;
                    $email_data['subject'] = "SokoHewani Email Activation";
                    $email_data['message'] = "Dear ".$fname.", <br/>";
                    $email_data['message'] .= 'We want to activate your SokoHewani Account.<br/> Please <a href="'.base_url().'home/reset_activation/'.$email.'/'.$email_code.'">click here</a> to activate account';

                     $this->export->phpmailer($email_data);
                     
                     $this->checkemail();
                }
    }


    function reset_activation($email,$email_code){
           if (isset($email,$email_code)) {
              $email = trim($email);
              $email_hash = sha1($email . $email_code);
              //echo '<pre>';print_r($email_code);echo'</pre>';die;

              $verified = $this->home_model->verify_reset_password_code($email,$email_code);
              //echo '<pre>';print_r($verified);echo'</pre>';die;
              
              if ($verified) {
                     //
                     $this->activateaccount($email,$email_hash,$email_code);

              } else {
                //echo '<pre>';print_r("Problem on the verification stage");echo'</pre>';die;
                $data['logmessage'] = 'Problem on the verification stage';
                 $this->user_registered();
              }
              
           } else {
            //echo '<pre>';print_r("Problem on the acquiring email details stage");echo'</pre>';die;
               $data['logmessage'] = 'Problem on the acquiring email details stage';
                 $this->user_registered();
           }
           
    }


    function activateaccount($email,$email_hash,$email_code){
       

        if (!isset($email, $email_hash) || $email_hash !== sha1($email . $email_code)){
            die('Error activating your account');
        } else {

               $result = $this->home_model->activate_account($email);
               //echo '<pre>';print_r($result);echo'</pre>';die;
               if ($result) {
                //echo '<pre>';print_r("Password has been updated successfully. Try logging in");echo'</pre>';die;
                   $data['logmessage'] = 'Password has been updated successfully. Try logging in';
                   $this->login();
               } else {
                //echo '<pre>';print_r("Password was not updated successfully. Try updating again");echo'</pre>';die;
                   $data['logmessage'] = 'Password was not updated successfully. Try updating again';
                   $this->user_registered();
               }
               
            }

        }
        
    


    function user_registered(){
        redirect(base_url().'index.php/home');
    }


    function checkemail(){
        $data['content_page']='home/checkemail';
        $this->template->call_email_template($data);
    }

     /* 
    ____________________________________________________________*/





 /* contact function
    ____________________________________________________________*/


    function contact($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/contact';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }


    function sendContact(){
       // $this->form_validation->set_rules('conName', 'Names', 'trim|required|min_length[3]|max_length[12]');
       $this->form_validation->set_rules('conEmail', 'Email', 'trim|required|valid_email');
       $this->form_validation->set_rules('Com', 'Comment', 'trim|required');

        if ($this->form_validation->run() == FALSE)
                {
                        $this->contact();
                }
                else
                {
                    $SendUsMessage=array(
                    // 'name'=>$this->input->post('conName'),
                    'messsubject'=>$this->input->post('conEmail'),
                    'messmessage'=>$this->input->post('Com'),
                    );

                    $insert = $this->home_model->addComment($SendUsMessage);
                    if ($insert) {
                      $this->index();
                    } else {
                      $this->contact();
                    }
                    
                     
                }


    }



    



    function addphotos($prodid)
    {
        $data['productid']=$prodid;
  
        $data['header']='home/header';
        $data['content_page']='home/addphotos';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }

    function addingphoto(){
       
      $getpath = array();
      $s=0;
      $productid = $this->input->post('productid');

      $setphotos = $this->home_model->getphotos($productid);
        
      
      

         $images = $_FILES['files']['name'];

         //$imgcount = count($_FILES['files']['name']);

         foreach ($images as &$value){
           $file_name = time().$i."_".($i+1);
           $values[] = $file_name.$value;

         }
         $_FILES['files']['name'] = $values;


    $path = 'uploads/products/';
    $this->load->library('upload');
    $this->upload->initialize(array(
        "upload_path"=>$path,
        "allowed_types"=>"jpeg|jpg|png|gif"
    ));

    if($this->upload->do_multi_upload("files")){
         //print_r($this->upload->get_multi_upload_data());
    }

    $getnewname = $_FILES['files']['name'];

    foreach ($getnewname as &$naming){
             $newpath = base_url().'uploads/products/';
             $names[] = $newpath.$naming;
    }

    //$getpaths = implode(",", $names);

    foreach ($setphotos as $key => $imgarr) {
      foreach ($imgarr as $key => $img) {
         
          $paths = explode(',', $img);
          
      }    
    }

    
    foreach ($names as $key => $img) {
          $number = count($names);
          if($s==$number-1) break; 
          array_unshift($paths, $img);
          
          $s++;
    }
    
    $getpaths = implode(",", $paths);
    //echo '<pre>';print_r($getpaths);echo '</pre>';die();
    $insert = $this->home_model->add_photos($productid,$getpaths);
  

  $data['productdata']=$this->getproducts();
  
        $data['header']='home/header';
        $data['content_page']='home/products';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);
    
}

    

      

    


   function getproducts(){
        $proddet = array();
        $oneimage = array();
  
        $results = $this->home_model->getpro();

       
        foreach ($results as $key => $values) {  
          $img = $values['photopath'];
          $imagearray = explode(',', $img);

          foreach ($imagearray as $key2 => $assign) {
        $number = count($imagearray);
        if($s==$number-1) break; 
        $oneimage = $assign;
           $values['photopath'] = $oneimage;

        $s++;
        }
        $s=0;
           $proddet['proddet'][] = $values;
        }

        //echo '<pre>';print_r($values);echo '</pre>';die;

         return $proddet;
    }



    function addproduct($data=NULL){

        $this->log_check();

        $data['header']='home/header';
        $data['content_page']='home/add_product';
        $data['footer']='home/footer';
        $data['category']=$this->all_category();
        $data['subcategory']=$this->all_subcategory();
        $config['center'] = '-1.3070583, 36.8088763';
        $config['placesRadius'] = 200;
        $config['zoom'] = 'auto';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $this->googlemaps->initialize($config);
        $data['map'] = $this->googlemaps->create_map();
        $this->template->call_home_template($data);


    }   


 function addingproduct(){
       
       $getpath = array();
       $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[70]');
       $this->form_validation->set_rules('category', 'Category', 'trim|required');
       $this->form_validation->set_rules('descript', 'Description', 'trim|required');
       $this->form_validation->set_rules('neighbourhood', 'Location', 'trim|required');
       $this->form_validation->set_rules('phoneNo', 'Phone Number', 'trim|required');

       if ($this->form_validation->run() == FALSE)
                {
                        $this->addproduct();
                }
                else
                {
         

         $userid = $this->session->userdata('userid');
         $producttitle = $this->input->post('title');
         $categoryid = $this->input->post('category');
         $subcategoryid = $this->input->post('sub_category');
         
         $pdescription = $this->input->post('descript');
         $plocation = $this->input->post('neighbourhood');
         $pprice = $this->input->post('price');
         $phonenumber = $this->input->post('phoneNo');
         $images = $_FILES['files']['name'];

         //
         $imgcount = count($_FILES['files']['name']);

         foreach ($images as &$value){
           $file_name = time().$i."_".($i+1);
           $values[] = $file_name.$value;
           //echo '<pre>';print_r($values);echo '</pre>';die();

         }
         $_FILES['files']['name'] = $values;
         //echo '<pre>';print_r($_FILES['files']['name']);echo '</pre>';die();


    $path = 'uploads/products/';
    $this->load->library('upload');
    $this->upload->initialize(array(
        "upload_path"=>$path,
        "allowed_types"=>"jpeg|jpg|png|gif"
    ));

    if($this->upload->do_multi_upload("files")){
         //print_r($this->upload->get_multi_upload_data());
    }

    $getnewname = $_FILES['files']['name'];

    foreach ($getnewname as &$naming){
             $newpath = base_url().'uploads/products/';
             $names[] = $newpath.$naming;
   //echo '<pre>';print_r($names);echo '</pre>';die();
    }

    $getpaths = implode(",", $names);
    
        $insert = $this->home_model->add_product($userid,$producttitle,$categoryid,$subcategoryid,$pdescription,$plocation,$pprice,$getpaths,$phonenumber);
  

  $data['productdata']=$this->getproducts();
  
        $data['header']='home/header';
        $data['content_page']='home/products';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

}
  
       
    }


   function all_category()
    {
        $cat = $this->home_model->getAvailableCategories();
        $this->categories_combo .= '<select name="category" id="category" style="width:400px; margin-left:100px;" class="form-control">';
        $this->categories_combo .= '<option value="" disabled selected>Choose your option</option>';

        foreach ($cat as $key => $value) {
            $this->categories_combo .= '<option value="'.$value['catid'].'">'.$value['catname'].'</option>';
        }

        $this->categories_combo .= '</select>';
        //echo "<pre>";print_r($this->categories_combo);die();
        return $this->categories_combo;
    }


   // function all_subcategory($category)
   function all_subcategory()
    {
 // echo json_encode($this->home_model->getAvailableSubCategories($category));

        $subcat = $this->home_model->getAvailableSubCategories();
        // echo "<pre>";print_r($cat);die();
        $this->subcategories_combo .= '<select name="subcategory" id="subcategory" style="width:400px; margin-left:100px;" class="form-control other_categories">';
        $this->subcategories_combo .= '<option value="" disabled selected>Choose Sub-Category</option>';

        foreach ($subcat as $key => $value) {
            $this->subcategories_combo .= '<option value="'.$value['subid'].'">'.$value['subname'].'</option>';
        }

        $this->subcategories_combo .= '</select>';
        //echo "<pre>";print_r($this->categories_combo);die();
        return $this->subcategories_combo;
    }


    function userprofile($data=NULL)
    {
  
        $data['header']='home/header';
        $data['content_page']='home/userprofile';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }


    function productsearch(){

    $results = $this->home_model->product_search();

    foreach ($results as $key => $values) {  
          $img = $values['photopath'];
          $imagearray = explode(',', $img);

          foreach ($imagearray as $key2 => $assign) {
        $number = count($imagearray);
        if($s==$number-1) break; 
        $oneimage = $assign;
           $values['photopath'] = $oneimage;

        $s++;
        }
        $s=0;
           $proddet['proddet'][] = $values;
        }

        $data['productdata']=$proddet;
  
        $data['header']='home/header';
        $data['content_page']='home/products';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);
    }

    function products($data=NULL)
    {
        $data['productdata']=$this->getproducts();
  
        $data['header']='home/header';
        $data['content_page']='home/products';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);

    }

    function filtersearch(){

       $prod_category = $this->input->post("searchcategory");
      $prod_subcategory = $this->input->post("searchsubcategory");

    $results = $this->home_model->filter_search($prod_category,$prod_subcategory);
        

    foreach ($results as $key => $values) {  
          $img = $values['photopath'];
          $imagearray = explode(',', $img);

          foreach ($imagearray as $key2 => $assign) {
        $number = count($imagearray);
        if($s==$number-1) break; 
        $oneimage = $assign;
           $values['photopath'] = $oneimage;

        $s++;
        }
        $s=0;
           $proddet['proddet'][] = $values;
        }

       //echo '<pre>';print_r($proddet);echo '</pre>';die;

        $data['productdata']=$proddet;
  
        $data['header']='home/header';
        $data['content_page']='home/products';
        $data['footer']='home/footer';
        $this->template->call_home_template($data);
    }


    function productdetail($id)
    {
  
        $results = $this->home_model->productprofile($id);
        //echo '<pre>';print_r($results);echo '</pre>';die;
        foreach ($results as $key => $values) {
            $details['products'][] = $values;  
        }
        
        
        $data['productdetails'] = $details;


        $data['header']='home/header';
        $data['content_page']='home/view_products';
        $data['footer']='home/footer';

        
        
        $this->template->call_home_template($data);
 
    }



    public function currentprofile($type,$userid)
    {

        $results = $this->home_model->ownprofile($userid);

        foreach ($results as $key => $values) {
            $userdetails['ownprofile'][] = $values;  
        }

        $data['userprofile'] = $admindetails;
        
  
        $data['header']='home/header';
        
        
        
        switch ($type) {
            case 'view':
                $data['content_page']='home/userprofile';
                break;

            case 'edit':
                $data['content_page']='home/edit_currentprofile';
                break;
            
        }
        

        $data['footer']='home/footer';

        
        //echo "<pre>";print_r($data);echo "</pre>";die();
        $this->template->call_home_template($data);
    }



    function editprofile(){

     
       $this->load->library('form_validation');
        
       $this->form_validation->set_rules('email-address', 'Email Address', 'trim|required|valid_email|xss_clean');
        
        

    if($this->form_validation->run() == FALSE){
       echo 'Validation error';die();
      //redirect(base_url() .'admin/activeusers');
        
    }else{
 
          $result = $this->home_model->profile_edit();
               //echo $result;die();

        if($result){
                redirect(base_url() .'home/userprofile');

          }else{
                redirect(base_url() .'home/userprofile');
                 // echo 'There was a problem with the website.<br/>Please contact the administrator';
        }
        }
         
    
  }


   function editproduct(){

     
       $this->load->library('form_validation');
        
       $this->form_validation->set_rules('title', 'Product Title', 'trim|required|xss_clean');
        
        

    if($this->form_validation->run() == FALSE){
       echo 'Validation error';die();
      //redirect(base_url() .'admin/activeusers');
        
    }else{
 
          $result = $this->home_model->product_edit();
               //echo $result;die();

        if($result){
                $this->addsview();

          }else{
                 //$this->addsview();
                 echo 'There was a problem with the website.<br/>Please contact the administrator';
        }
        }
         
    
  }


  function all_category_combo()
    {
        $categories = $this->home_model->get_avail_categories();
         
        $this->categories_combo .= '<select name="categoryid" id="categoryid">';
        // $this->categories_combo .= '<option value="" selected>Choose your option</option>';
        foreach ($categories as $key => $value) {
            $this->categories_combo .= '<option value="'.$value['catid'].'">'.$value['catname'].'</option>';
            //echo "<pre>";print_r($value);die();
        }
        $this->categories_combo .= '</select>';

        return $this->categories_combo;
    }

    function all_subcategory_combo()
    {
        $subcategories = $this->home_model->get_avail_subcategories();
         
        $this->subcategories_combo .= '<select name="subcategoryid" id="subcategoryid">';
        // $this->categories_combo .= '<option value="" selected>Choose your option</option>';
        foreach ($subcategories as $key => $value) {
            $this->subcategories_combo .= '<option value="'.$value['subid'].'">'.$value['subname'].'</option>';
            //echo "<pre>";print_r($value);die();
        }
        $this->subcategories_combo .= '</select>';

        return $this->subcategories_combo;
    }




function create_subcategories_select($category_id)
{
// Get subcategories through your model
 $sub_categories = $this->home_model->get_sub_categories($category_id);
//loop through the sub_categories and create options and store them in a string
           $options_string = '<option value="" disabled selected>Select Sub-Category</option>';
 foreach ($sub_categories as $key => $value) {
            $options_string .= '<option value="'.$value['subid'].'">'.$value['subname'].'</option>';

            //echo "<pre>";print_r($value);die();
        }
// sure you can do this part
// at the end
echo $options_string;

}









  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */