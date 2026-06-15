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
            $this->db->or_like('course_type', $q);
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
        $this->db->select('batches.*');
        $this->db->select('(SELECT COUNT(id) FROM learners WHERE learners.batch_id = batches.id) AS booked_seat', FALSE);
        $this->db->select('(SELECT COUNT(id) FROM learners WHERE learners.batch_id = batches.id AND learners.gender = "Male") AS male_count', FALSE);
        $this->db->select('(SELECT COUNT(id) FROM learners WHERE learners.batch_id = batches.id AND learners.gender = "Female") AS female_count', FALSE);
        $this->db->select('(SELECT SUM(amount) FROM transactions WHERE transactions.batch_id = batches.id AND transactions.nature = "Cr") AS total_income', FALSE);
        $this->db->select('(SELECT SUM(amount) FROM transactions WHERE transactions.batch_id = batches.id AND transactions.nature = "Dr") AS total_expenses', FALSE);
        $this->db->order_by('batches.'.$this->id, $this->order);
        if($q){
            $this->db->group_start();
            $this->db->like('batches.id', $q);
            $this->db->or_like('batches.name', $q);
            $this->db->or_like('batches.course_type', $q);
            $this->db->or_like('batches.seat', $q);
            $this->db->or_like('batches.date_start', $q);
            $this->db->or_like('batches.date_end', $q);
            $this->db->or_like('batches.status', $q);
            $this->db->or_like('batches.remarks', $q);
            $this->db->group_end();
        }
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    function get_booked_seat($id){
        $this->db->where('batch_id', $id);
        return $this->db->count_all_results('learners');
    }

    function get_male_count($id){
        $this->db->where('batch_id', $id);
        $this->db->where('gender', 'Male');
        return $this->db->count_all_results('learners');
    }

    function get_female_count($id){
        $this->db->where('batch_id', $id);
        $this->db->where('gender', 'Female');
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