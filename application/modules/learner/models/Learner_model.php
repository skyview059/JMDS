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
    function total_rows($q = NULL, $batch_id = NULL, $district_id = NULL, $is_resident = NULL) {    
        if($q){
            $this->db->group_start();
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
            $this->db->group_end();
		}

        if($batch_id){
            $this->db->where('batch_id', $batch_id);
        }
        
        if($district_id){
            $this->db->where('district_id', $district_id);
        }
        
        if($is_resident){
            $this->db->where('is_resident', $is_resident);
        }

		$this->db->from($this->table);

        return $this->db->count_all_results();
    }

    // get data by id
    function get_by_id($id){
        $this->db->select('learners.*, batches.name as batch_name, districts.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');
        $this->db->join('districts', 'districts.id = learners.district_id', 'left');
        $this->db->where('learners.'.$this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function get_limit_data($limit, $start = 0, $q = NULL, $batch_id = NULL, $district_id = NULL, $is_resident = NULL) {
        $this->db->select('learners.*, batches.name as batch_name,  districts.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');   
        $this->db->join('districts', 'districts.id = learners.district_id', 'left');

        $this->db->order_by('learners.'.$this->id, $this->order);
        if($q){
            $this->db->group_start();
        	$this->db->like('learners.id', $q);
			$this->db->or_like('learners.batch_id', $q);
			$this->db->or_like('learners.name', $q);
			$this->db->or_like('learners.dob', $q);
			$this->db->or_like('learners.nid', $q);
			$this->db->or_like('learners.father', $q);
			$this->db->or_like('learners.mother', $q);
			$this->db->or_like('learners.district_id', $q);
			$this->db->or_like('learners.primary_mobile', $q);
			$this->db->or_like('learners.blood_group', $q);
			$this->db->or_like('learners.is_resident', $q);
			$this->db->or_like('learners.remarks', $q);
            $this->db->group_end();
		}

        if($batch_id){
            $this->db->where('learners.batch_id', $batch_id);
        }
        
        if($district_id){
            $this->db->where('learners.district_id', $district_id);
        }
        
        if($is_resident){
            $this->db->where('learners.is_resident', $is_resident);
        }

		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get all data
    function get_all() {
        $this->db->select('learners.*, batches.name as batch_name, districts.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');
        $this->db->join('districts', 'districts.id = learners.district_id', 'left');
        $this->db->order_by('learners.'.$this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // Attachment methods
    function get_attachments($rel_id, $rel_tbl = 'learners') {
        $this->db->where('rel_id', $rel_id);
        $this->db->where('rel_tbl', $rel_tbl);
        return $this->db->get('attachments')->result();
    }

    function insert_attachment($data) {
        $this->db->insert('attachments', $data);
        return $this->db->insert_id();
    }

    function get_attachment_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('attachments')->row();
    }

    function delete_attachment($id) {
        $this->db->where('id', $id);
        $this->db->delete('attachments');
    }

}