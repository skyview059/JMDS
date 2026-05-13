<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class District_model extends Fm_model{

    public $table = 'districts';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($q = NULL) {    
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('name', $q);
			$this->db->or_like('bn_name', $q);
			$this->db->or_like('lat', $q);
			$this->db->or_like('lon', $q);
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('name', $q);
			$this->db->or_like('bn_name', $q);
			$this->db->or_like('lat', $q);
			$this->db->or_like('lon', $q);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    

}