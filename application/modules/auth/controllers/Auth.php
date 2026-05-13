<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 5th April 2018
 */

class Auth extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }
   
    public function login_action() {
        ajaxAuthorized();
//        sleep(1);

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = ($this->input->post('remember')) ? (60 * 60 * 24 * 7) : (60 * 60 * 24);

        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Please enter a valid user name</p>');
            exit;
        }


        $user = $this->Auth_model->validateUser($username);
        if (!$user) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Incorrect Username!</p>');
            exit;
        }
        if (password_verify($password, $user->password) == false) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Incorrect Password!</p>');
            exit;
        }

        if ($user->status == 'Inactive') {
            echo ajaxRespond('Fail', '<p class="ajax_error">Your account is not active.</p>');
            exit;
        }

        $cookie_data = json_encode([
            'user_id' => $user->id,
            'user_mail' => $user->email,
            'role_id' => $user->role_id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'photo' => $user->profile_photo
        ]);

        $cookie = [
            'name' => 'login_data',
            'value' => base64_encode($cookie_data),
            'expire' => $remember,
            'secure' => false
        ];

        $this->input->set_cookie($cookie);
        $this->session->set_userdata($cookie);

        echo json_encode([
            'Status'    => 'OK', 
            'Msg'       => '<p class="ajax_success">Login Success</p>',
            'Link'      => site_url(),
            ]);        
        exit;        
    }
    
    public function logout() {
        
        $cookie = [
            'name'      => 'login_data',
            'value'     => false,
            'expire'    => -84000,
            'secure'    => false
        ];
        
        $this->input->set_cookie($cookie);        
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('value'); 
        $this->session->unset_userdata('expire'); 
        $this->session->unset_userdata('secure');                        

        $this->load->view('auth/logout');
    }

    public function login() {
//        $this->output->cache(60); 
        $this->load->view('auth/login');
    }
    
                        
    public function forgot_pass(){               
       $email       = $this->input->post('forgot_mail'); 
       $this->db->where('email', $email);
       $is_exist    = $this->db->count_all_results('users');
       
       if($is_exist > 0){                                
           $array = [
               'email'   => $email,
               'Status'  => 'OK',
               '_token'  => password_encription($email),
               'Msg'     => '<p class="ajax_success">Reset password link sent to your email </p>'
           ];           
           
           Modules::run('mail/send_pwd_mail', $array);
           echo json_encode($array);
                                 
        } else {
           echo ajaxRespond('Fail', '<p class="ajax_error">Email address not found!</p>');
       }
       
    }
    
    public function reset_password(){
        
        $this->load->view('auth/reset');        
        //$this->load->view('auth/login');
    }
    
    public function reset_password_action(){
       
        $reset_token = $this->input->post('verify_token');
        $email = $this->input->post('email');
        
        $new_pass   = $this->input->post('new_password');
        $re_pass    = $this->input->post('re_password');
        $hash_pass  =  password_hash($new_pass, PASSWORD_DEFAULT);
      
        // send mail here 
        if (password_verify($email, $reset_token)) {
            if($new_pass == $re_pass){            
                $this->db->where('email', $email);
                $this->db->update('users', ['password' => $hash_pass]);
            }
            echo ajaxRespond('OK', '<p class="ajax_success">Successfully updated</p>');
        } else {
           echo ajaxRespond('Fail', '<p class="ajax_error">Not Match</p>');
        }                                                                                              
    }
           
}