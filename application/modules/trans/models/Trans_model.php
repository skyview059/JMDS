<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_model extends Fm_model {

    public $table = 'donations';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get total rows
    function total_rows($user_id = 0,$area_id = 0, $month = NULL,$head_id=0,$year = 0,$q = NULL) {
        $this->__sql($q,$user_id,$area_id, $month,$head_id,$year);
        $this->db->from("{$this->table} as in");
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0,$user_id = 0,$area_id = 0, $month = NULL, $head_id=0,$year = 0,$q = NULL) {
        $this->db->select("in.*,d.name,u.first_name,u.last_name,h.name as category");
        $this->db->from("{$this->table} as in");
        $this->db->join('donors as d',"d.id=in.donor_id",'LEFT');
        $this->db->join('users as u','u.id=in.collected_by','LEFT');
        $this->db->join('donation_heads as h','h.id=in.head_id','LEFT');
        $this->db->order_by($this->id, $this->order);
        $this->__sql($user_id,$area_id,$month,$head_id,$year,$q);
        
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    function __sql($user_id,$area_id, $month,$head_id,$year,$q){
        $this->db->where('in.status','OK');
        if($head_id){ $this->db->where('in.head_id', $head_id); }
        if($user_id){ $this->db->where('in.collected_by', $user_id); }
        if($area_id){                    
            $this->db->join('donors as ds','ds.id = in.donor_id','LEFT');
            $this->db->join('service_areas as a','a.id = ds.area_id','LEFT');
            $this->db->where('a.id',$area_id);
        }
        if(!empty($month) && !empty($year)){
            $this->db->group_start();
            $this->db->like('in.month', $year.'-'.$month.'-');
            $this->db->group_end();
        }
        if($year && empty($month)){
            $this->db->group_start();
            $this->db->like('in.month', $year.'-');
            $this->db->group_end();
        }
        if($month && empty($year)){
            $this->db->group_start();
            $this->db->like('in.month', '-'.$month.'-');
            $this->db->group_end();            
        }
        if ($q) {
            $this->db->group_start();
            $this->db->like('in.remark', $q);
            $this->db->or_like('in.paid', $q);
            $this->db->group_end();
        }
    }
}
