<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Vehicle_model extends Fm_model{

    public $table = 'vehicles';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($q = NULL) {    
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('photo', $q);
			$this->db->or_like('number', $q);
			$this->db->or_like('purchased_date', $q);
			$this->db->or_like('amount', $q);
			$this->db->or_like('remark', $q);
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('photo', $q);
			$this->db->or_like('number', $q);
			$this->db->or_like('purchased_date', $q);
			$this->db->or_like('amount', $q);
			$this->db->or_like('remark', $q);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    

}