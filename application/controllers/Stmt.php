<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stmt extends CI_Controller {
    // every thing coming form Frontend Controller

    function __construct() {
        parent::__construct();
    }


    public function index( $id = 0 ){
        $company        = getSettingItem('ComName');
        $address        = getSettingItem('Address');
        $Contact        = getSettingItem('Contact');
        $subscriber     = "#{$id}";
        
        $data = [
            'header' => "<h3>{$company}</h3>
                        <h4>{$address}</h4>
                        <h5><b>মোবাইল:</b> {$Contact}</h5>",
            'subscriber' => $subscriber
        ];
        
        $this->load->view('self_stmt', $data);
        
    }
    
}