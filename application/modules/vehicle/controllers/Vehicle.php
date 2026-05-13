<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 13th May 2026 02:00pm
 */

class Vehicle extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Vehicle_model');
        $this->load->helper('vehicle');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'vehicle', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'vehicle', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Vehicle_model->total_rows($q);
        $vehicles = $this->Vehicle_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'vehicles' => $vehicles,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        ];
        $this->viewAdminContent('vehicle/vehicle/index', $data);
    }

    public function details($id){
        $vehicle = $this->Vehicle_model->get_by_id($id);
        if ($vehicle) {
            $data = [
				'id' => $vehicle->id,
                'name' => $vehicle->name,
				'photo' => $vehicle->photo,
				'number' => $vehicle->number,
				'purchased_date' => $vehicle->purchased_date,
				'amount' => $vehicle->amount,
				'remark' => $vehicle->remark,
		    ];
            $this->viewAdminContent('vehicle/vehicle/details', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Vehicle Not Found</p>');
            redirect(site_url( Backend_URL. 'vehicle'));
        }
    }

    public function create(){
        $data = [
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'vehicle/create_action'),
			'id' => set_value('id'),
            'name' => set_value('name'),
			'photo' => set_value('photo'),
			'number' => set_value('number'),
			'purchased_date' => set_value('purchased_date'),
			'amount' => set_value('amount'),
			'remark' => set_value('remark'),
			];
        $this->viewAdminContent('vehicle/vehicle/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'name' => $this->input->post('name',TRUE),
				'photo' => $this->input->post('photo',TRUE),
				'number' => $this->input->post('number',TRUE),
				'purchased_date' => $this->input->post('purchased_date',TRUE) ? $this->input->post('purchased_date',TRUE) : null,
				'amount' => $this->input->post('amount',TRUE) ? $this->input->post('amount',TRUE) : null,
				'remark' => $this->input->post('remark',TRUE),
			    ];

            $this->Vehicle_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Vehicle Added Successfully</p>');
            redirect(site_url( Backend_URL. 'vehicle'));
        }
    }
    
    public function update($id){
        $vehicle = $this->Vehicle_model->get_by_id($id);

        if ($vehicle) {
            $data = [
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'vehicle/update_action'),
				'id' => set_value('id', $vehicle->id),
                'name' => set_value('name', $vehicle->name),
				'photo' => set_value('photo', $vehicle->photo),
				'number' => set_value('number', $vehicle->number),
				'purchased_date' => set_value('purchased_date', $vehicle->purchased_date),
				'amount' => set_value('amount', $vehicle->amount),
				'remark' => set_value('remark', $vehicle->remark),
		    ];
            $this->viewAdminContent('vehicle/vehicle/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Vehicle Not Found</p>');
            redirect(site_url( Backend_URL. 'vehicle'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = [
				'name' => $this->input->post('name',TRUE),
				'photo' => $this->input->post('photo',TRUE),
				'number' => $this->input->post('number',TRUE),
				'purchased_date' => $this->input->post('purchased_date',TRUE) ? $this->input->post('purchased_date',TRUE) : null,
				'amount' => $this->input->post('amount',TRUE) ? $this->input->post('amount',TRUE) : null,
				'remark' => $this->input->post('remark',TRUE),
		    ];

            $this->Vehicle_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Vehicle Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'vehicle/update/'. $id ));
        }
    }

    public function delete($id){
        $vehicle = $this->Vehicle_model->get_by_id($id);
        if ($vehicle) {
            $data = [
				'id' => $vehicle->id,
                'name' => $vehicle->name,
				'photo' => $vehicle->photo,
				'number' => $vehicle->number,
				'purchased_date' => $vehicle->purchased_date,
				'amount' => $vehicle->amount,
				'remark' => $vehicle->remark,
		    ];
            $this->viewAdminContent('vehicle/vehicle/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Vehicle Not Found</p>');
            redirect(site_url( Backend_URL. 'vehicle'));
        }
    }


    public function delete_action($id){
        $vehicle = $this->Vehicle_model->get_by_id($id);

        if ($vehicle) {
            $this->Vehicle_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Vehicle Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'vehicle'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Vehicle Not Found</p>');
            redirect(site_url( Backend_URL. 'vehicle'));
        }
    }
    

    public function _rules(){
        $this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('number', 'number', 'trim|required');
		$this->form_validation->set_rules('purchased_date', 'purchased date', 'trim');
		$this->form_validation->set_rules('amount', 'amount', 'trim|numeric');
		$this->form_validation->set_rules('remark', 'remark', 'trim');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}