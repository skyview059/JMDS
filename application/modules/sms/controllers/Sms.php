<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2019-08-25
 */

class Sms extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Sms_model');
        $this->load->helper('sms');
        $this->load->helper('sms/template');
        $this->load->library('form_validation');
        
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $limit = (int)($this->input->get('limit') ?? 100);
        $year  = (int)($this->input->get('year') ?? date('Y'));
        $month = (int)($this->input->get('month') ?? date('m'));
        $order_by = $this->input->get('order_by') ?? 'Default';
        $sms_type = $this->input->get('sms_type') ?? 'All';
        
        $config['base_url']     = build_pagination_url( Backend_URL . 'sms', 'start');
        $config['first_url']    = build_pagination_url( Backend_URL . 'sms', 'start');

        $config['per_page']     = $limit;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sms_model->total_rows($year,$month, $sms_type, $q);
        $total_sent = $this->Sms_model->total_sent();
        $smss = $this->Sms_model->get_limit_data($config['per_page'], $start, $year,$month, $sms_type, $order_by, $q );

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'smss' => $smss,
            'last_query' => $this->db->last_query(),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'role_id' => $this->role_id,
            'total_sent' => $total_sent,            
            'limit' => $limit,       
            'month' => $month,
            'min_year' => 2019,
            'max_year' => date('Y', strtotime('+1 Year')),
            'year' => $year,     
            'order_by' => $order_by,     
            'sms_type' => $sms_type,     
        );
        $this->viewAdminContent('sms/sms/index', $data);
    }
    
    public function write(){
        $mobiles = getAllDonorMobileNumber();
        $data = array(
            'button'    => 'Create',
            'action'    => site_url( Backend_URL . 'sms/send'),
	    'id'        => set_value('id'),
	    'sms_qty'   => $mobiles['sms_qty'],
	    'phone'     => $mobiles['mobiles'],
//	    'phone'     => '8801713900423,8801938650291',
	    'body'      => set_value('body'),
	);
        $this->viewAdminContent('sms/sms/write', $data);
    }
    
    public function send(){
        
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->write();
        } else {
            
            $message    = $this->input->post('body',TRUE);
            $phone      = $this->input->post('phone',TRUE);
            
            /* $this->load->library('sms/Adnsms'); */
            /* $respond = Adnsms::send_bulk($message, $phone); */
            
            $this->load->library('sms/Bulksms');
            $respond = Bulksms::send_bulk($message, $phone);
            
            $this->save_bulk_sms_log_in_db($message,$respond);
                                
            $this->session->set_flashdata('message', '<p class="ajax_success">SMS Added Successfully</p>');
            redirect(site_url( Backend_URL. 'sms'));
        }
    }  
    
    private function save_bulk_sms_log_in_db($sms_body,$respond){
        $this->db->select('id,contact');
        $this->db->where('status','Active');
        //$this->db->where_in('id',[57,97]);        
        $donors = $this->db->get('donors')->result();
        $data = [];
        foreach($donors as $donor){
            if(mb_strlen($donor->contact) == 11){
                $data[] = [
                    'donor_id'  => $donor->id,
                    'phone'     => $donor->contact,
                    'body'      => $sms_body,
                    'respond'   => $respond,
                    'timestamp' => date('Y-m-d H:i:s'),
                ];
            }            
        }        
        $this->db->insert_batch('sms_log',$data);
    }
        
    public function _menu(){        
        return buildMenuForModule([
            'module'    => 'SMS',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'sms',                    
            'children'  => [
                [
                    'title' => 'Graph Log',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'sms/report'
                ],[
                    'title' => 'SMS Sent Log',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'sms'
                ],[
                    'title' => ' Send New SMS',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'sms/write'
                ],[
                    'title' => 'SMS Template',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'sms/template'
                ]
            ]        
        ]);
    }

    public function _rules(){
//	$this->form_validation->set_rules('donor_id', 'donor id', 'trim|required|numeric');
//	$this->form_validation->set_rules('phone', 'phone', 'trim');
	$this->form_validation->set_rules('body', 'body', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function delete(){
        ajaxAuthorized();
        if($this->user_id == 1 && $this->role_id == 1){            
            $id = $this->input->post('id');
            $this->db->where('id',$id);
            $this->db->delete('sms_log');             
            echo ajaxRespond('OK','Deleted');
        }        
    }
    
    public function refresh_qty(){
        ajaxAuthorized();
        $batch = [];
        $this->db->select('id,body,type');
        // $this->db->where('type', null)->or_where('qty', null);
        $this->db->where('DATE_FORMAT(timestamp, "%Y-%m") >=', '2025-01');

        $smss = $this->db->get('sms_log')->result();
        foreach ($smss as $sms){
            $batch[] = [
                'id'   => $sms->id,
                'type' => isUnicode($sms->body),
                'qty'  => smsQTY($sms->body )
            ];                                       
        }

        if($batch){
            $this->db->update_batch('sms_log', $batch,'id');
            echo '<p class="ajax_success">Counting Update</p>';
        } else {
            echo '<p class="ajax_success">Noting to Update. It\'s already up-to date.</p>';
        }
    }
}