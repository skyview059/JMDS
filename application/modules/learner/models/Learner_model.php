<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Learner_model extends Fm_model{

    public $table = 'learners';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($q = NULL) {    
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('batch_id', $q);
			$this->db->or_like('name', $q);
			$this->db->or_like('dob', $q);
			$this->db->or_like('nid', $q);
			$this->db->or_like('father', $q);
			$this->db->or_like('mother', $q);
			$this->db->or_like('district_id', $q);
			$this->db->or_like('primary_mobile', $q);
			$this->db->or_like('blood_group', $q);
			$this->db->or_like('is_resident', $q);
			$this->db->or_like('remarks', $q);
		}
		$this->db->from($this->table);

        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select('learners.*, batches.name as batch_name,  districts.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');   
        $this->db->join('districts', 'districts.id = learners.district_id', 'left');

        $this->db->order_by($this->id, $this->order);
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('batch_id', $q);
			$this->db->or_like('name', $q);
			$this->db->or_like('dob', $q);
			$this->db->or_like('nid', $q);
			$this->db->or_like('father', $q);
			$this->db->or_like('mother', $q);
			$this->db->or_like('district_id', $q);
			$this->db->or_like('primary_mobile', $q);
			$this->db->or_like('blood_group', $q);
			$this->db->or_like('is_resident', $q);
			$this->db->or_like('remarks', $q);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    

}