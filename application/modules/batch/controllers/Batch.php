<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 13th May 2026 01:39pm
 */

class Batch extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Batch_model');
        $this->load->helper('batch');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'batch', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'batch', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Batch_model->total_rows($q);
        $batchs = $this->Batch_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'batchs' => $batchs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        ];
        $this->viewAdminContent('batch/batch/index', $data);
    }

    public function details($id){
        $batch = $this->Batch_model->get_by_id($id);
        if ($batch) {
            $data = [
                'id' => $batch->id,
                'name' => $batch->name,
                'seat' => $batch->seat,
                'date_start' => date('Y-m-d', strtotime($batch->date_start)),
                'date_end' => date('Y-m-d', strtotime($batch->date_end)),
                'status' => $batch->status,
                'remarks' => $batch->remarks,
                'created_at' => $batch->created_at,
            ];
            $this->viewAdminContent('batch/batch/details', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Batch Not Found</p>');
            redirect(site_url( Backend_URL. 'batch'));
        }
    }

    public function create(){
        $data = [
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'batch/create_action'),
            'name' => set_value('name'),
            'seat' => set_value('seat'),
            'date_start' => set_value('date_start'),
            'date_end' => set_value('date_end'),
            'status' => 'Upcoming',
            'remarks' => set_value('remarks'),
        ];
        $this->viewAdminContent('batch/batch/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'name' => $this->input->post('name',TRUE),
                'seat' => $this->input->post('seat',TRUE),
                'date_start' => $this->input->post('date_start',TRUE),
                'date_end' => $this->input->post('date_end',TRUE),
                'status' => $this->input->post('status',TRUE),
                'remarks' => $this->input->post('remarks',TRUE),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->Batch_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Batch Added Successfully</p>');
            redirect(site_url( Backend_URL. 'batch'));
        }
    }
    
    public function update($id){
        $batch = $this->Batch_model->get_by_id($id);

        if ($batch) {
            $data = [
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'batch/update_action'),
                'id' => set_value('id', $batch->id),
                'name' => set_value('name', $batch->name),
                'seat' => set_value('seat', $batch->seat),
                'date_start' => set_value('date_start', date('Y-m-d', strtotime($batch->date_start))),
                'date_end' => set_value('date_end', date('Y-m-d', strtotime($batch->date_end))),
                'status' => set_value('status', $batch->status),
                'remarks' => set_value('remarks', $batch->remarks),
            ];
            $this->viewAdminContent('batch/batch/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Batch Not Found</p>');
            redirect(site_url( Backend_URL. 'batch'));
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
                'seat' => $this->input->post('seat',TRUE),
                'date_start' => $this->input->post('date_start',TRUE),
                'date_end' => $this->input->post('date_end',TRUE),
                'status' => $this->input->post('status',TRUE),
                'remarks' => $this->input->post('remarks',TRUE),
            ];

            $this->Batch_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Batch Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'batch/update/'. $id ));
        }
    }

    public function delete($id){
        $batch = $this->Batch_model->get_by_id($id);
        if ($batch) {
            $data = [
                'id' => $batch->id,
                'name' => $batch->name,
                'seat' => $batch->seat,
                'date_start' => date('Y-m-d', strtotime($batch->date_start)),
                'date_end' => date('Y-m-d', strtotime($batch->date_end)),
                'status' => $batch->status,
                'remarks' => $batch->remarks,
                'created_at' => $batch->created_at,
            ];
            $this->viewAdminContent('batch/batch/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Batch Not Found</p>');
            redirect(site_url( Backend_URL. 'batch'));
        }
    }


    public function delete_action($id){
        $batch = $this->Batch_model->get_by_id($id);

        if ($batch) {
            $this->Batch_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Batch Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'batch'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Batch Not Found</p>');
            redirect(site_url( Backend_URL. 'batch'));
        }
    }
    

    public function _rules(){
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('date_start', 'date start', 'trim|required');
		$this->form_validation->set_rules('date_end', 'date end', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('seat', 'seat', 'trim|required|integer');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}