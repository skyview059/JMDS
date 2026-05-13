<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2016-11-17
 */

class Settings extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->helper('settings');        
    }

    public function index(){       
        $data = ['settings_data' => $this->Settings_model->get_all()];                
        $this->viewAdminContent('settings/index', $data);
    }
          
    public function update(){        
        ajaxAuthorized();        
        $settings = $this->input->post('data');                
        
        foreach($settings as $label=>$value ){
            $this->db->where('label', $label)->update('settings', ['value' => $value ]);
        }        
        echo ajaxRespond('OK', '<p class="ajax_success"> <b>Settings!</b> saved successfully.</p>');        
    }           
}