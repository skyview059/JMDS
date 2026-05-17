<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends Fm_model {

    public $table = 'users';
    public $id = 'id';
    public $order = 'ASC';

    public function __construct() {
        parent::__construct();
    }

    // get total rows
    public function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0) {                
        $this->db->select("{$this->table}.*");
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}
