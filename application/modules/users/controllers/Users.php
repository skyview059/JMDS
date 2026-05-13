<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2016-10-05
 */

class Users extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->helper('users');
        $this->load->library('form_validation');       
    }
    
    public function index() {
        $q          = urldecode_fk($this->input->get('q', TRUE));
        $status     = urldecode_fk($this->input->get('status', TRUE));
        $role_id    = intval($this->input->get('role_id', TRUE));
        $start      = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = Backend_URL . 'users?q='.$q.'&role_id='.$role_id.'&status='.$status;
            $config['first_url'] = Backend_URL . 'users?q='.$q.'&role_id='.$role_id.'&status='.$status;
        } else {
            $config['base_url'] = Backend_URL . 'users/';
            $config['first_url'] = Backend_URL . 'users/';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q, $status , $role_id);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q, $status , $role_id);

//        echo $this->db->last_query();
        
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'sl' => 1,
            'q' => $q,
            'role_id' => $role_id,
            'status' => $status,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('users/index', $data);
    }


    
    public function profile($id) {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'role_id' => Users_helper::getRoleNameByID($row->role_id),
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'email' => $row->email,
                'password' => $row->password,
                'contact' => $row->contact,
                'dob' => $row->dob,
                'add_line1' => $row->add_line1,
                'add_line2' => $row->add_line2,
                'city' => $row->city,
                'state' => $row->state,
                'postcode' => $row->postcode,
                'country_id' => getCountryName($row->country_id),
                'created' => $row->created,
                'last_access' => $row->last_access,
                'profile_photo' => $row->profile_photo,
                'status' => $row->status,
            );
            $row = $this->Users_model->get_by_id($id);


            $this->viewAdminContent('users/profile', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url( Backend_URL . 'users'));
        }
    }

          
    public function create() {       
        $this->viewAdminContent('users/create');
    }

    public function create_action() {                
        $yy = $this->input->post('yy');
        $mm = $this->input->post('mm');
        $dd = $this->input->post('dd');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
                                                    
            echo ajaxRespond( 'Fail', form_error('your_email'));               
               
        } else {
            $data = array(
                'role_id'       => intval($this->input->post('role_id', TRUE)),                                
                'first_name'    => $this->input->post('first_name', TRUE),
                'last_name'     => $this->input->post('last_name', TRUE),
                'email'         => $this->input->post('your_email', TRUE),
                'password'      => password_encription(  $this->input->post('password', TRUE) ),
                'contact'       => $this->input->post('contact', TRUE),
                'dob'           => $yy .'-'. $mm .'-'. $dd,
                'add_line1'     => $this->input->post('add_line1', TRUE),
                'add_line2'     => $this->input->post('add_line2', TRUE),
                'city'          => $this->input->post('city', TRUE),
                'state'         => $this->input->post('state', TRUE),
                'postcode'      => $this->input->post('postcode', TRUE),
                'country_id'    => $this->input->post('country_id', TRUE),
                'created'       => date("Y-m-d"),                                
                'status'        => $this->input->post('status', TRUE),
            );
            
            $this->Users_model->insert($data);             
            echo ajaxRespond('OK', '<p class="ajax_success">User Registed Successfully</p>'); 
        }
    }

    public function update($id) {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
                'id' => set_value('id', $row->id),
                'role_id' => set_value('role_id', $row->role_id),
                'first_name' => set_value('first_name', $row->first_name),
                'last_name' => set_value('last_name', $row->last_name),
                'email' => set_value('email', $row->email),                
                'contact' => set_value('contact', $row->contact),
                'dob' => set_value('dob', $row->dob),
                'add_line1' => set_value('add_line1', $row->add_line1),
                'add_line2' => set_value('add_line2', $row->add_line2),
                'city' => set_value('city', $row->city),
                'state' => set_value('state', $row->state),
                'postcode' => set_value('postcode', $row->postcode),
                'country_id' => set_value('country_id', $row->country_id),
                'created' => set_value('created', $row->created),
                'last_access' => set_value('last_access', $row->last_access),
                'profile_photo' => set_value('profile_photo', $row->profile_photo),
                'old_img' => set_value('old_img', $row->profile_photo),
                'status' => set_value('status', $row->status),
            );
            
            $this->viewAdminContent('users/update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function update_action() {
                 
        ajaxAuthorized();
        $date = $this->input->post('yy').'-'.$this->input->post('mm').'-'.$this->input->post('dd');
        
        $data = array(
            'role_id'       => $this->input->post('role_id', TRUE),
            'first_name'    => $this->input->post('first_name', TRUE),
            'last_name'     => $this->input->post('last_name', TRUE),
            'email'         => $this->input->post('email', TRUE),                
            'contact'       => $this->input->post('contact', TRUE),
            'dob'           => $date,
            'add_line1'     => $this->input->post('add_line1', TRUE),
            'add_line2'     => $this->input->post('add_line2', TRUE),
            'city'          => $this->input->post('city', TRUE),
            'state'         => $this->input->post('state', TRUE),
            'postcode'      => $this->input->post('postcode', TRUE),
            'country_id'    => $this->input->post('country_id', TRUE),                
            'status'        => $this->input->post('status', TRUE),
        );
        $this->Users_model->update($this->input->post('id', TRUE), $data);                                    
        echo '<p class="ajax_success">Update Successfully</p>';
       
    }

    public function delete($id) {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = (array) $row;                       
            $this->viewAdminContent('users/delete', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules(){         	
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');		
        $this->form_validation->set_rules('your_email', 'your email', 'trim|valid_email|required|is_unique[users.email]', 
                [ 'is_unique' => 'This email already in used', 'valid_email' => 'Enter a valide email address']);
	
        $this->form_validation->set_rules('role_id', 'role_id', 'required');
        $this->form_validation->set_rules('password', 'password field', 'required');        
        $this->form_validation->set_error_delimiters('<p class="ajax_error">', '</p>');	
    }

    public function image_upload($photo, $id = 0) {
        $handle = new upload($photo);
        if ($handle->uploaded) {
            $prefix                     = $id;
            $handle->file_new_name_body = 'user_photo';
            $handle->image_resize       = true;
            $handle->image_x            = 400;
            $handle->image_ratio_y      = true;
            $handle->allowed            = array(
                'image/jpeg', 
                'image/jpg', 
                'image/gif', 
                'image/png', 
                'image/bmp'
            );
            $handle->file_new_name_body = uniqid($prefix) . '_' . md5(microtime()) . '_' . time();           
            $handle->process( 'uploads/users_profile/');           
            $handle->processed;
            return $receipt_img = $handle->file_dst_name;
        }
    }
    
                   
    public function _menu(){        
        return buildMenuForMoudle([
            'module'    => 'Users',
            'icon'      => 'fa-users',
            'href'      => 'users',                    
            'children'  => [
                [
                    'title' => 'All User',
                    'icon'  => 'fa fa-circle-o',
                    'href'  => 'users'
                ],[
                    'title' => ' |_ Add User',
                    'icon'  => 'fa fa-circle-o',
                    'href'  => 'users/create'
                ],[
                    'title' => 'Role / ACL',
                    'icon'  => 'fa fa-circle-o',
                    'href'  => 'users/roles'
                ]
            ]        
        ]);
    }
               
    public function password( $id ){  
        
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'            => $row->id,
                'first_name'    => $row->first_name,
                'last_name'     => $row->last_name,
                'email'         => $row->email,
                'password'      => $row->password,
                'status'        => $row->status
            );
            $this->viewAdminContent('password', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Record Not Found</p>');
            redirect( site_url( Backend_URL . 'users') );
        }        
    }
    
    public function reset_password(){
        ajaxAuthorized();
        $user_id  = intval( $this->input->post('user_id') );
        $new_pass = $this->input->post('new_pass');
        $con_pass = $this->input->post('con_pass');
                        
        if ($new_pass != $con_pass) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Confirm Password Not Match</p>');                
            exit;
        }
     
        $hass_pass = password_encription( $new_pass ); 
        
        $this->db->set('password', $hass_pass);
        $this->db->where('id', $user_id);
        $this->db->update('users');
        echo ajaxRespond('OK', '<p class="ajax_success">Password Reset Successfully</p>');                  
    }
   
    public function setStatus(){
        $id         = $this->input->post('id');
        $status     = $this->input->post('status');        
        $this->db->set('status', $status);
        $this->db->where('id', $id);        
        $this->db->update('users');        
        if($status =='Inactive'){
            echo ajaxRespond('OK', "<p class='ajax_notice'>Account Freezed</p>");
        } else {
            echo ajaxRespond('OK', "<p class='ajax_success'>Account UnFreezed</p>");
        }                        
    }
}
