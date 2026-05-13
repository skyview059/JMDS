<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Donor_model extends Fm_model{

    public $table = 'donors';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($area_id=0,$q = NULL) {
        $this->db->from("{$this->table} as d");
        $this->sql_search_query($area_id, $q);	
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $area_id=0,$order_by='Default',$q = NULL) {
        
        $this->db->select_sum('paid');        
        $this->db->where('donor_id', 'd.id', false);        
        $this->db->where('status','OK');        
        $_total = $this->db->get_compiled_select('donations'); 

        $this->db->select('count(*)');        
        $this->db->where('donor_id', 'd.id', false);        
        $this->db->where('status','OK');        
        $_times = $this->db->get_compiled_select('donations');  
            
        $this->db->select("d.*, ({$_total}) as TotalPaid, ({$_times}) as Times");
        
        $this->db->from("{$this->table} as d");
        $this->sql_search_query($area_id,$q);
	    $this->db->limit($limit, $start);
        $this->setOrderBy($order_by);
        return $this->db->get()->result();
    }
    
    private function sql_search_query($area_id=0,$q=null){
        if($area_id){ $this->db->where('d.area_id', $area_id); }
        
        if ($q) {
            $this->db->group_start();            
            $this->db->like('d.name', $q);
            $this->db->or_like('d.contact', $q);            
            $this->db->group_end();                        
        }        
    }


    
    private function setOrderBy($order_by='Default'){
        if($order_by=='Default'){        
            $this->db->order_by($this->id, $this->order);    
        }        
        if($order_by=='High2Low'){        
            $this->db->order_by('TotalPaid', 'DESC');    
        }   
        if($order_by=='Low2Hight'){        
            $this->db->order_by('TotalPaid', 'ASC');    
        }   
        if($order_by=='MaxTrans'){        
            $this->db->order_by('Times', 'DESC');    
        }   
        if($order_by=='MinTrans'){        
            $this->db->order_by('Times', 'ASC');
        }   
    }
}