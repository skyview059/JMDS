<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Users_model extends Fm_model{

    public $table = 'users';
    public $id = 'id';
    public $order = 'ASC';

    function __construct(){
        parent::__construct();
    }

    // get data by id
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL , $status = NULL , $role_id = 0) {
        $this->__sql($role_id,$status,$q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL , $status = NULL , $role_id = 0) {
        $this->db->order_by($this->id, $this->order);        
        $this->__sql($role_id,$status,$q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    function __sql($role_id,$status,$q){
        if($q){ 
            $this->db->group_start();
            $this->db->like('first_name', $q);
            $this->db->or_like('last_name', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('contact', $q);            
            $this->db->group_end();
        }
        
        if($this->role_id != 1){ $this->db->where('role_id >=', 2 ); }
        if($role_id != 0){ $this->db->where('role_id', $role_id ); }
        
        if($status){ $this->db->where('status', $status); }
        
    }

}