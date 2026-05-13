<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends Fm_model {

    public $table = 'expenses';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get total rows
    function total_rows($q = NULL,$user_id = NULL,$area_id = NULL, $month = NULL,$year = NULL) {
        $this->__sql($q,$user_id,$area_id, $month,$year);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL,$user_id = NULL,$area_id = NULL, $month = NULL,$year = NULL) {
        $this->db->select("{$this->table}.*,h1.name as head_name,h2.name as sub_head_name");
        $this->db->select("u.first_name,u.last_name");
        $this->db->from($this->table);
        $this->db->join('expense_heads as h1',"h1.id={$this->table}.head_id",'LEFT');
        $this->db->join('expense_heads as h2',"h2.id={$this->table}.sub_head_id",'LEFT');
        $this->db->join('users as u',"u.id={$this->table}.user_id",'LEFT');
        
        $this->db->order_by($this->id, $this->order);
        $this->__sql($q,$user_id,$area_id, $month,$year);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    function __sql($q,$user_id,$area_id, $month,$year){
        $this->db->where("{$this->table}.status",'OK');        
        if($user_id){
            $this->db->where("expenses.user_id", $user_id);
        }
        if(!empty($month) && !empty($year)){
            $this->db->group_start();
            $this->db->like("expenses.trans_date", $year.'-'.$month.'-');
            $this->db->group_end();
        }
        if($year && empty($month)){
            $this->db->group_start();
            $this->db->like("expenses.trans_date", $year.'-');
            $this->db->group_end();
        }
        if($month && empty($year)){
            $this->db->group_start();
            $this->db->like("expenses.trans_date", '-'.$month.'-');
            $this->db->group_end();            
        }
        if ($q) {
            $this->db->group_start();
            $this->db->or_like("{$this->table}.remark", $q);
            $this->db->or_like("{$this->table}.amount", $q);
            $this->db->group_end();
        }
    }

}
