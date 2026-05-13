<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Batch_model extends Fm_model{

    public $table = 'batches';
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
            $this->db->or_like('seat', $q);
            $this->db->or_like('date_start', $q);
            $this->db->or_like('date_end', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('remarks', $q);
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
            $this->db->or_like('seat', $q);
            $this->db->or_like('date_start', $q);
            $this->db->or_like('date_end', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('remarks', $q);
        }
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    function get_booked_seat($id){
        $this->db->where('batch_id', $id);
        return $this->db->count_all_results('learners');
    }

    function get_total_income($id){
        $this->db->select_sum('amount');
        $this->db->where('batch_id', $id);
        $this->db->where('nature', 'Cr');
        return $this->db->get('transactions')->row()->amount;
    }

    function get_total_expenses($id){
        $this->db->select_sum('amount');
        $this->db->where('batch_id', $id);
        $this->db->where('nature', 'Dr');
        return $this->db->get('transactions')->row()->amount;
    }

}