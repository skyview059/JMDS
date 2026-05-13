<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 23 Aug 2019 @10:08 am
 */

class Head extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Head_model');
        $this->load->helper('head');
        $this->load->library('form_validation');
    }

    public function index() {
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));


        $config['base_url'] = build_pagination_url(Backend_URL . 'expense/head/', 'start');
        $config['first_url'] = build_pagination_url(Backend_URL . 'expense/head/', 'start');


        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Head_model->total_rows($q);
        $heads = $this->Head_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'heads' => $heads,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('expense/head/index', $data);
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url(Backend_URL . 'expense/head/create_action'),
            'id' => set_value('id'),
            'type' => set_value('type'),
            'name' => set_value('name'),
            'status' => set_value('status'),
        );
        $this->viewAdminContent('expense/head/create', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'type' => $this->input->post('type', TRUE),
                'name' => $this->input->post('name', TRUE),
                'status' => 'Active',
            );

            $this->Head_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Head Added Successfully</p>');
            redirect(site_url(Backend_URL . 'expense/head'));
        }
    }

    public function update($id) {
        $row = $this->Head_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url(Backend_URL . 'expense/head/update_action'),
                'id' => set_value('id', $row->id),
                'type' => set_value('type', $row->type),
                'name' => set_value('name', $row->name),
                'status' => set_value('status', $row->status),
            );
            $this->viewAdminContent('expense/head/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Head Not Found</p>');
            redirect(site_url(Backend_URL . 'expense/head'));
        }
    }

    public function update_action() {
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($id);
        } else {
            $data = array(
                'type' => $this->input->post('type', TRUE),
                'name' => $this->input->post('name', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Head_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Head Updated Successlly</p>');
            redirect(site_url(Backend_URL . 'expense/head/'));
        }
    }

    public function delete($id) {
        $row = $this->Head_model->get_by_id($id);

        if ($row) {
            $this->Head_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Head Deleted Successfully</p>');
            redirect(site_url(Backend_URL . 'expense/head'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Head Not Found</p>');
            redirect(site_url(Backend_URL . 'expense/head'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
