<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends MY_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }
    
    /* get all active  categories from  the  database
    _______________________________________________________*/


    function getownproducts($userid) {
    
        $sql = "SELECT * FROM `products` WHERE prodapproval = 1 AND prodavail = 1 AND userid = '".$userid."' ";
    
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }


    public function getpro(){
            $products = array();
            $this->db->order_by("prodid", "desc"); 
         
                  
            $query = $this->db->get_where('products', array('prodapproval' => 1, 'prodavail' => 1)); 

            $result = $query->result_array();

            if ($result) {
              foreach ($result as $key => $value) {
                $products[$value['prodid']] = $value;
              }
              //echo '<pre>';print_r($products);echo '</pre>';die();
              
              return $products;
            }
            
            return $products;
    }

    function getphotos($productid){
       $sql = "SELECT 
                    photopath
                FROM
                    `products`
                WHERE 
                   `prodid` = '".$productid."'";
        $result = $this->db->query($sql);
        return $result->result_array();
    }


    public function add_user($customer){
        $insert=$this->db->insert('users', $customer);
        return $insert;
    }




 /*login function to user account
    _______________________________________________________*/
    public function user_login($useremail,$userpassword){
        
         //echo '<pre>';print_r($userpassword);echo'</pre>';die;
        $sql = "SELECT * FROM `users` WHERE `emailaddress` = '".$useremail."' AND `password` = '".$userpassword."'";
        // $sql = "SELECT * FROM `users` WHERE `emailaddress` = '". $useremail ."' AND `password` = '". $userpassword ."';";

        $result = $this->db->query($sql);
        $row = $result->row();
         //echo '<pre>';print_r($sql);echo'</pre>';die;
        // $sql2 = "SELECT * FROM users WHERE emailaddress = '". $useremail ."' AND userstatus = 0";
        $sql2 = "SELECT * FROM users WHERE emailaddress = '". $useremail ."' ";

        $result2 = $this->db->query($sql2);
        $row2 = $result->row();

        $sql3 = "SELECT * FROM users WHERE emailaddress = '". $useremail ."' AND userstatus = 2";

        $result3 = $this->db->query($sql3);
        $row3 = $result->row();


        if($result->num_rows() == 1){
           if(!($row2->userstatus == 0)){
            if(!($row2->userstatus == 2)){
             if ($row->password === $userpassword) {
               $session_data = array(
                   'userid'       => $row ->userid , 
                   'firstname'    => $row ->firstname ,
                   'lastname'    => $row ->lastname , 
                   'emailaddress'      => $row ->emailaddress
                );

                $this -> set_session($session_data);
                return 'logged_in';
               } else {
                 return "incorrect_password";
               }
             }else{
              return "check_email";
            }
           }else{
             return "not_activated";
           }
         }else{
          return "incorrect_password";
         }
     }




