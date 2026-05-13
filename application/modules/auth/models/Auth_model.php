<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends Fm_model{

    public $table   = 'users';
    
    function __construct(){
        parent::__construct();
    }

    /**
     * @param $username string    
     * @return array
     */
    function validateUser($username){
        return $this->db
                ->select('id,role_id,first_name,last_name,email,profile_photo,password,status')
                ->get_where($this->table, ['email' => $username] )
                ->row();
    }
    
    
            
    function sign_up($data){                
        $this->db->insert($this->table, $data);
    }
                     
}