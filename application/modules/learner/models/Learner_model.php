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
			$this->db->or_like('zila_id', $q);
			$this->db->or_like('primary_mobile', $q);
			$this->db->or_like('blood_group', $q);
			$this->db->or_like('second_contact_person', $q);
			$this->db->or_like('second_contact_mobile', $q);
			$this->db->or_like('is_resident', $q);
			$this->db->or_like('photo', $q);
			$this->db->or_like('remarks', $q);
			$this->db->or_like('created_at', $q);
			$this->db->or_like('updated_at', $q);
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('batch_id', $q);
			$this->db->or_like('name', $q);
			$this->db->or_like('dob', $q);
			$this->db->or_like('nid', $q);
			$this->db->or_like('father', $q);
			$this->db->or_like('mother', $q);
			$this->db->or_like('zila_id', $q);
			$this->db->or_like('primary_mobile', $q);
			$this->db->or_like('blood_group', $q);
			$this->db->or_like('second_contact_person', $q);
			$this->db->or_like('second_contact_mobile', $q);
			$this->db->or_like('is_resident', $q);
			$this->db->or_like('photo', $q);
			$this->db->or_like('remarks', $q);
			$this->db->or_like('created_at', $q);
			$this->db->or_like('updated_at', $q);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    

}