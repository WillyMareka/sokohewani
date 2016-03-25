<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends MY_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }
    
    /* get all active  categories from  the  database
    _______________________________________________________*/


    public function get_categories(){

     //    $data=array();
     //        $stmt="SELECT 
     //        catid AS 'Category id',
     //        catname AS 'Category Name'
     //        FROM 
     //        `category`
     //        WHERE catstatus=1 ORDER BY catname DESC";

     //        $result = $this->db->query($stmt);
     //        if($result->num_rows > 0){
     //            $data=$result;
     //        }
        
    	// return $data->result_array();
    }




}