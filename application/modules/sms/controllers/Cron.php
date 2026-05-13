<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 04th March 2021 12:00 pm
 */

class Cron extends MX_Controller{
    function __construct(){
        parent::__construct();        
    }
    
    function index(){
        $this->load->library('sms/Bulksms');       
        $json = Bulksms::get_balance();
        
        $respond    = json_decode($json);        
        $timestamp  = "<p>Mail Sent Successfully @ " . date('d/m/y h:i a') .'</p>';
        
        $html = "<h3>Response Code : {$respond->response_code}</h3>";
        $html .= "<h3>Balance_TK : {$respond->balance}</h3>";
        
        if( $respond->balance > 1 ){        
            $html .= '<h3>Balance_SMS : ' . ($respond->balance / 0.25) . '</h3>';
        } else {
            $html .= '<h3>Balance_SMS : 0 </h3>';
        }
        $html .= $timestamp;     
                                
        Modules::run('mail/smsBalance', $html );        
        echo $html;
    }
    
}