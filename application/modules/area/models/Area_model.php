<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends Fm_model {

    public $table = 'service_areas';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get total rows
    function total_rows($q = NULL) {

        if ($q) {
            $this->db->like('id', $q);
            $this->db->or_like('en_name', $q);
            $this->db->or_like('bn_name', $q);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        
        $this->db->select('count(*)');
        $this->db->where("area_id = {$this->table}.id");
        $sql = $this->db->get_compiled_select('donors');  
                
        $this->db->select("{$this->table}.*");
        $this->db->select("({$sql}) as Qty");
        $this->db->order_by('id', 'ASC');
        if ($q) {
            $this->db->like('id', $q);
            $this->db->or_like('en_name', $q);
            $this->db->or_like('bn_name', $q);
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}
