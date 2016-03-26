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






}