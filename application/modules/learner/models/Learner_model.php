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
        	$this->db->like('learners.id', $q);
			$this->db->or_like('learners.batch_id', $q);
			$this->db->or_like('learners.name', $q);
			$this->db->or_like('learners.dob', $q);
			$this->db->or_like('learners.nid', $q);
			$this->db->or_like('learners.father', $q);
			$this->db->or_like('learners.mother', $q);
			$this->db->or_like('learner_addresses.cu_dist_id', $q);
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
            $this->db->where('learner_addresses.cu_dist_id', $district_id);
        }
        
        if($is_resident){
            $this->db->where('learners.is_resident', $is_resident);
        }

		$this->db->from($this->table);
        $this->db->join('learner_addresses', 'learner_addresses.learner_id = learners.id', 'left');

        return $this->db->count_all_results();
    }

    // get data by id
    function get_by_id($id){
        $this->db->select('learners.*, learner_addresses.cu_village, learner_addresses.cu_postoffice, learner_addresses.cu_postcode, learner_addresses.cu_ps, learner_addresses.cu_dist_id, learner_addresses.pa_village, learner_addresses.pa_postoffice, learner_addresses.pa_postcode, learner_addresses.pa_ps, learner_addresses.pa_dist_id, batches.name as batch_name, cu_dist.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');
        $this->db->join('learner_addresses', 'learner_addresses.learner_id = learners.id', 'left');
        $this->db->join('districts as cu_dist', 'cu_dist.id = learner_addresses.cu_dist_id', 'left');
        $this->db->where('learners.'.$this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function get_limit_data($limit, $start = 0, $q = NULL, $batch_id = NULL, $district_id = NULL, $is_resident = NULL) {
        $this->db->select('learners.*, batches.name as batch_name, cu_dist.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');   
        $this->db->join('learner_addresses', 'learner_addresses.learner_id = learners.id', 'left');
        $this->db->join('districts as cu_dist', 'cu_dist.id = learner_addresses.cu_dist_id', 'left');

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
			$this->db->or_like('learner_addresses.cu_dist_id', $q);
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
            $this->db->where('learner_addresses.cu_dist_id', $district_id);
        }
        
        if($is_resident){
            $this->db->where('learners.is_resident', $is_resident);
        }

		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get all data
    function get_all() {
        $this->db->select('learners.*, batches.name as batch_name, cu_dist.bn_name as district_name');
        $this->db->join('batches', 'batches.id = learners.batch_id', 'left');
        $this->db->join('learner_addresses', 'learner_addresses.learner_id = learners.id', 'left');
        $this->db->join('districts as cu_dist', 'cu_dist.id = learner_addresses.cu_dist_id', 'left');
        $this->db->order_by('learners.'.$this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // insert data
    function insert($data, $address_data = array())
    {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        if (!empty($address_data)) {
            $address_data['learner_id'] = $insert_id;
            $this->db->insert('learner_addresses', $address_data);
        }
        return $insert_id;
    }

    // update data
    function update($id, $data, $address_data = array())
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        
        if (!empty($address_data)) {
            $this->db->where('learner_id', $id);
            $addr = $this->db->get('learner_addresses')->row();
            if ($addr) {
                $this->db->where('learner_id', $id);
                $this->db->update('learner_addresses', $address_data);
            } else {
                $address_data['learner_id'] = $id;
                $this->db->insert('learner_addresses', $address_data);
            }
        }
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        $this->db->where('learner_id', $id);
        $this->db->delete('learner_addresses');
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