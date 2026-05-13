<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_model extends Fm_model {

    public $table = 'sms_log';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get total rows
    function total_sent() {        
        $this->db->select_sum('qty');
        $sms = $this->db->get('sms_log')->row();
        return $sms->qty;
    }
    
    function total_rows($year,$month, $sms_type, $q = NULL) {        
        $this->db->from($this->table);
        $this->__sql_filter( $year,$month, $sms_type,$q);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start, $year,$month, $sms_type, $order_by, $q = NULL) {
        $this->db->select("{$this->table}.*, d.name as donor_name");
        $this->db->from($this->table);
        $this->db->join('donors as d',"d.id={$this->table}.donor_id",'LEFT');
        // $this->db->where('sms_log.id >', 58454);
        // $this->db->where('sms_log.phone', 1923938731);
        $this->__sql_filter( $year,$month, $sms_type, $q);
        $this->__order_by( $order_by );        
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    private function __sql_filter( $year,$month, $sms_type,$q = NULL ){
        if($year){ $this->db->where('DATE_FORMAT(timestamp, "%Y") =', $year ); }
        if($month){ $this->db->where('DATE_FORMAT(timestamp, "%m") =', $month ); }
        if(in_array($sms_type, ['TEXT','UNICODE'])){ 
            $this->db->where('type', $sms_type ); 
        }
        
        if ($q) {
            $this->db->group_start();
            $this->db->like('phone', $q);
            $this->db->or_like('body', $q);
            $this->db->group_end();
        }
    }

    private function __order_by( $order_by = 'Default' ){
        switch($order_by){
            case 'QtyASC':
                $this->db->order_by('qty', 'ASC');
                break;
            case 'QtyDSC':
                $this->db->order_by('qty', 'DESC');
                break;
            default:
                $this->db->order_by('id', 'DESC');                
        }        
    }

}
