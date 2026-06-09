<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Head_model extends Fm_model{

    public $table = 'trans_heads';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($q = NULL) {    
        if($q){
        	$this->db->like('id', $q);
			$this->db->or_like('type', $q);
			$this->db->or_like('name', $q);
			$this->db->or_like('status', $q);
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select('trans_heads.*, COUNT(transactions.id) AS trans_qty, SUM(transactions.amount) AS amount');
        $this->db->join('transactions', 'transactions.head_id = trans_heads.id', 'left');
        if ($q) {
            $this->db->group_start();
            $this->db->or_like('trans_heads.name', $q);

            $this->db->group_end();
        }
        $this->db->group_by('trans_heads.id');
        $this->db->order_by('trans_heads.' . $this->id, $this->order);
        $this->db->limit($limit, $start);

        return $this->db->get($this->table)->result();
    }
}
