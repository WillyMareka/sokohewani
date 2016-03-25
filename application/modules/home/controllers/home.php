<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(1);
class Home extends MY_Controller {

  //public $logged_in;

     /* class constructor
    ____________________________________________________________*/

  public function __construct()
    {

        parent::__construct();
     
    }

    /* index function
    ____________________________________________________________*/

    function index($data=NULL)
    {
  
        //$data['top_navbar1']='home/navbar_view1';
        $data['content_page']='home/home_view';
        //$data['main_footer']='home/footer_view1';
        //echo "<pre>";print_r($data);die();
        $this->template->call_home_template($data);

    }
  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */