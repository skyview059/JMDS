<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 25 Aug 2019 @08:36 pm
 */

class Template extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Template_model');
        $this->load->helper('template');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'sms/template/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'sms/template/', 'start');
        

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Template_model->total_rows($q);
        $templates = $this->Template_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'templates' => $templates,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('sms/template/index', $data);
    }

public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'sms/template/create_action'),
	    'id' => set_value('id'),
	    'title' => set_value('title'),
	    'body' => set_value('body'),
	);
        $this->viewAdminContent('sms/template/create', $data);
    }    


    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'body' => $this->input->post('body',TRUE),
	    );

            $this->Template_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Template Added Successfully</p>');
            redirect(site_url( Backend_URL. 'sms/template'));
        }
    }
    
    public function update($id){
        $row = $this->Template_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'sms/template/update_action'),
		'id' => set_value('id', $row->id),
		'title' => set_value('title', $row->title),
		'body' => set_value('body', $row->body),
	    );
            $this->viewAdminContent('sms/template/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Template Not Found</p>');
            redirect(site_url( Backend_URL. 'sms/template'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'body' => $this->input->post('body',TRUE),
	    );

            $this->Template_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Template Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'sms/template/'));
        }
    }public function delete($id){
        $row = $this->Template_model->get_by_id($id);

        if ($row) {
            $this->Template_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Template Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'sms/template'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Template Not Found</p>');
            redirect(site_url( Backend_URL. 'sms/template'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('body', 'body', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}