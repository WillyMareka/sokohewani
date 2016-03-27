<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(1);
class Admin extends MY_Controller {

  //public $logged_in;

     /* class constructor
    ____________________________________________________________*/

  public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->module('export/export');
        $this->load->library('upload');

        $this->pic_path = realpath(APPPATH . '../uploads/');

        
        
     
    }

    /* index function
    ____________________________________________________________*/

    function index($data=NULL)
    {

        $data['all_users'] = $this->createusersview('table','active');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_content';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function activeusers($data=NULL)
    {

        $data['all_users'] = $this->createusersview('table','active');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_ausers';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function activecategories($data=NULL)
    {

        $data['all_categories'] = $this->createcategoryview('table','active');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_acategories';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function activesubcategories($data=NULL)
    {

        $data['all_subcategories'] = $this->createsubcategoryview('table','active');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_asubcat';
        $data['footer']='admin/admin_footer';

        
        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    
    function inactiveusers($data=NULL)
    {

        $data['all_dusers'] = $this->createusersview('table','inactive');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dusers';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function inactivecategories($data=NULL)
    {

        $data['all_dcategories'] = $this->createcategoryview('table','inactive');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dcategories';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }

    function inactivesubcategories($data=NULL)
    {

        $data['all_dsubcategories'] = $this->createsubcategoryview('table','inactive');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_dsubcat';
        $data['footer']='admin/admin_footer';

        
        //echo "<pre>";print_r($data);die();
        $this->template->call_admin_template($data);

    }



    function productsview($data=NULL)
    {

        $data['waits'] = $this->productapproving('await');
        $data['approves'] = $this->productapproving('approved');
        $data['disapproves'] = $this->productapproving('disapproved');
  
        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_product_view';
        $data['footer']='admin/admin_footer';

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

         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
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
        
        if(isset($users)){

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
                $display .= '<td class="centered">'.$data['emaillock_outlineress'].'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                $display .= '<td class="centered">'.$date.'</td>';
                
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="View Profile" href = "'.base_url().'admin/userdetail/'.$data['userid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['userstatus'] == 0){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Activate" href = "'.base_url().'admin/userupdate/userrestore/'.$data['userid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['userstatus'] == 1){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Deactivate" href = "'.base_url().'admin/userupdate/userinactive/'.$data['userid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Delete" href = "'.base_url().'admin/userdelete/'.$data['userid'].'"><i class="material-icons">delete</i></a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['userid'], $data['firstname'], $data['lastname'], $data['emaillock_outlineress'], $states, $date)); 
                 

                break;

            case 'pdf':
            
            
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['userid'].'</td>';
                $html_body .= '<td>'.$data['firstname'].'</td>';
                $html_body .= '<td>'.$data['lastname'].'</td>';
                $html_body .= '<td>'.$data['emaillock_outlineress'].'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
            $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'User Excel Report', 'file_name' => 'Profile Report', 'excel_topic' => 'Profiles Report');
            $column_data = array('No.','User ID','First Name','Last Name','Email lock_outlineress','Profile Status','Date Registered');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Profile PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Profile Report', 'pdf_topic' => 'Profiles');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
              $display .= "</tbody>";

              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }


    


    function createcategoryview($type,$status)
    {
      
        switch ($status) {
            case 'active':
               $categories = $this->admin_model->get_all_categories();
                break;

             case 'inactive':
                $categories = $this->admin_model->get_all_dcategories();
                break;
            
            default:
                # code...
                break;
        }

         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Date Registered</th>
            <th>Profile Status</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($categories)){

            foreach ($categories as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['catstatus'] == 1) {
                    $state = '<span class="btn disabled">Activated</span>';
                    $states = 'Activated';
                } else if ($data['catstatus'] == 0) {
                    $state = '<span class="btn disabled">Deactivated</span>';
                    $states = 'Deactivated';
                }

                $date = date("d-m-Y",strtotime($data['catdate']));

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['catid'].'</td>';
                $display .= '<td class="centered">'.$data['catname'].'</td>';
                // $display .= '<td class="centered">'.$data['catdescription'].'</td>';
                $display .= '<td class="centered">'.$date.'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="View Profile" href = "'.base_url().'admin/categorydetail/'.$data['catid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['catstatus'] == 0){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Activate" href = "'.base_url().'admin/catupdate/catrestore/'.$data['catid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['catstatus'] == 1){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Deactivate" href = "'.base_url().'admin/catupdate/catinactive/'.$data['catid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                // $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Delete" href = "'.base_url().'admin/catdelete/'.$data['catid'].'"><i class="material-icons">delete</i></a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['catid'], $data['catname'], $data['catdescription'], $date, $states)); 
                 

                break;

            case 'pdf':
       
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['catid'].'</td>';
                $html_body .= '<td>'.$data['catname'].'</td>';
                $html_body .= '<td>'.$data['catdescription'].'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
        $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'Category Excel Report', 'file_name' => 'Category Report', 'excel_topic' => 'Categories Report');
             $column_data = array('No.','Category ID','Category Name','Description','Date Registered','Category Status');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Category PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Category Report', 'pdf_topic' => 'Categories');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


            $this->export->create_pdf($pdf_data);
        }else{
              $display .= "</tbody>";

              //echo'<pre>';print_r($display);echo'</pre>';die();

            return $display;
        }

        
    }


    function createsubcategoryview($type,$status)
    {
      
        switch ($status) {
            case 'active':
               $subcategories = $this->admin_model->get_all_subcategories();
                break;

             case 'inactive':
                $subcategories = $this->admin_model->get_all_dsubcategories();
                break;
            
            default:
                # code...
                break;
        }

         //echo "<pre>";print_r($users);echo '</pre>';die();

        $column_data = $row_data = array();
          
        $count = 0;
        $display = "<tbody>";
        $html_body = '
        <table class="data-table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Sub-Category ID</th>
            <th>Sub-Category Name</th>
            <th>Description</th>
            <th>Date Registered</th>
            <th>Category ID</th>
            <th>Profile Status</th>
        </tr> 
        </thead>
        <tbody>
        <ol type="a">';
        
        if(isset($subcategories)){

            foreach ($subcategories as $key => $data) {
            //echo "<pre>";print_r($users);echo "</pre>";die();
            $count++;
                if ($data['subcatstatus'] == 1) {
                    $state = '<span class="btn disabled">Activated</span>';
                    $states = 'Activated';
                } else if ($data['subcatstatus'] == 0) {
                    $state = '<span class="btn disabled">Deactivated</span>';
                    $states = 'Deactivated';
                }

                $date = date("d-m-Y",strtotime($data['subdate']));

            

    switch ($type) {
            case 'table':
                $display .= '<tr>';
                $display .= '<td class="centered">'.$count.'</td>';
                $display .= '<td class="centered">'.$data['subid'].'</td>';
                $display .= '<td class="centered">'.$data['subname'].'</td>';
                // $display .= '<td class="centered">'.$data['subdescription'].'</td>';
                $display .= '<td class="centered">'.$date.'</td>';
                $display .= '<td class="centered">'.$data['catid'].'</td>';
                $display .= '<td class="centered">'.$state.'</td>';
                
                
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="View Profile" href = "'.base_url().'admin/subcategorydetail/'.$data['subid'].'"><i class="material-icons">contacts</i></a></td>';
              
                        if($data['subcatstatus'] == 0){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Activate" href = "'.base_url().'admin/subcatupdate/subcatrestore/'.$data['subid'].'"><i class="material-icons">lock_outline</i></td>';
               }else if($data['subcatstatus'] == 1){
                $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Deactivate" href = "'.base_url().'admin/subcatupdate/subcatinactive/'.$data['subid'].'"><i class="material-icons">lock_open</i></td>';
                }
                
                // $display .= '<td class="centered"><a data-toggle="tooltip" data-placement="bottom" title="Click to Delete" href = "'.base_url().'admin/subcatdelete/'.$data['subcatid'].'"><i class="material-icons">delete</i></a></td>';
                
              
                $display .= '</tr>';

                break;
            
            case 'excel':
               
                 array_push($row_data, array($count, $data['subid'], $data['subname'], $data['subdescription'], $date, $data['catid'], $states)); 
                 

                break;

            case 'pdf':
       
            //echo'<pre>';print_r($html_body);echo'</pre>';die();

                $html_body .= '<tr>';
                $html_body .= '<td>'.$count.'</td>';
                $html_body .= '<td>'.$data['subid'].'</td>';
                $html_body .= '<td>'.$data['subname'].'</td>';
                $html_body .= '<td>'.$data['subdescription'].'</td>';
                $html_body .= '<td>'.$date.'</td>';
                $html_body .= '<td>'.$data['catid'].'</td>';
                $html_body .= '<td>'.$state.'</td>';
                $html_body .= "</tr></ol>";

                break;
               }
            }
        }
        

        if($type == 'excel'){
            $excel_data = array();
        $excel_data = array('doc_creator' => 'SokoHewa Limited', 'doc_title' => 'Sub-Category Excel Report', 'file_name' => 'Sub-Category Report', 'excel_topic' => 'Sub-Categories Report');
             $column_data = array('No.','Sub-Category ID','Sub-Category Name','Description','Date Registered','Category ID','Sub-Category Status');
            $excel_data['column_data'] = $column_data;
            $excel_data['row_data'] = $row_data;

        //echo'<pre>';print_r($excel_data);echo'</pre>';
            // echo'<pre>';var_dump($excel_data);echo'</pre>';
            $this->export->create_excel($excel_data);

        }elseif($type == 'pdf'){
            
            
            $html_body .= '</tbody></table>';
            $pdf_data = array("pdf_title" => "Sub-Category PDF Report", 'pdf_html_body' => $html_body, 'pdf_view_option' => 'download', 'file_name' => 'Sub-Category Report', 'pdf_topic' => 'Sub-Categories');

        //echo'<pre>';print_r($pdf_data);echo'</pre>';


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


    function productdetail($id)
    {
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->productprofile($id);

        foreach ($results as $key => $values) {
            $details['products'][] = $values;  
        }
        
        
        $data['productdetails'] = $details;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_development';
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }


    function categorydetail($id)
    {
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->categoryprofile($id);

        foreach ($results as $key => $values) {
            $details['categories'][] = $values;  
        }
        
        
        $data['categorydetails'] = $details;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_development';
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }


    function subcategorydetail($id)
    {
        //$this->log_check();
        $userdet = array();

        
        $results = $this->admin_model->subcategoryprofile($id);

        foreach ($results as $key => $values) {
            $details['subcategories'][] = $values;  
        }
        
        
        $data['subcategorydetails'] = $details;


        $data['navbar']='admin/admin_header';
        $data['sidebar']='admin/admin_sidebar';
        $data['content']='admin/admin_development';
        $data['footer']='admin/admin_footer';

        
        
        $this->template->call_admin_template($data);
 
    }



    function userdelete($id)
    {
        //$this->log_check();

        $results = $this->admin_model->delete_user($id);

        
        
            switch ($results) {

                case 'deleted':
                    $this->activeusers();
                    //$this->users();
                    break;

                case 'notdeleted':
                    $this->activeusers();
                    //$this->users();
                    break;
                
                default:
                    # code...
                    break;
            }
 
    }

    function catdelete($id)
    {
        //$this->log_check();

        $results = $this->admin_model->delete_cat($id);

        
        
            switch ($results) {

                case 'deleted':
                    $this->activecategories();
                    //$this->users();
                    break;

                case 'notdeleted':
                    $this->activecategories();
                    //$this->users();
                    break;
                
                default:
                    # code...
                    break;
            }
 
    }

    


    function userupdate($type, $user_id)
    {
        $update = $this->admin_model->updateuser($type, $user_id);

        if($update)
        {
            switch ($type) {

                case 'userinactive':
                    $this->inactiveusers();
                    
                    break;

                case 'userrestore':
                    $this->activeusers();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }

    function catupdate($type, $cat_id)
    {
        $update = $this->admin_model->updatecategory($type, $cat_id);

        if($update)
        {
            switch ($type) {

                case 'catinactive':
                    $this->inactivecategories();
                    
                    break;

                case 'catrestore':
                    $this->activecategories();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }

    function subcatupdate($type, $subcat_id)
    {
        $update = $this->admin_model->updatesubcategory($type, $subcat_id);

        if($update)
        {
            switch ($type) {

                case 'subcatinactive':
                    $this->inactivesubcategories();
                    
                    break;

                case 'subcatrestore':
                    $this->activesubcategories();
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }


    function productapproving($prodapprovestate)
  {
    $proddet = array();
    switch ($prodapprovestate) {

        case 'await':
            $results = $this->admin_model->get_approving_status($prodapprovestate);
            break;

        case 'approved':
            $results = $this->admin_model->get_approving_status($prodapprovestate);
            break;

        case 'disapproved':
            $results = $this->admin_model->get_approving_status($prodapprovestate);
            break;
    }
       
       foreach ($results as $key => $values) {  
           $proddet['proddet'][] = $values;
       }

        //echo '<pre>';print_r($proddet);echo '</pre>';die;

        return $proddet;
  }


  function updateproduct($type, $prod_id)
  {

    //print_r($prod_id);die();
    $update = $this->admin_model->updateproduct($type, $prod_id);
    if($update)
    {
      //echo '<pre>';print_r($update);echo '</pre>';die;
      switch ($type) {
        case 'approve':
         
          $this->productsview();
          break;

        case 'disapprove':
         
          $this->productsview();
          break;
        
        default:
          # code...
          break;
      }
    }else{
      echo '<pre>';print_r("Problem found when updating status");echo '</pre>';die;
    }
  }


  









  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */