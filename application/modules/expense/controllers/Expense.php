<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2019-08-23
 * Update : 13th Oct 2019
 */

class Expense extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Expense_model');
        $this->load->helper('expense');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $collectBy = urldecode_fk($this->input->get('collectBy', TRUE));
        $area_id = urldecode_fk($this->input->get('area', TRUE));
        $month = urldecode_fk($this->input->get('month', TRUE));
        $year = urldecode_fk($this->input->get('year', TRUE));
        
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'expense/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'expense/', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Expense_model->total_rows($q,$collectBy,$area_id,$month,$year);
        $expenses = $this->Expense_model->get_limit_data($config['per_page'], $start, $q,$collectBy,$area_id,$month,$year);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'expenses' => $expenses,
            'collectBy' => $collectBy,
            'month' => $month,
            'year' => $year,
            'min_year' => date('Y', strtotime('-2 Year')),
            'max_year' => date('Y', strtotime('+1 Year')),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('expense/expense/index', $data);
    }

    public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'expense/create_action'),
	    'id' => set_value('id'),
	    'trans_date' => set_value('trans_date'),
	    'head_id' => set_value('head_id'),
	    'sub_head_id' => set_value('sub_head_id'),
	    'remark' => set_value('remark'),
	    'amount' => set_value('amount'),
	    'user_id' => set_value('user_id', $this->user_id ),
	);
        $this->viewAdminContent('expense/expense/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'trans_date'    => $this->input->post('trans_date',TRUE),
		'head_id'       => $this->input->post('head_id',TRUE),
		'sub_head_id'   => $this->input->post('sub_head_id',TRUE),
		'remark'        => $this->input->post('remark',TRUE),
		'amount'        => $this->input->post('amount',TRUE),
		'timestamp'     => date('Y-m-d H:i:s'),
		'user_id'       => getLoginUserData('user_id'),//$this->input->post('user_id',TRUE),
		'status'        => 'OK',
	    );

            $this->Expense_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Expense Added Successfully</p>');
            redirect(site_url( Backend_URL. 'expense'));
        }
    }
    
    public function void($id){
        
        $this->db->set('status','Void');
        $this->db->where('id', $id );
        $this->db->update('expenses');
        $this->session->set_flashdata('message', '<p class="ajax_success">Expense Void</p>');
        redirect(site_url( Backend_URL. 'expense'));        
    }
    

    public function _menu(){
        // return add_main_menu('Expense', 'expense', 'expense', 'fa-hand-o-right');
        return buildMenuForModule([
            'module'    => 'Expense',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'expense',                    
            'children'  => [
                [
                    'title' => 'Expense Log',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'expense'
                ],[
                    'title' => ' |_ Add New',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'expense/create'
                ],[
                    'title' => 'Income Expense Report',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'expense/report'
                ],[
                    'title' => 'Manage Head',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'expense/head'
                ]
            ]        
        ]);
    }

    public function _rules(){
	$this->form_validation->set_rules('trans_date', 'trans date', 'trim|required');
	$this->form_validation->set_rules('head_id', 'head id', 'trim|required|numeric');
	$this->form_validation->set_rules('sub_head_id', 'sub head id', 'trim|required|numeric');
	$this->form_validation->set_rules('remark', 'remark', 'trim');
	$this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}