private function set_session($session_data){
      $sql = "SELECT userid , firstname,lastname, emailaddress FROM users WHERE emailaddress = '". $session_data['emailaddress'] ."' LIMIT 1";
      $result = $this->db->query($sql);
      $row = $result->row();
       //echo "<pre>";print_r($result);die();
       //echo $session_data['emp_id'];die();
      $setting_session = array(
                   'userid'       => $session_data['userid'] , 
                   'firstname'    => $session_data['firstname'] ,
                   'lastname'       => $session_data['lastname'] ,
                   'emailaddress'       => $session_data['emailaddress'] ,
                   'logged_in'   => 1
      ); 

      $this->session->set_userdata($setting_session);

      //echo "<pre>";print_r($setting_session);die();
      
      $details = $this->session->all_userdata();
       $sql = "INSERT INTO user_session (`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`,`userid`,`firstname`,`lastname`,`emailaddress`,`logged_in`)
               VALUES ('".$details['session_id']."', '".$details['ip_address']."','".$details['user_agent']."', '".$details['last_activity']."', 
                       '1','".$details['userid']."', '".$details['firstname']."','".$details['lastname']."', '".$details['emailaddress']."', '".$details['logged_in']."') ";

    $results = $this->db->query($sql);
      //$this->db->insert_batch('ci_sessions',$session_details);
       // $details = $this->session->all_userdata();
        
    }

    public function logoutuser($sess_log){
         $data['logged_in'] = 0;

         $this->db->where('session_id', $sess_log);
         $update = $this->db->update('user_session', $data);
     }



      public function addComment($SendUsMessage){
        $insert=$this->db->insert('messages', $SendUsMessage);
        return $insert;
    }


    function getAvailableCategories()
    {
        $sql = "SELECT 
                    *
                FROM
                    `categories`
                WHERE 
                   `catstatus` = 1";
        $result = $this->db->query($sql);
        return $result->result_array();
        //echo "<pre>";print_r($result);die();
    }

    // function getAvailableSubCategories($category = null)
    function getAvailableSubCategories()
    {
 //      $this->db->select('subid, subname');
 
 // if($category != NULL){
 // $this->db->where('catid', $category);
 // }
 
 // $query = $this->db->get('subcategories');
 
 // $subcategories = array();
 
 // if($query->result()){
 // foreach ($query->result() as $subcategory) {
 // $subcategories[$subcategory->subid] = $subcategory->subname;
 // }
 // //echo "<pre>";print_r($subcategories);die();
 // return $subcategories;
 // }else{
 // return FALSE;
 // }

        $sql = "SELECT * FROM `subcategories` WHERE `subcatstatus` = 1";

        //$sql = "SELECT * FROM `subcategories` WHERE `catid` = `".$catid."` AND `subcatstatus` = 1";

        $result = $this->db->query($sql);
        return $result->result_array();
        //echo "<pre>";print_r($result);die();
    }

    public function product_search(){
      $product = $this->input->post('searchproduct');

      $sql = "SELECT * FROM `products` WHERE `prodtitle` LIKE '%".$product."%' ";

      $results = $this->db->query($sql);      
      $result = $results->result_array();

       return $result;
    }

    public function filter_search($prod_category,$prod_subcategory){
      $products = array();
     

      //echo '<pre>';print_r($prod_subcategory);echo '</pre>';die;

    $criteria = (isset($prod_category)&& ($prod_category!='')) ?" AND c.catname LIKE '%$prod_category%' " : null;
    $criteria .= (isset($prod_subcategory) && ($prod_subcategory!='')) ? " AND s.subname LIKE '%$prod_subcategory%' " : null;


    $sql = "SELECT p.prodid, p.prodtitle, p.proddesc, p.proddate, p.userid, p.prodprice, p.prodapproval, p.prodavail, p.prodlocation, p.photopath, c.catname, s.subname FROM products p, subcategories s, categories c WHERE  p.catid = c.catid AND p.subid = s.subid AND c.catid = s.catid AND p.prodavail = 1
              $criteria
              AND p.prodapproval = 1 ORDER BY p.prodtitle
              ";

              //echo '<pre>';print_r($sql);echo '</pre>';die;

               
    $results = $this->db->query($sql);      
      $result = $results->result_array();

    if ($result) {
      foreach ($result as $key => $value) {
        $products[$value['prod_id']] = $value;
      }
      //echo '<pre>';print_r($result);echo '</pre>';die();
      
      return $result;
    }
    
    return $result;
  }


    public function productprofile($id) {    
       $products = array();
       //echo '<pre>';print_r($id);echo '</pre>';die;
       $sql = "SELECT p.prodid, p.prodtitle, p.proddesc, p.proddate, p.userid, p.prodprice, p.prodapproval, p.prodavail,
                      p.prodlocation, p.photopath, c.catname, s.subname
                      FROM products p, subcategories s, categories c 
                      WHERE p.catid = c.catid AND p.subid = s.subid AND c.catid = s.catid 
                            AND p.prodavail = 1 AND p.prodapproval = 1
                            AND p.prodid = '".$id."'  
                      ORDER BY p.prodtitle;";


        $results = $this->db->query($sql);
        
       $result = $results->result_array();

       return $result;
    }


    public function ownprofile($userid)
    {
         $profile = array();
         
         $query = $this->db->get_where('users', array('userid' => $adid));
         $result = $query->result_array();

            if ($result) {
               foreach ($result as $key => $value) {
                  $profile[$value['userid']] = $value;
               }
             // echo '<pre>';print_r($profile);echo '</pre>';die();
              return $profile;

            }
    
    return $profile;
    }



    function profile_edit(){
      $id = $this->input->post('user-id');
      $firstname = $this->input->post('first-name');
      $lastname = $this->input->post('last-name');
      $emailaddress = $this->input->post('email-address');
      

      $user_details_data = array(
          'firstname' => $firstname,
          'lastname' => $lastname,
          'emailaddress' => $emailaddress         
      );

     

        $this->db->where('userid', $id);
        $this->db->update('users', $user_details_data);

      
      
       

      if($this->db->affected_rows() === 1){

        return $id;

      }else{
//echo '<pre>'; print_r("Reaching4"); echo '<pre>'; die;
      $subject = 'User Update';
      $message = 'Problem in registering User ID '.$id.' . Please rectify immediately';

      $message_details_data = array();
      $message_details = array(
          'subject' => $subject,
          'message' => $message
      );

        

        array_push($message_details_data, $message_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        // $this->db->insert_batch('mail',$message_details_data);

        // //echo 'Applicant is not able to be registered';
        // $this->load->library('email');
        // $this->email->from('info@marewill.com','MareWill Fashion');
        // $this->email->to('marekawilly@marewill.com','marekawilly@gmail.com');
        // $this->email->subject('Failed registeration of a user');

        // if(isset($email)){
        //     $this->email->message('Unable to register and insert user with the email of '.$email.' to the database.');
        // }else{
        //     $this->email->message('Unable to register and insert user to the database.');

        // }

        // $this->email->send();
        return FALSE;
     }
  }

  function product_edit(){
      $id = $this->input->post('productid');
      $title = $this->input->post('title');
      $category = $this->input->post('categoryid');
      $subcategory = $this->input->post('subcategoryid');
      $description = $this->input->post('description');
      $price = $this->input->post('price');
      $location = $this->input->post('location');
      

      $product_details_data = array(
          'prodtitle' => $title,
          'catid' => $category,
          'subid' => $subcategory,
          'proddesc' => $description,
          'prodprice' => $price,
          'prodlocation' => $location,
          'prodapproval'=>2,  
          'prodavail'=>0       
      );

     

        $this->db->where('prodid', $id);
        $this->db->update('products', $product_details_data);

      
      
       

      if($this->db->affected_rows() === 1){

        return $id;

      }else{
//echo '<pre>'; print_r("Reaching4"); echo '<pre>'; die;
      $subject = 'User Update';
      $message = 'Problem in registering User ID '.$id.' . Please rectify immediately';

      $message_details_data = array();
      $message_details = array(
          'subject' => $subject,
          'message' => $message
      );

        

        array_push($message_details_data, $message_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        // $this->db->insert_batch('mail',$message_details_data);

        // //echo 'Applicant is not able to be registered';
        // $this->load->library('email');
        // $this->email->from('info@marewill.com','MareWill Fashion');
        // $this->email->to('marekawilly@marewill.com','marekawilly@gmail.com');
        // $this->email->subject('Failed registeration of a user');

        // if(isset($email)){
        //     $this->email->message('Unable to register and insert user with the email of '.$email.' to the database.');
        // }else{
        //     $this->email->message('Unable to register and insert user to the database.');

        // }

        // $this->email->send();
        return FALSE;
     }
  }


  public function activate_account($email){

      $sql = "Update users SET userstatus = '1' WHERE emailaddress = '".$email."' LIMIT 1";
      $this->db->query($sql);

      if ($this->db->affected_rows() === 1) {
        return true;
      } else {
        return false;
      }
      
    }



  public function verify_reset_password_code($email,$code){
      $sql = "SELECT firstname, emailaddress FROM users WHERE emailaddress = '".$email."' LIMIT 1";

      $result = $this->db->query($sql);
      $row = $result->row();
         //echo '<pre>';print_r($row->firstname);echo'</pre>';die;
      if ($result->num_rows() === 1) {
        return ($code == md5($this->config->item('salt') . $row->firstname)) ? true : false;

      } else {
        return false;
      }
      
    }


    function add_product($userid,$producttitle,$categoryid,$subcategoryid,$pdescription,$plocation,$pprice,$path,$phonenumber)
    {
      //echo '<pre>';print_r($userid);echo'</pre>';die;
      $enter_product = array();
      $product=array(
            'prodtitle'=>$producttitle,
            'catid'=>$categoryid,
            'subid'=>$subcategoryid,
            'proddesc'=>$pdescription,
            'prodlocation'=>$plocation,
            'photopath'=>$path,
            'userid'=>$userid,
            'prodprice'=>$pprice,
            'phoneno'=>$phonenumber

        );

      array_push($enter_product, $product);
      $insert = $this->db->insert_batch('products',$enter_product);




      if ($insert) {

        return true;

      } else {
        //echo '<pre>';print_r("Reaching");echo'</pre>';die;
        return false;
      }
    }


    function add_photos($productid,$path)
    {
      //echo '<pre>';print_r($path);echo'</pre>';die;
     
      $product_details_data = array(
          'photopath'=>$path,
          'prodapproval' => 2, 
          'prodavail' => 0      
      );

      $this->db->where('prodid', $productid);
      $this->db->update('products', $product_details_data);

      if ($insert) {

        return true;

      } else {
        //echo '<pre>';print_r("Reaching");echo'</pre>';die;
        return false;
      }
    }


    function get_avail_categories()
    {
        $sql = "SELECT 
                    *
                FROM
                    `categories`
                WHERE 
                   `catstatus` = 1";
        $result = $this->db->query($sql);
        return $result->result_array();
    }


    function get_avail_subcategories()
    {
        $sql = "SELECT 
                    *
                FROM
                    `subcategories`
                WHERE 
                   `subcatstatus` = 1";
        $result = $this->db->query($sql);
        return $result->result_array();
    }

   


 function get_sub_categories($category_id)
    {

        $sql = "SELECT 
                    *
                FROM
                    `subcategories`
                WHERE 
                   `subcatstatus` = 1
                   AND 
                   `catid` = '".$category_id."' ";
                   
        $result = $this->db->query($sql);
        return $result->result_array();

    }
   









}