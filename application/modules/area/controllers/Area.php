<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2018-08-22
 */

class Area extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Area_model');
        $this->load->helper('service_areas');
        $this->load->library('form_validation');
    }

    public function index() {
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = Backend_URL . 'area/?q=' . urlencode($q);
            $config['first_url'] = Backend_URL . 'area/?q=' . urlencode($q);
        } else {
            $config['base_url'] = Backend_URL . 'area/';
            $config['first_url'] = Backend_URL . 'area/';
        }
        
        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Area_model->total_rows($q);
        $areas = $this->Area_model->get_limit_data($config['per_page'], $start, $q);
        
//        dd( $areas );

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'areas' => $areas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'total' => 0,
        );
        $this->viewAdminContent('area/area/index', $data);
    }

    
    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url(Backend_URL . 'area/create_action'),
            'id' => set_value('id'),
            'en_name' => set_value('en_name'),
            'bn_name' => set_value('bn_name'),
        );
        $this->viewAdminContent('area/area/create', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'en_name' => $this->input->post('en_name', TRUE),
                'bn_name' => $this->input->post('bn_name', TRUE),
            );

            $this->Area_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Area Added Successfully</p>');
            redirect(site_url(Backend_URL . 'area'));
        }
    }

    public function update($id) {
        $row = $this->Area_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url(Backend_URL . 'area/update_action'),
                'id' => set_value('id', $row->id),
                'en_name' => set_value('en_name', $row->en_name),
                'bn_name' => set_value('bn_name', $row->bn_name),
            );
            $this->viewAdminContent('area/area/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Area Not Found</p>');
            redirect(site_url(Backend_URL . 'area'));
        }
    }

    public function update_action() {
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($id);
        } else {
            $data = array(
                'en_name' => $this->input->post('en_name', TRUE),
                'bn_name' => $this->input->post('bn_name', TRUE),
            );

            $this->Area_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Area Updated Successlly</p>');
            redirect(site_url(Backend_URL . 'area/update/' . $id));
        }
    }

    

    public function delete($id) {
        $row = $this->Area_model->get_by_id($id);

        if ($row) {
            $this->Area_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Area Deleted Successfully</p>');
            redirect(site_url(Backend_URL . 'area'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Area Not Found</p>');
            redirect(site_url(Backend_URL . 'area'));
        }
    }

    public function _menu(){
        return add_main_menu('Area', 'area', 'area', 'fa-hand-o-right');
    }

    public function _rules() {
        $this->form_validation->set_rules('en_name', 'en name', 'trim|required');
        $this->form_validation->set_rules('bn_name', 'bn name', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
