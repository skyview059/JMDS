<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2019-08-21
 */

class Donor extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Donor_model');
        $this->load->helper('donor');
        $this->load->library('form_validation');
    }

    public function index() {
        $q = urldecode_fk($this->input->get('q', TRUE));
        
        $area_id = (int) $this->input->get('area_id');
        $order_by = urldecode_fk($this->input->get('order_by')) ?? 'Default';
        
        $limit = ($this->input->get('limit')) ? (int)$this->input->get('limit') : 200;
        $start = intval($this->input->get('start'));
        $config['base_url'] = build_pagination_url(Backend_URL . 'donor', 'start');
        $config['first_url'] = build_pagination_url(Backend_URL . 'donor', 'start');

        $config['per_page'] = $limit;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Donor_model->total_rows($area_id,$order_by,$q);
        $donors = $this->Donor_model->get_limit_data($config['per_page'], $start, $area_id,$order_by,$q);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'donors' => $donors,            
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'area_id' => $area_id,
            'limit' => $limit,
            'order_by' => $order_by,
            'q' => $q,
        );
        $this->viewAdminContent('donor/donor/index', $data);
    }

    public function get_phone_no() {
        ajaxAuthorized();
        $id     = (int) $this->input->post('id');
        $row    = $this->Donor_model->get_by_id($id);
        if ($row) {
            echo $row->contact;
        } else {
            echo 'No Phone Number Found!';
        }
    }
    public function profile($id) {
        $row = $this->Donor_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'ref_id' => $row->ref_id,                
                'area_id' => Helper::getAreaName($row->area_id),
                'name' => $row->name,
                'amount' => $row->amount,
                'contact' => bdContactNumber($row->contact),
                'add_line1' => $row->add_line1,
                'add_line2' => $row->add_line2,
                'reg_date' => bdDateFormat($row->reg_date),
                'remark' => $row->remark,
                'status' => $row->status,
            );
            $this->viewAdminContent('donor/donor/read', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Donor Not Found</p>');
            redirect(site_url(Backend_URL . 'donor'));
        }
    }
    
    
    public function stmt( $id = 0){  
        $this->db->select("in.*,u.first_name,u.last_name,h.name as head_name");
        $this->db->from('donations as in');
        $this->db->join('users as u','u.id=in.collected_by','LEFT');
        $this->db->join('donation_heads as h','h.id=in.head_id','LEFT');
        
        $this->db->where('in.donor_id', $id);
        $this->db->where('in.status', 'OK');
        $stmts = $this->db->get()->result();        
        
        $donor = $row = $this->Donor_model->get_by_id($id);;
        
        $data['name']    = $donor->name;                
        $data['address'] = $donor->add_line1;                
        $data['contact'] = bdContactNumber($donor->contact);
        
        $data['stmts'] = $stmts;                
        $data['start'] = 0;                
        $data['id'] = $id;
                    
        $this->viewAdminContent('donor/donor/stmt', $data);
    }
    

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url(Backend_URL . 'donor/create_action'),
            'id' => set_value('id'),
            'ref_id' => set_value('ref_id'),
            'area_id' => set_value('area_id'),
            'name' => set_value('name'),
            'amount' => set_value('amount'),
            'contact' => set_value('contact'),
            'add_line1' => set_value('add_line1'),
            'add_line2' => set_value('add_line2'),
            'reg_date' => set_value('reg_date', date('Y-m-d')),
            'remark' => set_value('remark'),
            'status' => set_value('status', 'Active'),
        );
        $this->viewAdminContent('donor/donor/create', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            
            $data = array(
                'ref_id' => $this->input->post('ref_id', TRUE),
                'area_id' => $this->input->post('area_id', TRUE),
                'name' => $this->input->post('name', TRUE),
                'amount' => (int) $this->input->post('amount', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                'add_line1' => $this->input->post('add_line1', TRUE),
                'add_line2' => $this->input->post('add_line2', TRUE),
                'reg_date' => $this->input->post('reg_date', TRUE),
                'remark' => $this->input->post('remark', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            
            $this->Donor_model->insert($data);
            $donor_id = $this->db->insert_id();
            
            $send_sms = ($this->input->post('send_sms') == 'Yes') ? true : false;
            
            if($send_sms){                
                $this->load->helper('sms/template');
                $this->load->library('sms/Bulksms'); /* Adnsms or Bulksms*/
                
                $ref_id         = $data['ref_id'];
                $sms_template   = getSmsTemplate( 1 );
                $sms_body       = str_replace('{rid}', $ref_id, $sms_template);
                $mobile         = $data['contact'];                
                $respond        = Bulksms::send_single($sms_body, $mobile);
                save_sms_log_in_db($donor_id,$mobile,$sms_body,$respond);
            }
            
            $this->session->set_flashdata('message', '<p class="ajax_success">Donor Added Successfully</p>');
            redirect(site_url(Backend_URL . 'donor'));
        }
    }
    
    

    public function update($id) {
        $row = $this->Donor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url(Backend_URL . 'donor/update_action'),
                'id' => set_value('id', $row->id),
                'ref_id' => set_value('ref_id', $row->ref_id),
                'area_id' => set_value('area_id', $row->area_id),
                'name' => set_value('name', $row->name),
                'amount' => set_value('amount', $row->amount),
                'contact' => set_value('contact', $row->contact),
                'add_line1' => set_value('add_line1', $row->add_line1),
                'add_line2' => set_value('add_line2', $row->add_line2),
                'reg_date' => set_value('reg_date', $row->reg_date),
                'remark' => set_value('remark', $row->remark),
                'status' => set_value('status', $row->status),
            );
            $this->viewAdminContent('donor/donor/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Donor Not Found</p>');
            redirect(site_url(Backend_URL . 'donor'));
        }
    }

    public function update_action() {
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($id);
        } else {
            $data = array(
                'ref_id' => $this->input->post('ref_id', TRUE),
                'area_id' => $this->input->post('area_id', TRUE),
                'name' => $this->input->post('name', TRUE),
                'amount' => $this->input->post('amount', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                'add_line1' => $this->input->post('add_line1', TRUE),
                'add_line2' => $this->input->post('add_line2', TRUE),
                'reg_date' => $this->input->post('reg_date', TRUE),
                'remark' => $this->input->post('remark', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Donor_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Donor Updated Successlly</p>');
            redirect(site_url(Backend_URL . 'donor/update/' . $id));
        }
    }

    public function delete($id) {
        $row = $this->Donor_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'ref_id' => $row->ref_id,
                'area_id' => Helper::getAreaName($row->area_id),
                'name' => $row->name,
                'amount' => $row->amount,
                'contact' => $row->contact,
                'add_line1' => $row->add_line1,
                'add_line2' => $row->add_line2,
                'reg_date' => globalDateFormat($row->reg_date),
                'remark' => $row->remark,
                'status' => $row->status,
                'has_trans' => $this->countTrx($row->id),
            );
            $this->viewAdminContent('donor/donor/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Donor Not Found</p>');
            redirect(site_url(Backend_URL . 'donor'));
        }
    }
    
    private function countTrx($id=0){
        return $this->db->where('donor_id',$id)->count_all_results('donations');
    }

    public function delete_action($id) {
        $row = $this->Donor_model->get_by_id($id);

        if ($row) {
            $this->Donor_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Donor Deleted Successfully</p>');
            redirect(site_url(Backend_URL . 'donor'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Donor Not Found</p>');
            redirect(site_url(Backend_URL . 'donor'));
        }
    }
    
    public function dues(){

        $year     = (int) $this->input->get('year');
        $area_id = (int) $this->input->get('area_id');
        $status  = ($this->input->get('status')) ? $this->input->get('status') : 'Active';
        $year = $year?$year:2019;
        if(!$area_id){ $area_id = 1; }
//        if(!$qty){ $qty = 1; }
//        $month  = date('Y-m-31');
//        $data['dueMonth'] = date('M-Y');
//        if($qty > 1){
//            $month = date("Y-m-31", strtotime($month . " - {$qty} month"));
//            for ($i = 1; $i < $qty ; $i++){
////                $q = $qty - $i;
//               $temMonth =  date(", M-Y", strtotime($month . " - {$i} month"));
//               $data['dueMonth'] .= $temMonth;
//            }
//        }
                                
//        $this->db->select('count(*)');
//        $this->db->where('subscriber_id = s.id');
//        $this->db->where('status', 'Due');        
//        $sub_query = $this->db->get_compiled_select('subscriber_bills');  
//             
//        // SELECT id,bn_name, status, add_line1 FROM `subscribers` WHERE status = 'Disconnected'
//
//        $this->db->select('s.*');
//        $this->db->select("({$sub_query}) as due_qty");
//        $this->db->from('subscribers as s');  
//        $this->db->where('area_id', $area_id);
//        if($status !== 'All'){ $this->db->where('status', $status); }        
//        $this->db->having('due_qty >=', $qty );        
        
        $data['donors'] = $this->db->select('d.*,a.bn_name')
                            ->from('donors as d')
                            ->join('service_areas as a','d.area_id = a.id','LEFT')
//                            ->join('donations','donations.donor_id = d.id')
                            ->where('a.id',$area_id)
                            ->where('d.status',$status)
                            ->where('d.reg_date <=',$year.'-12-31')
////                            ->where('donations.paid_date >=',$month)
////                            ->limit(10)
                            ->get()->result();
        $data['start']  = 0;
        $data['total']  = 0;
        $data['year']    = $year;
        $data['area_id'] = $area_id;               
        $data['status'] = $status; 
        $data['last_query'] = $this->db->last_query();
        $this->viewAdminContent('donor/donor/dues', $data);
    }

    public function _menu() {
        // return add_main_menu('Donor', 'donor', 'donor', 'fa-hand-o-right');
        return buildMenuForMoudle([
            'module' => 'Donor',
            'icon' => 'fa-hand-o-right',
            'href' => 'donor',
            'children' => [
                [
                    'title' => 'All Donor',
                    'icon' => 'fa fa-bars',
                    'href' => 'donor'
                ], [
                    'title' => ' |_ Add New',
                    'icon' => 'fa fa-plus',
                    'href' => 'donor/create'
                ], [
                    'title' => ' |_ Dues',
                    'icon' => 'fa fa-plus',
                    'href' => 'donor/dues'
                ]
            ]
        ]);
    }

    public function _rules() {
        $this->form_validation->set_rules('ref_id', 'ref id', 'trim|numeric');
        $this->form_validation->set_rules('area_id', 'area id', 'trim|required|numeric');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric');
        $this->form_validation->set_rules('contact', 'contact', 'trim|required|numeric|min_length[10]');
        $this->form_validation->set_message('contact', 'Please enter valide mobile number');

        $this->form_validation->set_rules('add_line1', 'add line1', 'trim');
        $this->form_validation->set_rules('add_line2', 'add line2', 'trim');
        $this->form_validation->set_rules('reg_date', 'reg date', 'trim|required');
        $this->form_validation->set_rules('remark', 'remark', 'trim');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
