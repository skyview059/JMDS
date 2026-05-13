<?php

/**
 * Description of Admin_controller
 *
 * @author Kanny
 */
class Admin_controller extends MX_Controller {    
    protected $user_id;
    protected $role_id;
    
    public function __construct() {
        parent::__construct();               
        $this->load->library('user_agent');                              
        $this->load->helper('security');
        $this->load->helper('acl_helper');         
        $this->load->model('module/Acl_model', 'acls');      

        /* @var $user_id type */
        $this->user_id = getLoginUserData('user_id');
        $this->role_id = getLoginUserData('role_id');
        
        
        if($this->user_id <= 0){
            redirect( site_url('login'));
        }
    }
    
   	       
    public function viewAdminContent($view, $data = []){				
        if( $this->input->is_ajax_request() ){
            $this->load->view($view, $data);        
        } else {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar'); 
            //$this->load->view('maintenance');    
            
            if( $this->check_access( $view ) ){
                $this->load->view($view, $data); 
            } else {
                $this->load->view('restrict');    
            }
            $this->load->view('layout/footer');
        }
    }
    
    private function check_access( $string = 'dashboard'){                
        $controller = empty($this->uri->segment(1)) ? $string : $this->uri->segment(1);       
        $method     = empty($this->uri->segment(2)) ? '' : '/'.$this->uri->segment(2);        
        $access_key = $controller . $method;                
        return $this->acls->checkPermission($access_key, $this->role_id);
    }
      
}
