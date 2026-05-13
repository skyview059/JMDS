<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Flick Base App
 * Model File
 * @package   Flick Base App
 * @author    Khairul Azam (Flick Team)  
 */

class Fm_model extends CI_Model{
    protected $user_id;
    protected $role_id;
    
    public function __construct() {
        parent::__construct();
        $this->user_id = getLoginUserData('user_id');
        $this->role_id = getLoginUserData('role_id');
    }
    // get all
    function get_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // get data by id
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // insert data
    function insert($data){
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
}
