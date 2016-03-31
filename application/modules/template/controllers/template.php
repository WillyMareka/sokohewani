<?php 
if (!defined("BASEPATH")) exit("No direct access to the script allowed");

/**
* 
*/

class Template extends MY_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}


	function call_home_template($data = NULL)

	{
		//echo "<pre>";print_r($data);die();
		$this->load->view('template_home', $data);
	}

	


	function call_admin_template($data = NULL)
	{
		// echo "<pre>";print_r($data);die();
		$this->load->view('template_admin', $data);
	}

	function call_adminlogin_template($data = NULL)
	{
		// echo "<pre>";print_r($data);die();
		$this->load->view('template_admin_login', $data);
	}

	
	

}
?>