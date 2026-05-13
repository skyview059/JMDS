<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 04th March 2021 12:00 pm
 */

class Report extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('sms/sms');
    }

    public function index(){                
        $this->db->select('DATE_FORMAT(timestamp, "%y-%b") as month');
        $this->db->select('sum(qty) as amount');
        $this->db->group_by('DATE_FORMAT(timestamp, "%Y%m")');
        $this->db->order_by('timestamp', 'ASC');
        $this->db->where('status', 'SUCCESS');
        $this->db->where('timestamp >=', date('Y-m-01 00:00:00', strtotime('- 1 Years')));           
        $monthly_sent = $this->db->get('sms_log')->result();
                       
        $data = array(
            'months' => $monthly_sent,            
        );        
        $this->viewAdminContent('sms/sms/report', $data);
    }        
    
    public function set_status(){
        ajaxAuthorized();
        $this->db->select('id,respond');                        
        $this->db->where('status', NULL );                        
        $logs   = $this->db->get('sms_log')->result();                
        $batch  = [];
        
        foreach($logs as $l ){
            $batch[] = [
                'id' => $l->id,
                'status' => deliveryStatus($l->respond)
            ];
        }

        $qty = sizeof($batch);
        if($qty){
            $this->db->update_batch('sms_log', $batch, 'id');
            echo ajaxRespond('OK', "<p class='ajax_success'>{$qty} rows updated</p>");
        } else {
            echo ajaxRespond('Fail', "<p class='ajax_error'>No row found to update</p>");            
        }        
    }

    public function set_code(){
        ajaxAuthorized();
        $this->db->select('id,respond');                        
        $this->db->where('code', NULL );               
        // $this->db->like('respond', 'api_response_code'); /* ADN SMS Respond */
        $this->db->like('respond', 'response_code'); /* BulkSMS Respond */
        $this->db->or_like('respond', 'message_id');
        
        $logs   = $this->db->get('sms_log')->result();                
        $batch  = [];
        // dd( $logs  );
        foreach($logs as $l ){
            $batch[] = [
                'id' => $l->id,                
                'code' => deliveryCode($l->respond),
            ];
        }

        // dd( $batch );
        
        $qty = sizeof($batch);
        if($qty){
            $this->db->update_batch('sms_log', $batch, 'id');
            echo ajaxRespond('OK', "<p class='ajax_success'>{$qty} rows updated</p>");
        } else {
            echo ajaxRespond('Fail', "<p class='ajax_error'>No row found to update</p>");            
        }        
    }


    public function code2StatusSync(){
        ajaxAuthorized();
        
       
        $this->db->set('status', 'SUCCESS');
        $this->db->where_in('code', [200, 202]);
        $this->db->update('sms_log');
        $qty = $this->db->affected_rows();

        echo ajaxRespond('OK', "<p class='ajax_success'>{$qty} rows updated</p>");
            
    }
}