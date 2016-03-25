<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(1);
class Admin extends MY_Controller {

  //public $logged_in;

     /* class constructor
    ____________________________________________________________*/

  public function __construct()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');

        $this->pic_path = realpath(APPPATH . '../uploads/');
        $this->load->module('export');

        $this->load->model('admin_model');
        parent::__construct();
     
    }

    /* index function
    ____________________________________________________________*/

    function index($data=NULL)
    {
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_content';
        $data['footer']='admin/admin_footer';

        $data['all_users'] = $this->createusersview('table','active');
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function inactiveusers($data=NULL)
    {
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dusers';
        $data['footer']='admin/admin_footer';

        $data['all_dusers'] = $this->createusersview('table','inactive');
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function development($data=NULL)
    {
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_development';
        $data['footer']='admin/admin_footer';
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function createusersview($type,$status)
    {
           $display = '';

        switch ($status) {
            case 'active':
               $users = $this->admin_model->get_all_users();
                break;

             case 'inactive':
                $users = $this->admin_model->get_all_dusers();
                break;
            
            default:
                # code...
                break;
        }
        
           
             // echo "<pre>";print_r("reached");echo "</pre>";die();
        

        $count = 0;


      // creating arrays for both pdf and excel for data storage and transfer
        $column_data = $row_data = array();

        // display used for table
        $display .= "<tbody>";

        // html_body Used for the pdf
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Profile Status</th>
            <th>Date Registered</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';

        foreach ($users as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['userstatus'] == 1) {
                    $state = '<span class="btn disabled">Activated</span>';
                    $states = 'Activated';
                } else if ($data['userstatus'] == 0) {
                    $state = '<span class="btn disabled">Deactivated</span>';
                    $states = 'Deactivated';
                }
                $date = date("d-m-Y",strtotime($data['regdate']));

        switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['userid'].'</td>';
                $display .= '<td class="centered">'.$data['firstname'].'</td>';
                $display .= '<td class="centered">'.$data['lastname'].'</td>';
                $display .= '<td class="centered">'.$data['emailaddress'].'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                $display .= '<td class="centered">'.$date.'</td>';
                

                //$display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="View Profile" href = "'.base_url().'admin/viewuser/'.$data['user ID'].'"><i class="fa fa-eye black"></i></a></td>';
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="View Profile" href = "'.base_url().'admin/userdetail/'.$data['userid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['userstatus'] == 0){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Activate" href = "'.base_url().'admin/userupdate/userrestore/'.$data['userid'].'"><i class="material-icons">add</i></td>';
               }else if($data['userstatus'] == 1){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Deactivate" href = "'.base_url().'admin/userupdate/userdelete/'.$data['userid'].'"><i class="material-icons">delete</i></td>';
                }
                
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['userid'], $data['firstname'], $data['lastname'], $data['emailaddress'], $states, $date)); 

                break;

            case 'pdf':

            //echo'<pre>';print_r($categories);echo'</pre>';die();
           
                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['userid'].'</td>';
                $html_body .= '<td>'.$data['firstname'].'</td>';
                $html_body .= '<td>'.$data['lastname'].'</td>';
                $html_body .= '<td>'.$data['emailaddress'].'</td>';
                $html_body .= '<td>'.$states.'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        
        
        if($type == 'excel'){

            $excel_data = array();
            $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'User Excel Report', 'file_name' => 'User Report', 'excel_topic' => 'User Profiles');
            $column_data = array('Number','User ID','First Name','Last Name','Email Address','Profile Status','Date Registered');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

              //echo'<pre>';print_r($excel_data);echo'</pre>';die();

            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "User PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'User Report', 'pdf_topic' => 'User Profile');

            //echo'<pre>';print_r($pdf_data);echo'</pre>';die();

            $this->export->create_pdf($pdf_data);

        }else{

            $display .= "</tbody>";

            //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }
    }


   function userdetail($id)
    {
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->userprofile($id);

        foreach ($results as $key => $values) {
            $details['users'][] = $values;  
        }
        
        
        $data['userdetails'] = $details;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_development';
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }


    function userupdate($type, $user_id)
    {
        $update = $this->admin_model->updateuser($type, $user_id);

        if($update)
        {
            switch ($type) {

                case 'userdelete':
                    $this->inactiveusers();
                    //$this->users();
                    break;

                case 'userrestore':
                    $this->index();
                    //$this->users();
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }


    // function users()
    // {
    //    $this->log_check();

    //     $data['all_clients'] = $this->createusersview('table','active');
        

    //     $data['navbar']='admin/admin_header';
    //     $data['sidebar']='admin/admin_sidebar';
    //     $data['content']='admin/userprofile';
    //     $data['footer']='admin/admin_footer';
        
        
    //     $this->template->call_admin_template($data);
    // }











  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */