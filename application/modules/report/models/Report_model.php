<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends Fm_model {

    public $table = 'learners';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct() {
        parent::__construct();
    }

    public function users(){
        $income = $this->getTransUserAmount( 'Cr' ); 
        $expense = $this->getTransUserAmount( 'Dr' ); 
                        
        $this->db->select('u.id, u.full_name');
        $this->db->select("({$income}) as cr_tk, ({$expense}) as dr_tk");
        $this->db->from('users as u');
        if($this->role_id != 1){ $this->db->where('u.id >=',2); }        
        return $this->db->get()->result();
    }

    private function getTransUserAmount( $nature = 'Dr' ){        
        return $this->db->select_sum('amount')
            ->where('user_id','u.id', false)            
            ->where('tx_status', 1)
            ->where('nature', $nature )
            ->get_compiled_select('transactions');  
    }
    private function getTransHeadAmount( $nature = 'Dr' ){        
        return $this->db->select_sum('amount')
            ->where('head_id','h.id', false)            
            ->where('tx_status', 1)
            ->where('nature', $nature )
            ->get_compiled_select('transactions');  
    }
    
    public function trans_summary(){
        
        $setDate = date('Y-m-d', strtotime('-1 day'));
        $dr_tk = $this->getTransHeadAmount( 'Dr' );
        $cr_tk = $this->getTransHeadAmount( 'Cr' );
                        
        $this->db->select("h.*, ({$dr_tk}) as dr_tk");
        $this->db->select("({$cr_tk}) as cr_tk");
        $this->db->from('trans_heads as h');       
        return $this->db->get()->result();
    }
    
    
    
    public function incomes( $month ){
        
        $this->db->select_sum('amount', 'paid');
        $this->db->where('head_id = h.id');
        $this->db->where('nature', 'Cr' );
        $this->db->like('tx_date', $month, 'after' );
        $sql = $this->db->get_compiled_select('transactions');  
                        
        $this->db->select("h.*, ({$sql}) as paid");
        $this->db->from('trans_heads as h');       
        return $this->db->get()->result();
    }
    
    public function expenses( $month ){
        
        $this->db->select_sum('amount');
        $this->db->where('head_id = h.id');
        $this->db->where('nature', 'Dr' );
        $this->db->like('tx_date', $month, 'after' );
        $sql = $this->db->get_compiled_select('transactions');  
                        
        $this->db->select("h.*, ({$sql}) as paid");
        $this->db->from('trans_heads as h');  
        return $this->db->get()->result();
    }
    
    
    public function graph_incomes( $year, $month ){     
        $this->db->select('"0" as Dr');        
        $this->db->select_sum('amount', 'Cr');
        $this->db->select('DATE_FORMAT(tx_date, "%d") as Day');        
        $this->db->where('nature', 'Cr' );
        
        if ($month) {            
            $this->db->like('tx_date', "{$year}-{$month}", 'after');
            $this->db->select('DATE_FORMAT(tx_date, "%d %M") as Date');
            $this->db->group_by('Date');
        } else {            
            $this->db->like('tx_date', "{$year}", 'after');
            $this->db->select('DATE_FORMAT(tx_date, "%M") as Date');
            $this->db->group_by('Date');
        }                
        return $this->db->get('transactions')->result();                        
    }
    
    public function graph_expenses( $year, $month ){        
        
        $this->db->select_sum('amount','Dr');
        $this->db->select('"0" as Cr');        
        $this->db->where('nature', 'Dr' );
        $this->db->select('DATE_FORMAT(tx_date, "%d") as Day');
        if ($month) {
            $this->db->like('tx_date', "{$year}-{$month}", 'after');
            $this->db->select('DATE_FORMAT(tx_date, "%d %M") as Date');
            $this->db->group_by('Date');
        } else {
            $this->db->like('tx_date', "{$year}", 'after');
            $this->db->select('DATE_FORMAT(tx_date, "%M") as Date');
            $this->db->group_by('Date');
        }
        
        return $this->db->get('transactions')->result();
    }
    
    public function graph( $year, $month ){        
        $incomes    = $this->graph_incomes($year, $month);
        $expenses   = $this->graph_expenses($year, $month);        
           
        $data1 = [];
        foreach($incomes as $inc ){
            $data1[$inc->Day] = [
                'Date' => $inc->Date,
                'Dr' => 0,
                'Cr' => $inc->Cr,
            ]; 
        }
        
        $data2 = [];
        foreach($expenses as $exp ){
            $data2[$exp->Day] = [
                'Date' => $exp->Date,
                'Dr' => $exp->Dr,
                'Cr' => 0,
            ]; 
        }
        return array_merge($data1,$data2);
    }

}
