<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 13th May 2026 01:56pm
 */

class Transaction extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Transaction_model');
        $this->load->helper('transaction');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'transaction', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'transaction', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transaction_model->total_rows($q);
        $transactions = $this->Transaction_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'transactions' => $transactions,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        ];
        $this->viewAdminContent('transaction/transaction/index', $data);
    }

    public function details($id){
        $transaction = $this->Transaction_model->get_by_id($id);
        if ($transaction) {
            $data = [
				'id' => $transaction->id,
				'user_id' => $transaction->user_id,
				'tx_date' => $transaction->tx_date,
				'nature' => $transaction->nature,
				'head_id' => $transaction->head_id,
				'subhead_id' => $transaction->subhead_id,
				'amount' => $transaction->amount,
				'remark' => $transaction->remark,
				'batch_id' => $transaction->batch_id,
				'vehicle_id' => $transaction->vehicle_id,
				'tx_status' => $transaction->tx_status,
				'created_at' => $transaction->created_at,
				'updated_at' => $transaction->updated_at,
		    ];
            $this->viewAdminContent('transaction/transaction/details', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Transaction Not Found</p>');
            redirect(site_url( Backend_URL. 'transaction'));
        }
    }

    public function create(){
        $data = [
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'transaction/create_action'),
			'id' => set_value('id'),
			'user_id' => set_value('user_id'),
			'tx_date' => set_value('tx_date'),
			'nature' => set_value('nature'),
			'head_id' => set_value('head_id'),
			'subhead_id' => set_value('subhead_id'),
			'amount' => set_value('amount'),
			'remark' => set_value('remark'),
			'batch_id' => set_value('batch_id'),
			'vehicle_id' => set_value('vehicle_id'),
			'tx_status' => set_value('tx_status'),
			'created_at' => set_value('created_at'),
			'updated_at' => set_value('updated_at'),
			];
        $this->viewAdminContent('transaction/transaction/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
				'user_id' => $this->input->post('user_id',TRUE),
				'tx_date' => $this->input->post('tx_date',TRUE),
				'nature' => $this->input->post('nature',TRUE),
				'head_id' => $this->input->post('head_id',TRUE),
				'subhead_id' => $this->input->post('subhead_id',TRUE),
				'amount' => $this->input->post('amount',TRUE),
				'remark' => $this->input->post('remark',TRUE),
				'batch_id' => $this->input->post('batch_id',TRUE),
				'vehicle_id' => $this->input->post('vehicle_id',TRUE),
				'tx_status' => $this->input->post('tx_status',TRUE),
				'created_at' => $this->input->post('created_at',TRUE),
				'updated_at' => $this->input->post('updated_at',TRUE),
			    ];

            $this->Transaction_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Transaction Added Successfully</p>');
            redirect(site_url( Backend_URL. 'transaction'));
        }
    }
    
    public function update($id){
        $transaction = $this->Transaction_model->get_by_id($id);

        if ($transaction) {
            $data = [
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'transaction/update_action'),
				'id' => set_value('id', $transaction->id),
				'user_id' => set_value('user_id', $transaction->user_id),
				'tx_date' => set_value('tx_date', $transaction->tx_date),
				'nature' => set_value('nature', $transaction->nature),
				'head_id' => set_value('head_id', $transaction->head_id),
				'subhead_id' => set_value('subhead_id', $transaction->subhead_id),
				'amount' => set_value('amount', $transaction->amount),
				'remark' => set_value('remark', $transaction->remark),
				'batch_id' => set_value('batch_id', $transaction->batch_id),
				'vehicle_id' => set_value('vehicle_id', $transaction->vehicle_id),
				'tx_status' => set_value('tx_status', $transaction->tx_status),
				'created_at' => set_value('created_at', $transaction->created_at),
				'updated_at' => set_value('updated_at', $transaction->updated_at),
		    ];
            $this->viewAdminContent('transaction/transaction/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Transaction Not Found</p>');
            redirect(site_url( Backend_URL. 'transaction'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = [
				'user_id' => $this->input->post('user_id',TRUE),
				'tx_date' => $this->input->post('tx_date',TRUE),
				'nature' => $this->input->post('nature',TRUE),
				'head_id' => $this->input->post('head_id',TRUE),
				'subhead_id' => $this->input->post('subhead_id',TRUE),
				'amount' => $this->input->post('amount',TRUE),
				'remark' => $this->input->post('remark',TRUE),
				'batch_id' => $this->input->post('batch_id',TRUE),
				'vehicle_id' => $this->input->post('vehicle_id',TRUE),
				'tx_status' => $this->input->post('tx_status',TRUE),
				'created_at' => $this->input->post('created_at',TRUE),
				'updated_at' => $this->input->post('updated_at',TRUE),
		    ];

            $this->Transaction_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Transaction Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'transaction/update/'. $id ));
        }
    }

    public function delete($id){
        $transaction = $this->Transaction_model->get_by_id($id);
        if ($transaction) {
            $data = [
				'id' => $transaction->id,
				'user_id' => $transaction->user_id,
				'tx_date' => $transaction->tx_date,
				'nature' => $transaction->nature,
				'head_id' => $transaction->head_id,
				'subhead_id' => $transaction->subhead_id,
				'amount' => $transaction->amount,
				'remark' => $transaction->remark,
				'batch_id' => $transaction->batch_id,
				'vehicle_id' => $transaction->vehicle_id,
				'tx_status' => $transaction->tx_status,
				'created_at' => $transaction->created_at,
				'updated_at' => $transaction->updated_at,
		    ];
            $this->viewAdminContent('transaction/transaction/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Transaction Not Found</p>');
            redirect(site_url( Backend_URL. 'transaction'));
        }
    }


    public function delete_action($id){
        $transaction = $this->Transaction_model->get_by_id($id);

        if ($transaction) {
            $this->Transaction_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Transaction Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'transaction'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Transaction Not Found</p>');
            redirect(site_url( Backend_URL. 'transaction'));
        }
    }
    

    public function _rules(){
		$this->form_validation->set_rules('user_id', 'user id', 'trim|required|numeric');
		$this->form_validation->set_rules('tx_date', 'tx date', 'trim|required');
		$this->form_validation->set_rules('nature', 'nature', 'trim|required');
		$this->form_validation->set_rules('head_id', 'head id', 'trim|required|numeric');
		$this->form_validation->set_rules('subhead_id', 'subhead id', 'trim|required|numeric');
		$this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric');
		$this->form_validation->set_rules('remark', 'remark', 'trim|required');
		$this->form_validation->set_rules('batch_id', 'batch id', 'trim|required|numeric');
		$this->form_validation->set_rules('vehicle_id', 'vehicle id', 'trim|required|numeric');
		$this->form_validation->set_rules('tx_status', 'tx status', 'trim|required');
		$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
		$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}