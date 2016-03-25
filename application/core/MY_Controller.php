<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
//error_reporting(1);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', '-1');

class MY_Controller extends MX_Controller
{
    public $logged_in;
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->module('home');
        $this->load->module('admin');
        $this->load->module('template');
        $this->load->module('export');

        
    }

  


}