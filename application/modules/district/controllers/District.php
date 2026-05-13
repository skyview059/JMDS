<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 13th May 2026 02:14pm
 */

class District extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('District_model');
        $this->load->helper('district');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'district', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'district', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->District_model->total_rows($q);
        $districts = $this->District_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'districts' => $districts,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        ];
        $this->viewAdminContent('district/district/index', $data);
    }

    public function details($id){
        $district = $this->District_model->get_by_id($id);
        if ($district) {
            $data = [
				'id' => $district->id,
				'name' => $district->name,
				'bn_name' => $district->bn_name,
				'lat' => $district->lat,
				'lon' => $district->lon,
		    ];
            $this->viewAdminContent('district/district/details', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">District Not Found</p>');
            redirect(site_url( Backend_URL. 'district'));
        }
    }

    public function create(){
        $data = [
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'district/create_action'),
			'id' => set_value('id'),
			'name' => set_value('name'),
			'bn_name' => set_value('bn_name'),
			'lat' => set_value('lat'),
			'lon' => set_value('lon'),
			];
        $this->viewAdminContent('district/district/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
				'name' => $this->input->post('name',TRUE),
				'bn_name' => $this->input->post('bn_name',TRUE),
				'lat' => $this->input->post('lat',TRUE),
				'lon' => $this->input->post('lon',TRUE),
			    ];

            $this->District_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">District Added Successfully</p>');
            redirect(site_url( Backend_URL. 'district'));
        }
    }
    
    public function update($id){
        $district = $this->District_model->get_by_id($id);

        if ($district) {
            $data = [
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'district/update_action'),
				'id' => set_value('id', $district->id),
				'name' => set_value('name', $district->name),
				'bn_name' => set_value('bn_name', $district->bn_name),
				'lat' => set_value('lat', $district->lat),
				'lon' => set_value('lon', $district->lon),
		    ];
            $this->viewAdminContent('district/district/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">District Not Found</p>');
            redirect(site_url( Backend_URL. 'district'));
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
				'bn_name' => $this->input->post('bn_name',TRUE),
				'lat' => $this->input->post('lat',TRUE),
				'lon' => $this->input->post('lon',TRUE),
		    ];

            $this->District_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">District Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'district/update/'. $id ));
        }
    }

    public function delete($id){
        $district = $this->District_model->get_by_id($id);
        if ($district) {
            $data = [
				'id' => $district->id,
				'name' => $district->name,
				'bn_name' => $district->bn_name,
				'lat' => $district->lat,
				'lon' => $district->lon,
		    ];
            $this->viewAdminContent('district/district/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">District Not Found</p>');
            redirect(site_url( Backend_URL. 'district'));
        }
    }


    public function delete_action($id){
        $district = $this->District_model->get_by_id($id);

        if ($district) {
            $this->District_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">District Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'district'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">District Not Found</p>');
            redirect(site_url( Backend_URL. 'district'));
        }
    }
    

    public function _rules(){
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('bn_name', 'bn name', 'trim|required');
		$this->form_validation->set_rules('lat', 'lat', 'trim|required');
		$this->form_validation->set_rules('lon', 'lon', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}