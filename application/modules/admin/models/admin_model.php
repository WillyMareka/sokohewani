<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }
    
    /* get all active  categories from  the  database
    _______________________________________________________*/

   

   public function log_admin()
    {
        $username = ($this->input->post('loguser'));
        $passw1 = ($this->input->post('logpass')); 

         //echo '<pre>';print_r($username);echo'</pre>';die;
        $sql = "SELECT * FROM admin WHERE ademail = '". $username ."' LIMIT 1";




        $result = $this->db->query($sql);
        
        $row = $result->row();
         // echo '<pre>';print_r($result);echo'</pre>';die;
        $sql2 = "SELECT * FROM admin WHERE ademail = '". $username ."' AND adstatus = 0 ";

        $result2 = $this->db->query($sql2);
        $row2 = $result->row();

        if($result->num_rows() == 1){
           if($row2->adstatus){
             if ($row->adpassword === sha1($this->config->item('salt') . $passw1)) {
               $session_data = array(
                   'adid'       => $row ->adid , 
                   'adfname'    => $row ->adfname , 
                   'adlname'    => $row ->adlname , 
                   'ademail'    => $row ->ademail ,
                   'adstatus'   => $row ->adstatus ,
                   
                );

                $this -> set_session($session_data);
                return 'logged_in';
             } else {
               return "incorrect_password";
             }
           }else{
             return "not_activated";
           }
         }else{
          return "incorrect_password";
         }


       
       //print_r($this->session->all_userdata());
    }

    public function enter_admin(){
      $firstname = $this->input->post('first_name');
      $lastname = $this->input->post('last_name');
      $email = $this->input->post('adminemail');
      $passw = sha1($this->config->item('salt') . $this->input->post('adminpassword'));
      // $passw = md5($this->input->post('adminpassword'));
      
      $admin_details_data = array();
      $admin_details = array(
          'adfname' => $firstname,
          'adlname' => $lastname,
          'ademail' => $email,
          'adpassword' => $passw
      );

        

        array_push($admin_details_data, $admin_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        $this->db->insert_batch('admin',$admin_details_data);
       

      if($this->db->affected_rows() === 1){

        return $email;

      }else{

      $subject = 'Admin Entry';
      $message = 'Problem in registering User Name '.$email.' . Please rectify immediatelly';

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


    public function verify_reset_password_code($email,$code){
      $sql = "SELECT adfname, ademail FROM admin WHERE ademail = '".$email."' LIMIT 1";

      $result = $this->db->query($sql);
      $row = $result->row();

      if ($result->num_rows() === 1) {
        return ($code == md5($this->config->item('salt') . $row->adfname)) ? true : false;
      } else {
        return false;
      }
      
    }

    public function update_password(){
      $email = $this->input->post('upemail');
      $password = sha1($this->config->item('salt') . $this->input->post('changepass'));

      $sql = "Update admin SET adpassword = '".$password."' WHERE ademail = '".$email."' LIMIT 1";
      $this->db->query($sql);

      if ($this->db->affected_rows() === 1) {
        return true;
      } else {
        return false;
      }
      
    }


    public function logoutadmin($sess_log){
         $data['logged_in'] = 0;

         $this->db->where('session_id', $sess_log);
         $update = $this->db->update('adminsessions', $data);
     }


    private function set_session($session_data){
      $sql = "SELECT adid , adfname, adlname, ademail, adstatus FROM admin WHERE ademail = '". $session_data['ademail'] ."' LIMIT 1";
      $result = $this->db->query($sql);
      $row = $result->row();
       //echo "<pre>";print_r($result);die();
       //echo $session_data['adid'];die();
      $setting_session = array(
                   'adid'       => $session_data['adid'] , 
                   'adfname'    => $session_data['adfname'] ,
                   'adlname'    => $session_data['adlname'] ,
                   'ademail'    => $session_data['ademail'] ,
                   'adstatus'   => $session_data['adstatus'] ,
                   'logged_in'  => 1
      ); 

      $this->session->set_userdata($setting_session);

      //echo "<pre>";print_r($setting_session);die();
      
      $details = $this->session->all_userdata();
      $session_id = mt_rand(10,90);
      $session_id .= $details['session_id'];
      $session_id .= mt_rand(10,90);
       $sql = "INSERT INTO adminsessions (`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`,`adid`,`adfname`,`adlname`,`ademail`,`adstatus`,`logged_in`) 
               VALUES ('".$session_id."', '".$details['ip_address']."','".$details['user_agent']."', 
               '".$details['last_activity']."','1', '".$details['adid']."', '".$details['adfname']."', 
               '".$details['adlname']."', '".$details['ademail']."', '".$details['adstatus']."', 
               '".$details['logged_in']."') ";

    $results = $this->db->query($sql);
    }

    public function ownprofile($adid)
    {
         $profile = array();
         
         $query = $this->db->get_where('admin', array('adid' => $adid));
         $result = $query->result_array();

            if ($result) {
               foreach ($result as $key => $value) {
                  $profile[$value['adid']] = $value;
               }
             // echo '<pre>';print_r($profile);echo '</pre>';die();
              return $profile;

            }
    
    return $profile;
    }

    



   function get_all_users($status) {
    switch ($status) {
        case 'all':
            $sql = "SELECT * FROM `users`";
            break;

        case 'active':
           $sql = "SELECT * FROM `users` WHERE userstatus = 1 ";
            break;

        case 'inactive':
            $sql = "SELECT * FROM `users` WHERE userstatus = 0 ";
            break;
        
        default:
            # code...
            break;
    }
        
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }


    function get_all_messages($status) {
    switch ($status) {
        case 'all':
            $sql = "SELECT * FROM `messages`";
            break;

        case 'read':
           $sql = "SELECT * FROM `messages` WHERE messstatus = 1 ";
            break;

        case 'unread':
            $sql = "SELECT * FROM `messages` WHERE messstatus = 0 ";
            break;
        
        default:
            # code...
            break;
    }
        
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }


    function get_all_categories($status) {

        switch ($status) {
            case 'all':
                $sql = "SELECT * FROM `categories`";
                break;

            case 'active':
                $sql = "SELECT * FROM `categories` WHERE catstatus = 1 ";
                break;

            case 'inactive':
                $sql = "SELECT * FROM `categories` WHERE catstatus = 0 ";
                break;
        }
        // $sql = "SELECT * FROM `categories` WHERE catstatus = 1 ";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }



    function get_all_subcategories($status) {
        switch ($status) {
            case 'all':
               $sql = "SELECT * FROM subcategories s, categories c WHERE s.catid = c.catid";
                break;

            case 'active':
               $sql = "SELECT * FROM subcategories s, categories c WHERE s.catid = c.catid AND subcatstatus = 1";
                break;

            case 'inactive':
               $sql = "SELECT * FROM subcategories s, categories c WHERE s.catid = c.catid AND subcatstatus = 0";
                break;
            
            default:
                # code...
                break;
        }
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }


    function delete_user($id) {
         $result = $this->db->query("DELETE FROM `users` WHERE userid = '".$id."'"); 
         if ($result) {
            return "deleted";
        } else {
            return "notdeleted";
        }
    }


    function delete_message($id) {
         $result = $this->db->query("DELETE FROM `messages` WHERE messid = '".$id."'"); 
         if ($result) {
            return "deleted";
        } else {
            return "notdeleted";
        }
    }
   

    public function userprofile($id) {
        $profile = array();

        $query = $this->db->get_where('users', array('userid' => $id));

        $result = $query->result_array();

        if ($result) {
            foreach ($result as $key => $value) {
                $profile[$value['userid']] = $value;
            }
            return $profile;
        }

        return $profile;
    }

    public function messageprofile($id) {
        $profile = array();

        $query = $this->db->get_where('messages', array('messid' => $id));

        $result = $query->result_array();

        if ($result) {
            foreach ($result as $key => $value) {
                $profile[$value['messid']] = $value;
            }
            return $profile;
        }

        return $profile;
    }


    public function productprofile($id) {
        $profile = array();

         $sql = "SELECT 
                      p.prodid, p.prodtitle, p.proddesc, p.proddate, p.userid, p.prodprice, p.prodapproval, p.prodavail,
                      p.prodlocation, p.photopath, c.catname, s.subname
                      FROM products p, subcategories s, categories c 
                      WHERE p.subid = s.subid AND c.catid = s.catid AND p.prodid = '".$id."' 
                      ORDER BY p.prodtitle;";

         $results = $this->db->query($sql);
        
       $result = $results->result_array();

       return $result;
    }

    public function photoprofile($id) {
        $profile = array();

         $sql = "SELECT 
                 *
                 FROM photos
                 WHERE prodid = '".$id."' 
                 ORDER BY photoid;";

         $results = $this->db->query($sql);
        
       $result = $results->result_array();

       return $result;
    }


    public function categoryprofile($id) {
        $profile = array();

        $query = $this->db->get_where('categories', array('catid' => $id));

        $result = $query->result_array();

        if ($result) {
            foreach ($result as $key => $value) {
                $profile[$value['catid']] = $value;
            }
            return $profile;
        }

        return $profile;
    }


    public function enter_category(){
      $categoryname = $this->input->post('category-name');
      $categorydescription = $this->input->post('category-description');
      
      

      $category_details_data = array();
      $category_details = array(
          'catname' => $categoryname,
          'catdescription' => $categorydescription
          
      );

        

        array_push($category_details_data, $category_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        $this->db->insert_batch('categories',$category_details_data);
       

      if($this->db->affected_rows() === 1){

        return $categoryname;

      }else{
      
      $subject = 'Category Entry';
      $message = 'Problem in registering category name '.$categoryname.'. Please rectify immediatelly';

      $message_details_data = array();
      $message_details = array(
          'subject' => $subject,
          'message' => $message
      );

        

        array_push($message_details_data, $message_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        // $this->db->insert_batch('mail',$message_details_data);

        //echo 'Applicant is not able to be registered';
        // $this->load->library('email');
        // $this->email->from('info@marewill.com','MareWill Fashion');
        // $this->email->to('marekawilly@marewill.com','marekawilly@gmail.com');
        // $this->email->subject('Failed registeration of a product(s)');

        // if(isset($email)){
        //     $this->email->message('Unable to register and insert user with the email of '.$email.' to the database.');
        // }else{
        //     $this->email->message('Unable to register and insert user to the database.');

        // }

        // $this->email->send();
        // return FALSE;
     }
    }


    public function enter_subcategory(){
      $subcategoryname = $this->input->post('sub-category-name');
      $subcategorydescription = $this->input->post('sub-category-description');
      $categoryid = $this->input->post('category-id');
      
      

      $subcategory_details_data = array();
      $subcategory_details = array(
          'subname' => $subcategoryname,
          'subdescription' => $subcategorydescription,
          'catid' => $categoryid
          
      );

        

        array_push($subcategory_details_data, $subcategory_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        $this->db->insert_batch('subcategories',$subcategory_details_data);
       

      if($this->db->affected_rows() === 1){

        return $subcategoryname;

      }else{
      
      $subject = 'SubCategory Entry';
      $message = 'Problem in registering category name '.$subcategoryname.'. Please rectify immediatelly';

      $message_details_data = array();
      $message_details = array(
          'subject' => $subject,
          'message' => $message
      );

        

        array_push($message_details_data, $message_details);

        //echo '<pre>'; print_r($member_details_data); echo '<pre>'; die;

        // $this->db->insert_batch('mail',$message_details_data);

        //echo 'Applicant is not able to be registered';
        // $this->load->library('email');
        // $this->email->from('info@marewill.com','MareWill Fashion');
        // $this->email->to('marekawilly@marewill.com','marekawilly@gmail.com');
        // $this->email->subject('Failed registeration of a product(s)');

        // if(isset($email)){
        //     $this->email->message('Unable to register and insert user with the email of '.$email.' to the database.');
        // }else{
        //     $this->email->message('Unable to register and insert user to the database.');

        // }

        // $this->email->send();
        // return FALSE;
     }
    }




    public function subcategoryprofile($id) {
        $profile = array();

        $query = $this->db->get_where('subcategories', array('subid' => $id));

        $result = $query->result_array();

        if ($result) {
            foreach ($result as $key => $value) {
                $profile[$value['subid']] = $value;
            }
            return $profile;
        }

        return $profile;
    }


    public function subpercategory($id) {
        $profile = array();

        $query = $this->db->get_where('subcategories', array('catid' => $id));

        $result = $query->result_array();

        if ($result) {
            foreach ($result as $key => $value) {
                $profile[$value['subid']] = $value;
            }
            return $profile;
        }

        return $profile;
    }



    public function updateuser($type, $user_id) {
        $data = array();

        switch ($type) {
            case 'userinactive':
                $data['userstatus'] = 0;

                break;

            case 'userrestore':
                $data['userstatus'] = 1;

                break;
        }


        $this->db->where('userid', $user_id);
        $update = $this->db->update('users', $data);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }


    public function updatemessage($type, $mess_id) {
        $data = array();

        switch ($type) {
            case 'messageunread':
                $data['messstatus'] = 0;

                break;

            case 'messageread':
                $data['messstatus'] = 1;

                break;
        }


        $this->db->where('messid', $mess_id);
        $update = $this->db->update('messages', $data);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }



    public function updatecategory($type, $cat_id) {
        $data = array();

        switch ($type) {
            case 'catinactive':
                $data['catstatus'] = 0;

                break;

            case 'catrestore':
                $data['catstatus'] = 1;

                break;
        }


        $this->db->where('catid', $cat_id);
        $update = $this->db->update('categories', $data);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }


    public function updatesubcategory($type, $subcat_id) {
        $data = array();

        switch ($type) {
            case 'subcatinactive':
                $data['subcatstatus'] = 0;

                break;

            case 'subcatrestore':
                $data['subcatstatus'] = 1;

                break;
        }


        $this->db->where('subid', $subcat_id);
        $update = $this->db->update('subcategories', $data);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }



  public function get_approving_status($prodapprovestate)
  {
    $products = array();
    $this->db->order_by("prodid", "desc"); 
 
          switch ($prodapprovestate) {
              case 'await':

              $sql = "SELECT 
                      p.prodid, p.prodtitle, p.proddesc, p.proddate, p.userid, p.prodprice, p.prodapproval, p.prodavail,
                      p.prodlocation, p.photopath, c.catname, s.subname
                      FROM products p, subcategories s, categories c 
                      WHERE p.subid = s.subid AND c.catid = s.catid 
                            AND p.prodavail = 0 AND p.prodapproval = 2  
                      ORDER BY p.prodtitle;";
              //$query = $this->db->get_where('products', array('prodapproval' => 2, 'prodavail' => 0)); 
              break;
              case 'approved':

              $sql = "SELECT 
                      p.prodid, p.prodtitle, p.proddesc, p.proddate, p.userid, p.prodprice, p.prodapproval, p.prodavail,
                      p.prodlocation, p.photopath, c.catname, s.subname
                      FROM products p, subcategories s, categories c 
                      WHERE p.subid = s.subid AND c.catid = s.catid 
                            AND p.prodavail = 1 AND p.prodapproval = 1
                      ORDER BY p.prodtitle;";
        
              break;
              case 'disapproved':
               $sql = "SELECT 
                      p.prodid, p.prodtitle, p.proddesc, p.proddate, p.userid, p.prodprice, p.prodapproval, p.prodavail,
                      p.prodlocation, p.photopath, c.catname, s.subname
                      FROM products p, subcategories s, categories c 
                      WHERE p.subid = s.subid AND c.catid = s.catid 
                            AND p.prodavail = 0 AND p.prodapproval = 0
                      ORDER BY p.prodtitle;";
              break;
    
              default:
               break;
          }
    
       $results = $this->db->query($sql);
        
       $result = $results->result_array();

       return $result;
  }


  public function photo_approving_status($type)
  {
    $products = array();
    $this->db->order_by("photoid", "desc"); 

    switch ($type) {
      case 'wait':
        $query = $this->db->get_where('photos', array('photostatus' => 2)); 
        break;

      case 'approves':
        $query = $this->db->get_where('photos', array('photostatus' => 1)); 
        break;

      case 'disapproves':
        $query = $this->db->get_where('photos', array('photostatus' => 0)); 
        break;
      
      
    }

    $result = $query->result_array();

    if ($result) {
      foreach ($result as $key => $value) {
        $products[$value['photoid']] = $value;
      }
      //echo '<pre>';print_r($products);echo '</pre>';die();
      
      return $products;
    }
    
    return $products;
  }




  public function updateproduct($type, $prod_id)
  {
    $data = array();
    switch ($type) {
      case 'approve':
        $data['prodapproval'] = 1; 
        $data['prodavail'] = 1; 
        
        break;
      
      case 'disapprove':
         $data['prodapproval'] = 0;
         $data['prodavail'] = 0; 

        break;

    }
    $this->db->where('prodid', $prod_id);
    $update = $this->db->update('products', $data);

    // if($type=="approve"){

    //       $subject = "New Product Approved";
    //       $message = 'Product ID '.$prod_id.' was approved';

    //   $mail_to_admin = array();
    //   $mail_admin = array(
    //       'subject' => $subject,
    //       'message' => $message
    //     );

    //   array_push($mail_to_admin, $mail_admin);

    //   $this->db->insert_batch('mail',$mail_to_admin);


    // }elseif ($type=="disapprove") {


    //       $subject = "New Product Disapproved";
    //       $message = 'Product ID '.$prod_id.' was disapproved';

    //   $mail_to_admin = array();
    //   $mail_admin = array(
    //       'subject' => $subject,
    //       'message' => $message
    //     );

    //   array_push($mail_to_admin, $mail_admin);

    //   $this->db->insert_batch('mail',$mail_to_admin);


    // }else{

    //   $subject = "New Product Needs Approval";
    //   $message = 'New product called '.$productname.' from '.$productcompany.' needs your approval';

    //   $mail_to_manager = array();
    //   $mail_manager = array(
    //       'mm_subject' => $subject,
    //       'mm_message' => $message
    //     );

    //   array_push($mail_to_manager, $mail_manager);

    //   $this->db->insert_batch('manager_mail',$mail_to_manager);
    // }

    if ($update) {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function updatephoto($type, $photo_id)
  {
    $data = array();
    switch ($type) {
      case 'approve':
        $data['photostatus'] = 1; 
        
        
        break;
      
      case 'disapprove':
         $data['photostatus'] = 0;

        break;

    }
    $this->db->where('photoid', $photo_id);
    $update = $this->db->update('photos', $data);

    // if($type=="approve"){

    //       $subject = "New Photo Approved";
    //       $message = 'Photo ID '.$photoid.' was approved';

    //   $mail_to_admin = array();
    //   $mail_admin = array(
    //       'subject' => $subject,
    //       'message' => $message
    //     );

    //   array_push($mail_to_admin, $mail_admin);

    //   $this->db->insert_batch('mail',$mail_to_admin);


    // }elseif ($type=="disapprove") {


    //       $subject = "New Product Disapproved";
    //       $message = 'Product ID '.$prod_id.' was disapproved';

    //   $mail_to_admin = array();
    //   $mail_admin = array(
    //       'subject' => $subject,
    //       'message' => $message
    //     );

    //   array_push($mail_to_admin, $mail_admin);

    //   $this->db->insert_batch('mail',$mail_to_admin);


    // }else{

    //   $subject = "New Product Needs Approval";
    //   $message = 'New product called '.$productname.' from '.$productcompany.' needs your approval';

    //   $mail_to_manager = array();
    //   $mail_manager = array(
    //       'mm_subject' => $subject,
    //       'mm_message' => $message
    //     );

    //   array_push($mail_to_manager, $mail_manager);

    //   $this->db->insert_batch('manager_mail',$mail_to_manager);
    // }

    if ($update) {
      return true;
    }
    else
    {
      return false;
    }
  }


  function product_edit(){
      $id = $this->input->post('productid');
      $approval = $this->input->post('approval');
      
      if ($approval == 1) {
        $products_details_data = array(
          'prodapproval' => $approval,
          'prodavail' => 1
          
      );
      } else {
        $products_details_data = array(
          'prodapproval' => $approval,
          'prodavail' => 0
          
      );
      }

     

        $this->db->where('prodid', $id);
        $this->db->update('products', $products_details_data);

       

      if($this->db->affected_rows() === 1){

        return $id;

      }else{

      $subject = 'Product Update';
      $message = 'Problem in registering Product ID '.$id.' . Please rectify immediately';

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



  function category_edit(){
      $id = $this->input->post('category-id');
      $categoryname = $this->input->post('category-name');
      $categorydescription = $this->input->post('category-description');
      $categorystatus = $this->input->post('category-status');
      
      

      $category_details_data = array(
          'catname' => $categoryname,
          'catdescription' => $categorydescription,
          'catstatus' => $categorystatus
          
      );

     

        $this->db->where('catid', $id);
        $this->db->update('categories', $category_details_data);

       

      if($this->db->affected_rows() === 1){

        return $id;

      }else{

      $subject = 'Category Update';
      $message = 'Problem in registering Category ID '.$id.' . Please rectify immediately';

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


  function user_edit(){
      $id = $this->input->post('user-id');
      $userstatus = $this->input->post('user-status');
      
      

      $user_details_data = array(
          'userstatus' => $userstatus
          
      );

     

        $this->db->where('userid', $id);
        $this->db->update('users', $user_details_data);

       

      if($this->db->affected_rows() === 1){
      //echo '<pre>'; print_r($id); echo '<pre>'; die;

        return $id;

      }else{

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


  function profile_edit(){
      $id = $this->input->post('ad-id');
      $firstname = $this->input->post('first-name');
      $lastname = $this->input->post('last-name');
      $emailaddress = $this->input->post('email-address');
      
      

      $admin_details_data = array(
          'adfname' => $firstname,
          'adlname' => $lastname,
          'ademail' => $emailaddress         
      );

     

        $this->db->where('adid', $id);
        $this->db->update('admin', $admin_details_data);

       //echo "<pre>";print_r($id);echo "</pre>";die();

      if($this->db->affected_rows() === 1){
      //echo '<pre>'; print_r($id); echo '<pre>'; die;

        return TRUE;

      }else{

      $subject = 'Admin Update';
      $message = 'Problem in registering Admin ID '.$id.' . Please rectify immediately';

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


  function profilepass_edit($id,$newpass){
      
      

      $admin_details_data = array(
          'adpassword' => $newpass       
      );

     

        $this->db->where('adid', $id);
        $this->db->update('admin', $admin_details_data);

       

      if($this->db->affected_rows() === 1){
      //echo '<pre>'; print_r($id); echo '<pre>'; die;

        return $id;

      }else{

      $subject = 'Admin Password Update';
      $message = 'Problem in changing password with Admin ID '.$id.' . Please rectify immediately';

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


  function sub_category_edit(){
      $id = $this->input->post('sub-category-id');
      $subcategoryname = $this->input->post('sub-category-name');
      $categoryid = $this->input->post('category-id');
      $subcategorydescription = $this->input->post('sub-category-description');
      $subcategorystatus = $this->input->post('sub-category-status');
      
      

      $sub_category_details_data = array(
          'subname' => $subcategoryname,
          'catid' => $categoryid,
          'subdescription' => $subcategorydescription,
          'subcatstatus' => $subcategorystatus
          
      );

     

        $this->db->where('subid', $id);
        $this->db->update('subcategories', $sub_category_details_data);

       

      if($this->db->affected_rows() === 1){

        return $id;

      }else{

      $subject = 'Sub-Category Update';
      $message = 'Problem in registering Sub-Category ID '.$id.' . Please rectify immediately';

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




    public function usernumber($type){

      switch ($type) {
        case 'all':
          $sql = "SELECT COUNT(`userid`) as users FROM users";
          break;

        case 'active':
          $sql = "SELECT COUNT(`userid`) as users FROM users WHERE userstatus = 1";
          break;

        case 'inactive':
          $sql = "SELECT COUNT(`userid`) as users FROM users WHERE userstatus = 0";
          break;
        
      }
    

        $result = $this->db->query($sql);
        $data = $result->row();
        //echo "<pre>";print_r($data);echo "</pre>";die();

        return $data->users;
   }


   public function productnumber($type){

      switch ($type) {
        case 'all':
          $sql = "SELECT COUNT(`prodid`) as products FROM products";
          break;

        case 'active':
          $sql = "SELECT COUNT(`prodid`) as products FROM products WHERE prodavail = 1";
          break;

        case 'inactive':
          $sql = "SELECT COUNT(`prodid`) as products FROM products WHERE prodavail = 0";
          break;

        case 'wait':
          $sql = "SELECT COUNT(`prodid`) as products FROM products WHERE prodapproval = 2";
          break;

        case 'approve':
          $sql = "SELECT COUNT(`prodid`) as products FROM products WHERE prodapproval = 1";
          break;

        case 'disapprove':
          $sql = "SELECT COUNT(`prodid`) as products FROM products WHERE prodapproval = 0";
          break;
        
      }
    

        $result = $this->db->query($sql);
        $data = $result->row();
        //echo "<pre>";print_r($data);echo "</pre>";die();

        return $data->products;
   }


   public function photonumber($type){

      switch ($type) {
        case 'all':
          $sql = "SELECT COUNT(`photoid`) as photos FROM photos";
          break;

        case 'wait':
          $sql = "SELECT COUNT(`photoid`) as photos FROM photos WHERE photostatus = 2";
          break;

        case 'active':
          $sql = "SELECT COUNT(`photoid`) as photos FROM photos WHERE photostatus = 1";
          break;

        case 'inactive':
          $sql = "SELECT COUNT(`photoid`) as photos FROM photos WHERE photostatus = 0";
          break;
        
      }
    

        $result = $this->db->query($sql);
        $data = $result->row();
        //echo "<pre>";print_r($data);echo "</pre>";die();

        return $data->photos;
   }


   public function categorynumber($type){

      switch ($type) {
        case 'all':
          $sql = "SELECT COUNT(`catid`) as categories FROM categories";
          break;

        case 'active':
          $sql = "SELECT COUNT(`catid`) as categories FROM categories WHERE catstatus = 1";
          break;

        case 'inactive':
          $sql = "SELECT COUNT(`catid`) as categories FROM categories WHERE catstatus = 0";
          break;
        
      }
    

        $result = $this->db->query($sql);
        $data = $result->row();
        //echo "<pre>";print_r($data);echo "</pre>";die();

        return $data->categories;
   }


   public function subcategorynumber($type){

      switch ($type) {
        case 'all':
          $sql = "SELECT COUNT(`subid`) as subcategories FROM subcategories";
          break;

        case 'active':
          $sql = "SELECT COUNT(`subid`) as subcategories FROM subcategories WHERE subcatstatus = 1";
          break;

        case 'inactive':
          $sql = "SELECT COUNT(`subid`) as subcategories FROM subcategories WHERE subcatstatus = 0";
          break;
        
      }
    

        $result = $this->db->query($sql);
        $data = $result->row();
        //echo "<pre>";print_r($data);echo "</pre>";die();

        return $data->subcategories;
   }


   public function messagenumber($type){

      switch ($type) {
        case 'all':
          $sql = "SELECT COUNT(`messid`) as messages FROM messages";
          break;

        case 'read':
          $sql = "SELECT COUNT(`messid`) as messages FROM messages WHERE messstatus = 1";
          break;

        case 'unread':
          $sql = "SELECT COUNT(`messid`) as messages FROM messages WHERE messstatus = 0";
          break;
        
      }
    

        $result = $this->db->query($sql);
        $data = $result->row();
        //echo "<pre>";print_r($data);echo "</pre>";die();

        return $data->messages;
   }


   public function cat_check(){
    $categoryname = $this->input->post('category-name');
      $sql = "SELECT * FROM `categories` WHERE `catname` LIKE '".$categoryname."' ";
      $result = $this->db->query($sql);
      $data = $result->row();

      if ($data) {
        return TRUE;
      } else {
        return FALSE;
      }
      
   }

   public function prod_check(){
    $categoryname = $this->input->post('category-name');
      $sql = "SELECT * FROM `categories` WHERE `catname` LIKE '".$categoryname."' ";
      $result = $this->db->query($sql);
      $data = $result->row();

      if ($data) {
        return TRUE;
      } else {
        return FALSE;
      }
      
   }

      

   public function subcat_check(){
    $subcategoryname = $this->input->post('sub-category-name');
      $sql = "SELECT * FROM `subcategories` WHERE `subname` LIKE '".$subcategoryname."' ";
      $result = $this->db->query($sql);
      $data = $result->row();

      if ($data) {
        return TRUE;
      } else {
        return FALSE;
      }
      
   }


   public function check_password($id,$oldpass){
      $sql = "SELECT * FROM admin WHERE adid = '".$id."' AND adpassword = '".$oldpass."' ";
      $result = $this->db->query($sql);
      $data = $result->row();

      if ($data) {
        return TRUE;
      } else {
        return FALSE;
      }
      
   }


   public function username_check($email){
      $sql = "SELECT * FROM `admin` WHERE `ademail` LIKE '".$email."' ";
      $result = $this->db->query($sql);
      $row = $result->row();

      if ($row) {
        return $row->adfname;
      } else {
        return FALSE;
      }
   }














}