<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends Fm_model {

    public $table = 'subscriber_bills';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function users( $setDate ){
        
        $this->db->select_sum('paid');
        $this->db->where('collected_by = u.id');
        $this->db->where('status', 'OK' );
        $income = $this->db->get_compiled_select('donations'); 
        
        $this->db->select_sum('amount');
        $this->db->where('user_id = u.id');
        $this->db->where('status', 'OK' );
        $expense = $this->db->get_compiled_select('expenses'); 
                        
        $this->db->select('u.id,u.first_name,u.last_name');
        $this->db->select("({$income}) as income, ({$expense}) as expense");
        $this->db->from('users as u');
        if($this->role_id != 1){ $this->db->where('u.id >=',2); }        
        return $this->db->get()->result();
    }
    
    public function head_income(){
        
        $this->db->select_sum('paid');
        $this->db->where('head_id = h.id');
        $this->db->where('status', 'OK' );
        $sql = $this->db->get_compiled_select('donations');  
                        
        $this->db->select("h.*, ({$sql}) as paid");
        $this->db->from('donation_heads as h');       
        return $this->db->get()->result();
    }
    
    public function head_expense(){
        
        $this->db->select_sum('amount');
        $this->db->where('head_id = h.id');
        $this->db->where('status', 'OK' );
        $sql = $this->db->get_compiled_select('expenses');  
                        
        $this->db->select("h.*, ({$sql}) as paid");
        $this->db->from('expense_heads as h');  
        return $this->db->get()->result();
    }
    
    public function incomes( $month ){
        
        $this->db->select_sum('paid');
        $this->db->where('head_id = h.id');
        $this->db->where('status', 'OK' );
        $this->db->like('paid_date', $month, 'after' );
        $sql = $this->db->get_compiled_select('donations');  
                        
        $this->db->select("h.*, ({$sql}) as paid");
        $this->db->from('donation_heads as h');       
        return $this->db->get()->result();
    }
    
    public function expenses( $month ){
        
        $this->db->select_sum('amount');
        $this->db->where('head_id = h.id');
        $this->db->where('status', 'OK' );
        $this->db->like('trans_date', $month, 'after' );
        $sql = $this->db->get_compiled_select('expenses');  
                        
        $this->db->select("h.*, ({$sql}) as paid");
        $this->db->from('expense_heads as h');  
        return $this->db->get()->result();
    }
    
    
    public function graph_incomes( $year, $month ){     
        $this->db->select('"0" as Dr');        
        $this->db->select_sum('paid', 'Cr');        
        $this->db->where('status', 'OK' );
        
        if ($month) {            
            $this->db->like('paid_date', "{$year}-{$month}", 'after');
            $this->db->select('DATE_FORMAT(paid_date, "%d %M") as Date');
            $this->db->group_by('Date');
        } else {            
            $this->db->like('paid_date', "{$year}", 'after');
            $this->db->select('DATE_FORMAT(paid_date, "%M") as Date');
            $this->db->group_by('Date');
        }                
        return $this->db->get_compiled_select('donations');                        
    }
    
    public function graph_expenses( $year, $month ){        
        
        $this->db->select_sum('amount','Dr');
        $this->db->select('"0" as Cr');        
        $this->db->where('status', 'OK' );                
        if ($month) {
            $this->db->like('trans_date', "{$year}-{$month}", 'after');
            $this->db->select('DATE_FORMAT(trans_date, "%d %M") as Date');
            $this->db->group_by('Date');
        } else {
            $this->db->like('trans_date', "{$year}", 'after');
            $this->db->select('DATE_FORMAT(trans_date, "%M") as Date');
            $this->db->group_by('Date');
        }
        
        return $this->db->get_compiled_select('expenses');
    }
    
    public function graph( $year, $month ){        
        $incomes    = $this->graph_incomes($year, $month);
        $expenses   = $this->graph_expenses($year, $month);        
        $sql = "{$incomes}  UNION ALL  {$expenses}";
        $sql .= " ORDER BY `Date`  ASC";        
        return $this->db->query( $sql )->result();                
    }

}
