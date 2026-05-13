<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2019-08-22
 */

class Trans extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Trans_model');
        $this->load->helper('trans');
        $this->load->library('form_validation');
    }

    public function index(){
        $month      = urldecode_fk($this->input->get('month', TRUE));        
        $head_id    = (int)$this->input->get('head_id');
        $area_id    = (int)$this->input->get('area_id');
        $collectBy  = (int) $this->input->get('collectBy');
        $year       = (int) $this->input->get('year');        
        $q          = urldecode_fk($this->input->get('q', TRUE));
        $start      = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'trans/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'trans/', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Trans_model->total_rows($collectBy,$area_id,$month,$head_id,$year,$q);
        $transs = $this->Trans_model->get_limit_data($config['per_page'], $start, $collectBy,$area_id,$month,$head_id,$year,$q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transs' => $transs,
            'collectBy' => $collectBy,
            'area_id' => $area_id,
            'month' => $month,
            'year' => $year,
            'min_year' => date('Y', strtotime('-2 Year')),
            'max_year' => date('Y', strtotime('+1 Year')),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'head_id' => $head_id,
        );
        $this->viewAdminContent('trans/trans/index', $data);
    }

   
    public function entry(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'trans/entry_action'),
	    'id' => set_value('id'),
	    'donor_id' => set_value('donor_id'),
	    'month' => set_value('month', date('Y-m-1')),
	    'remark' => set_value('remark'),
	    'paid' => set_value('paid'),
	    'personal' => set_value('personal'),
	    'head_id' => set_value('head_id', 1),
	    'paid_date' => set_value('paid_date', date('Y-m-d')),
	    'collected_by' => set_value('user_id', $this->user_id),
	);
        $this->viewAdminContent('trans/trans/create', $data);
    }
    
    public function entry_action(){
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->entry();
        } else {
            $data = array(
		'donor_id'      => (int) $this->input->post('donor_id',TRUE),
		'head_id'   => (int) $this->input->post('head_id',TRUE),
		'donate_type'   => 'General',
		'month'         => $this->input->post('month',TRUE),
		'remark'        => $this->input->post('remark',TRUE),
		'paid'          => $this->input->post('paid',TRUE),
		'paid_date'     => $this->input->post('paid_date',TRUE),
		'timestamp'     => date('Y-m-d H:i:s'),
		'collected_by'  => (int) $this->input->post('user_id',TRUE),
	    );
            $this->Trans_model->insert($data);
                        
            $paid       = (int) $this->input->post('paid');
            $personal   = (int) $this->input->post('personal');
            if($personal){
                $data['donate_type'] = 'Personal';
                $data['paid'] = $personal;
                $this->Trans_model->insert($data);
            }
            
            $send_sms = ($this->input->post('send_sms') == 'Yes') ? true : false;
            
            if($send_sms){  
                $donor_id = $data['donor_id'];
                $this->load->helper('sms/template');
                $this->load->library('sms/Bulksms'); /* Adnsms or Bulksms*/
                $received_tk    =  $paid + $personal;
                $sms_template   = getSmsTemplate( 2 );
                $sms_body       = str_replace('{tk}', $received_tk, $sms_template);
                $mobile         = getDonorMobile( $donor_id );  
                $respond        = "SMS Not Sent. Invalid Mobile Number - {$mobile}";
                if(mb_strlen( $mobile ) == 11 ){
                    /* $respond        = Adnsms::send_single($sms_body, $mobile); */
                    $respond        = Bulksms::send_single($sms_body, $mobile);
                }                
                save_sms_log_in_db($donor_id,$mobile,$sms_body,$respond);
            }           
            
            $this->session->set_flashdata('message', '<p class="ajax_success">Trans Added Successfully</p>');
            redirect(site_url( Backend_URL. 'trans/entry'));
        }
    }
    
    public function void( $id ){
        // $this->db->set('status','Void');
        // $this->db->where('id', $id );
        // $this->db->update('donations');
        $this->session->set_flashdata('message', '<p class="ajax_success">Trans Added Successfully</p>');
        redirect(site_url( Backend_URL. 'trans'));       
    }
    

    public function _menu(){
        $menu = add_main_menu('Donation Log', 'trans', 'trans', 'fa-usd');        
        $menu .= add_main_menu('Donation Heads', 'trans/head', 'trans', 'fa-usd');        
        return $menu;
    }

    public function _rules(){
	$this->form_validation->set_rules('donor_id', 'donor id', 'trim|required|is_natural_no_zero', [
            'is_natural_no_zero' => 'Please Select Donor'
        ]);
	$this->form_validation->set_rules('head_id', 'Head', 'trim|required|is_natural_no_zero', [
            'is_natural_no_zero' => 'Please Select Head'
        ]);
	$this->form_validation->set_rules('month', 'month', 'trim|required');
	$this->form_validation->set_rules('remark', 'remark', 'trim');
	$this->form_validation->set_rules('paid', 'paid', 'trim|required|numeric');
	$this->form_validation->set_rules('paid_date', 'paid date', 'trim|required');
	//$this->form_validation->set_rules('user_id', 'collected by', 'trim|required|numeric');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}