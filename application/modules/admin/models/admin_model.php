<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }
    
    /* get all active  categories from  the  database
    _______________________________________________________*/


   function get_all_users() {
        $sql = "SELECT 
        *
        FROM  
          `users` 
        WHERE
        userstatus = 1 ";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }

    function get_all_dusers() {
        $sql = "SELECT 
        *
        FROM  
          `users` 
        WHERE
        userstatus = 0";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }

    function get_all_categories() {
        $sql = "SELECT 
        *
        FROM  
          `categories` 
        WHERE
        catstatus = 1 ";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }

    function get_all_dcategories() {
        $sql = "SELECT 
        *
        FROM  
          `categories` 
        WHERE
        catstatus = 0";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }

    function get_all_subcategories() {
        $sql = "SELECT 
        *
        FROM  
          `subcategories` 
        WHERE
        subcatstatus = 1 ";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result);echo "</pre>";die();
        return $result->result_array();
    }

    function get_all_dsubcategories() {
        $sql = "SELECT 
        *
        FROM  
          `subcategories` 
        WHERE
        subcatstatus = 0";
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














}