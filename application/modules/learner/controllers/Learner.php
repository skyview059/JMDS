<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 13th May 2026 12:26pm
 */

class Learner extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Learner_model');
        $this->load->model('batch/Batch_model');
        $this->load->model('district/District_model');
        $this->load->helper('learner');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode_fk($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'learner', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'learner', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Learner_model->total_rows($q);
        $learners = $this->Learner_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = [
            'learners' => $learners,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        ];
        $this->viewAdminContent('learner/learner/index', $data);
    }

    public function details($id){
        $learner = $this->Learner_model->get_by_id($id);
        if ($learner) {
            $data = [
				'id' => $learner->id,
				'batch_id' => $learner->batch_id,
				'name' => $learner->name,
				'dob' => $learner->dob,
				'nid' => $learner->nid,
				'father' => $learner->father,
				'mother' => $learner->mother,
				'district_id' => $learner->district_id,
				'primary_mobile' => $learner->primary_mobile,
				'blood_group' => $learner->blood_group,
				'second_contact_person' => $learner->second_contact_person,
				'second_contact_mobile' => $learner->second_contact_mobile,
				'is_resident' => $learner->is_resident,
				'photo' => $learner->photo,
				'remarks' => $learner->remarks,
				'created_at' => $learner->created_at,
				'updated_at' => $learner->updated_at,
		    ];
            $this->viewAdminContent('learner/learner/details', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Learner Not Found</p>');
            redirect(site_url( Backend_URL. 'learner'));
        }
    }

    public function create(){
        $batches = $this->Batch_model->get_all();
        $batch_list = array('' => '-- Select Batch --');
        foreach($batches as $batch) {
            $batch_list[$batch->id] = $batch->name . ' (ID: ' . $batch->id . ')';
        }
        
        $districts = $this->District_model->get_all();
        $district_list = array('' => '-- Select District --');
        foreach($districts as $district) {
            $district_list[$district->id] = $district->bn_name . ' (ID: ' . $district->id . ')';
        }
        
        $data = [
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'learner/create_action'),
			'id' => set_value('id'),
			'batch_id' => set_value('batch_id'),
			'batch_list' => $batch_list,
			'name' => set_value('name'),
			'dob' => set_value('dob'),
			'nid' => set_value('nid'),
			'father' => set_value('father'),
			'mother' => set_value('mother'),
			'district_id' => set_value('district_id'),
			'district_list' => $district_list,
			'primary_mobile' => set_value('primary_mobile'),
			'blood_group' => set_value('blood_group'),
			'second_contact_person' => set_value('second_contact_person'),
			'second_contact_mobile' => set_value('second_contact_mobile'),
			'is_resident' => set_value('is_resident', 'No'),
			'photo' => set_value('photo'),
			'remarks' => set_value('remarks'),
			];
        $this->viewAdminContent('learner/learner/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
				'batch_id' => $this->input->post('batch_id',TRUE),
				'name' => $this->input->post('name',TRUE),
				'dob' => $this->input->post('dob',TRUE),
				'nid' => $this->input->post('nid',TRUE) ? $this->input->post('nid',TRUE) : null,
				'father' => $this->input->post('father',TRUE),
				'mother' => $this->input->post('mother',TRUE),
				'district_id' => $this->input->post('district_id',TRUE),
				'primary_mobile' => $this->input->post('primary_mobile',TRUE),
				'blood_group' => $this->input->post('blood_group',TRUE),
				'second_contact_person' => $this->input->post('second_contact_person',TRUE),
				'second_contact_mobile' => $this->input->post('second_contact_mobile',TRUE),
				'is_resident' => $this->input->post('is_resident',TRUE),
				'photo' => $this->input->post('photo',TRUE),
				'remarks' => $this->input->post('remarks',TRUE),
			    ];

            $this->Learner_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Learner Added Successfully</p>');
            redirect(site_url( Backend_URL. 'learner'));
        }
    }
    
    public function update($id){
        $learner = $this->Learner_model->get_by_id($id);

        if ($learner) {
            $batches = $this->Batch_model->get_all();
            $batch_list = array('' => '-- Select Batch --');
            foreach($batches as $batch) {
                $batch_list[$batch->id] = $batch->name . ' (ID: ' . $batch->id . ')';
            }
            
            $districts = $this->District_model->get_all();
            $district_list = array('' => '-- Select District --');
            foreach($districts as $district) {
                $district_list[$district->id] = $district->bn_name . ' (ID: ' . $district->id . ')';
            }            
            
            $data = [
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'learner/update_action'),
				'id' => set_value('id', $learner->id),
                'a_id' => set_value('id', $learner->id),
				'batch_id' => set_value('batch_id', $learner->batch_id),
				'batch_list' => $batch_list,
				'name' => set_value('name', $learner->name),
				'dob' => set_value('dob', $learner->dob),
				'nid' => set_value('nid', $learner->nid),
				'father' => set_value('father', $learner->father),
				'mother' => set_value('mother', $learner->mother),
				'district_id' => set_value('district_id', $learner->district_id),
				'district_list' => $district_list,				
				'primary_mobile' => set_value('primary_mobile', $learner->primary_mobile),
				'blood_group' => set_value('blood_group', $learner->blood_group),
				'second_contact_person' => set_value('second_contact_person', $learner->second_contact_person),
				'second_contact_mobile' => set_value('second_contact_mobile', $learner->second_contact_mobile),
				'is_resident' => set_value('is_resident', $learner->is_resident),
				'photo' => set_value('photo', $learner->photo),
				'remarks' => set_value('remarks', $learner->remarks),
		    ];

            $this->viewAdminContent('learner/learner/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Learner Not Found</p>');
            redirect(site_url( Backend_URL. 'learner'));
        }
    }
    
    public function update_action(){

        $this->_rules();

        $id = $this->input->post('id', TRUE);        
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = [
				'batch_id' => $this->input->post('batch_id',TRUE),
				'name' => $this->input->post('name',TRUE),
				'dob' => $this->input->post('dob',TRUE),
				'nid' => $this->input->post('nid',TRUE) ? $this->input->post('nid',TRUE) : null,
				'father' => $this->input->post('father',TRUE),
				'mother' => $this->input->post('mother',TRUE),
				'district_id' => $this->input->post('district_id',TRUE),
				'primary_mobile' => $this->input->post('primary_mobile',TRUE),
				'blood_group' => $this->input->post('blood_group',TRUE),
				'second_contact_person' => $this->input->post('second_contact_person',TRUE),
				'second_contact_mobile' => $this->input->post('second_contact_mobile',TRUE),
				'is_resident' => $this->input->post('is_resident',TRUE),
				'photo' => $this->input->post('photo',TRUE),
				'remarks' => $this->input->post('remarks',TRUE),
		    ];

            $this->Learner_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Learner Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'learner/update/'. $id ));
        }
    }

    public function delete($id){
        $learner = $this->Learner_model->get_by_id($id);
        if ($learner) {
            $data = [
				'id' => $learner->id,
				'batch_id' => $learner->batch_id,
				'name' => $learner->name,
				'dob' => $learner->dob,
				'nid' => $learner->nid,
				'father' => $learner->father,
				'mother' => $learner->mother,
				'district_id' => $learner->district_id,
				'primary_mobile' => $learner->primary_mobile,
				'blood_group' => $learner->blood_group,
				'second_contact_person' => $learner->second_contact_person,
				'second_contact_mobile' => $learner->second_contact_mobile,
				'is_resident' => $learner->is_resident,
				'photo' => $learner->photo,
				'remarks' => $learner->remarks,
				'created_at' => $learner->created_at,
				'updated_at' => $learner->updated_at,
		    ];
            $this->viewAdminContent('learner/learner/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Learner Not Found</p>');
            redirect(site_url( Backend_URL. 'learner'));
        }
    }


    public function delete_action($id){
        $learner = $this->Learner_model->get_by_id($id);

        if ($learner) {
            $this->Learner_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Learner Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'learner'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Learner Not Found</p>');
            redirect(site_url( Backend_URL. 'learner'));
        }
    }
    

    public function _rules(){
		$this->form_validation->set_rules('batch_id', 'batch id', 'trim|required|numeric');
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('dob', 'dob', 'trim');
		$this->form_validation->set_rules('nid', 'nid', 'trim|numeric');
		$this->form_validation->set_rules('father', 'father', 'trim');
		$this->form_validation->set_rules('mother', 'mother', 'trim');
		$this->form_validation->set_rules('district_id', 'District', 'trim|required|numeric');
		$this->form_validation->set_rules('primary_mobile', 'primary mobile', 'trim|required');
		$this->form_validation->set_rules('blood_group', 'blood group', 'trim');
		$this->form_validation->set_rules('second_contact_person', 'second contact person', 'trim');
		$this->form_validation->set_rules('second_contact_mobile', 'second contact mobile', 'trim');
		$this->form_validation->set_rules('is_resident', 'is resident', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


	public function _menu() {
        // return add_main_menu('Donor', 'donor', 'donor', 'fa-hand-o-right');
        return buildMenuForModule([
            'module' => 'Learner',
            'icon' => 'fa-user',
            'href' => 'learner',
            'children' => [
                [
                    'title' => 'All Learner',
                    'icon' => 'fa fa-bars',
                    'href' => 'learner'
                ], [
                    'title' => ' |_ Add Learner',
                    'icon' => 'fa fa-plus',
                    'href' => 'learner/create'
				]
            ]
        ]);
    }
    


}