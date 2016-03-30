<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }
    
    /* get all active  categories from  the  database
    _______________________________________________________*/


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
               $sql = "SELECT * FROM `subcategories`";
                break;

            case 'active':
               $sql = "SELECT * FROM `subcategories` WHERE subcatstatus = 1 ";
                break;

            case 'inactive':
               $sql = "SELECT * FROM `subcategories` WHERE subcatstatus = 0 ";
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


    public function productprofile($id) {
        $profile = array();

        $query = $this->db->get_where('products', array('prodid' => $id));

        $result = $query->result_array();

        if ($result) {
            foreach ($result as $key => $value) {
                $profile[$value['prodid']] = $value;
            }
            return $profile;
        }

        return $profile;
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
      $categoryname = strtoupper($this->input->post('category-name'));
      $categorydescription = strtoupper($this->input->post('category-description'));
      
      

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
      $subcategoryname = strtoupper($this->input->post('sub-category-name'));
      $subcategorydescription = strtoupper($this->input->post('sub-category-description'));
      $categoryid = strtoupper($this->input->post('category-id'));
      
      

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
              $query = $this->db->get_where('products', array('prodapproval' => 2, 'prodavail' => 0)); 
              break;
              case 'approved':
               $query = $this->db->get_where('products', array('prodapproval' => 1, 'prodavail' => 1));
              break;
              case 'disapproved':
               $query = $this->db->get_where('products', array('prodapproval' => 3, 'prodavail' => 0));
              break;
    
              default:
               break;
          }
    


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


  public function photo_approving_status()
  {
    $products = array();
    $this->db->order_by("photoid", "desc"); 

    $query = $this->db->get_where('photos', array('photostatus' => 2)); 

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
         $data['prodapproval'] = 3;
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














}