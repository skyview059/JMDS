<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 06 Jun 2026 @09:37 am
 */

class Head extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Head_model');
        $this->load->helper('head');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'transaction/head/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'transaction/head/', 'start');
        

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Head_model->total_rows($q);
        $heads = $this->Head_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'heads' => $heads,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        ];
        $this->viewAdminContent('transaction/head/index', $data);
    }

public function create(){
        $data = [
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'transaction/head/create_action'),
	    'id' => set_value('id'),
	    'type' => set_value('type'),
	    'name' => set_value('name'),
	    'status' => set_value('status'),
	];
        $this->viewAdminContent('transaction/head/create', $data);
    }    


    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
		'type' => $this->input->post('type',TRUE),
		'name' => $this->input->post('name',TRUE),
		'status' => $this->input->post('status',TRUE),
	    ];

            $this->Head_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Head Added Successfully</p>');
            redirect(site_url( Backend_URL. 'transaction/head'));
        }
    }
    
    public function update($id){
        $head = $this->Head_model->get_by_id($id);

        if ($head) {
            $data = [
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'transaction/head/update_action'),
		'id' => set_value('id', $head->id),
		'type' => set_value('type', $head->type),
		'name' => set_value('name', $head->name),
		'status' => set_value('status', $head->status),
	    ];
            $this->viewAdminContent('transaction/head/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Head Not Found</p>');
            redirect(site_url( Backend_URL. 'transaction/head'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = [
		'type' => $this->input->post('type',TRUE),
		'name' => $this->input->post('name',TRUE),
		'status' => $this->input->post('status',TRUE),
	    ];

            $this->Head_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Head Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'transaction/head/'));
        }
    }public function delete($id){
        $head = $this->Head_model->get_by_id($id);

        if ($head) {
            $this->Head_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Head Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'transaction/head'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Head Not Found</p>');
            redirect(site_url( Backend_URL. 'transaction/head'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('type', 'type', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}