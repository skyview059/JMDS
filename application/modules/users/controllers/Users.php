<?php defined('BASEPATH') or exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2016-10-05
 */

class Users extends Admin_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->helper('users');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $start     = intval($this->input->get('start'));
        $config['base_url'] = Backend_URL . 'users/';
        $config['first_url'] = Backend_URL . 'users/';

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows();
        $users = $this->Users_model->get_limit_data($config['per_page'], $start);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users' => $users,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('users/users/index', $data);
    }

    public function profile($id)
    {
        $user = $this->Users_model->get_by_id($id);
        if ($user) {
            $data = array(
                'id'            => $user->id,
                'role_id'       => Users_helper::getRoleNameByID($user->role_id),               
                'full_name'     => $user->full_name,
                'email'         => $user->email,
                'contact'       => $user->contact,
                'last_access'   => globalDateTimeFormat($user->last_access),
                'status'        => $user->status,
                'created'       => globalDateFormat($user->created),
            );
            $user = $this->Users_model->get_by_id($id);

            $this->viewAdminContent('users/users/profile', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url(Backend_URL . 'users'));
        }
    }




    public function create()
    {
        $this->viewAdminContent('users/users/create');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

            echo ajaxRespond('Fail', form_error('your_email'));
        } else {
            $data = array(
                'role_id'       => intval($this->input->post('role_id', TRUE)),               
                'full_name'     => $this->input->post('full_name', TRUE),
                'email'         => $this->input->post('email', TRUE),
                'password'      => password_encryption($this->input->post('password', TRUE)),
                'contact'       => $this->input->post('contact', TRUE),
                'created'       => date("Y-m-d"),
                'status'        => $this->input->post('status', TRUE),
            );

            $this->Users_model->insert($data);
            echo ajaxRespond('OK', '<p class="ajax_success">User Register Successfully</p>');
        }
    }

    public function update($id)
    {
        $user = $this->Users_model->get_by_id($id);

        if ($user) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
                'id' => set_value('id', $user->id),
                'role_id' => set_value('role_id', $user->role_id),                

                'full_name' => set_value('full_name', $user->full_name),
                'email' => set_value('email', $user->email),
                'contact' => set_value('contact', $user->contact),

                'created' => set_value('created', $user->created),
                'last_access' => set_value('last_access', $user->last_access),
                'status' => set_value('status', $user->status),
            );
            $this->viewAdminContent('users/users/update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function update_action()
    {
        ajaxAuthorized();
        $data = array(
            'role_id'       => (int)$this->input->post('role_id', TRUE),            
            'full_name'    => $this->input->post('full_name', TRUE),
            'email'         => $this->input->post('email', TRUE),
            'contact'       => $this->input->post('contact', TRUE),
            'status'        => $this->input->post('status', TRUE),
        );
        $this->Users_model->update($this->input->post('id', TRUE), $data);
        echo '<p class="ajax_success"><i class="fa fa-check-o"></i> Update Successfully </p>';
    }

    public function delete($id)
    {
        $user = $this->Users_model->get_by_id($id);
        if ($user) {
            $data = (array) $user;
            $this->viewAdminContent('users/users/delete', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('full_name', 'first name', 'trim|required');
        $this->form_validation->set_rules(
            'email', 'email', 'trim|valid_email|required|is_unique[users.email]',
            ['is_unique' => 'This email already in used', 'valid_email' => 'Enter a valid email']
        );

        $this->form_validation->set_rules('role_id', 'role_id', 'required');
        $this->form_validation->set_rules('password', 'password field', 'required');
        $this->form_validation->set_error_delimiters('<p class="ajax_error">', '</p>');
    }

    public function menu()
    {
        return buildMenuForModule([
            'module'    => 'Users',
            'icon'      => 'fa-users',
            'href'      => 'users',
            'children'  => [
                [
                    'title' => 'All User',
                    'icon'  => 'fa fa-circle-o',
                    'href'  => 'users'
                ], [
                    'title' => 'Add New User',
                    'icon'  => 'fa fa-circle-o',
                    'href'  => 'users/create'
                ], [
                    'title' => 'Role / ACL',
                    'icon'  => 'fa fa-circle-o',
                    'href'  => 'users/roles'
                ]
            ]
        ]);
    }

    public function password($id)
    {
        $data['id'] = $id;
        $data['user_id'] = $id;
        $this->viewAdminContent('users/users/password', $data);
    }

    public function reset_password()
    {

        $user_id  = intval($this->input->post('user_id'));
        $new_pass = $this->input->post('new_pass');
        $con_pass = $this->input->post('con_pass');

        if ($new_pass != $con_pass) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Confirm Password Not Match</p>');
            exit;
        }

        $hash_pass = password_encryption($new_pass);
        $this->db->update('users', ['password' => $hash_pass], ['id' => $user_id]);
        echo ajaxRespond('OK', '<p class="ajax_success">Password Reset Successfully</p>');
    }
}
