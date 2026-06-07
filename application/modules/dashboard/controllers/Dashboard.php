<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_controller {    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('dashboard');                
    }
    
    public function index(){ 
        
        $setDate = date('Y-m-d');
        $data['date'] = $setDate;                                
        
        if(in_array($this->role_id, array(1,2,3))){
            $data['collections'] = $this->collectors_collections( $setDate );
            
            $data['today']      = getIncomeAmount(date('Y-m-d'));
            $data['this_week']  = getIncomeAmount(date('Y-m-d', strtotime('-7 days')));
            $data['this_month'] = getIncomeAmount(date('Y-m-01'));
            $data['this_year']  = getIncomeAmount(date('Y-01-01'));
            $data['till_now']   = getIncomeAmount();

            $data['today_exp']      = getExpanseAmount(date('Y-m-d'));
            $data['this_week_exp']  = getExpanseAmount(date('Y-m-d', strtotime('-7 days')));
            $data['this_month_exp'] = getExpanseAmount(date('Y-m-01'));
            $data['this_year_exp']  = getExpanseAmount(date('Y-01-01'));
            $data['till_now_exp']   = getExpanseAmount();                        
            
            $this->viewAdminContent('dashboard', $data);
        } else {
            $data['collections'] = $this->collection_report(  $setDate );        
            $this->viewAdminContent('collector', $data);
        }
    }
    
    public function get_report( $setDate ){
        $data['Collector']  = $this->collectors_collections( $setDate );
        
        echo json_encode($data);
    }

    private function collectors_collections( $setDate ){

        $sql_dr = $this->getTransAmount( $setDate, 'Dr' );  
        $sql_cr = $this->getTransAmount( $setDate, 'Cr' );  
                        
        $this->db->select("u.id, u.full_name, ({$sql_dr}) as dr");
        $this->db->select("({$sql_cr}) as cr");
        $this->db->from('users as u');
        if($this->role_id != 1){ $this->db->where('u.id >=',2); }        
        $users = $this->db->get()->result();

        // echo $this->db->last_query();
        // exit;
        
        $total_dr = $total_cr = 0;
        $tbl = '<table class="table table-bordered table-striped table-condensed">';
        $tbl .= '<tr>';
        $tbl .= "<th width='40'>S/L</th>";
        $tbl .= "<th>Operator Name</th>";
        
        $tbl .= "<th width='90' class='text-right'>Expense TK</th>";
        $tbl .= "<th width='90' class='text-right'>Income TK</th>";
        $tbl .= '</tr>';
        $sl = 0;
        foreach($users as $user){
            $total_dr += (int)  $user->dr;
            $total_cr += (int)  $user->cr;
            $id = sprintf('%02d', ++$sl );
            $tbl .= '<tr>';
            $tbl .= "<td>{$id}</td>";
            $tbl .= "<td><a href=\"report\" target='_blank'>";
            $tbl .= "{$user->full_name}";
            $tbl .= '</a></td>';
            $tbl .= "<td class='text-right'>". BDT( (int) $user->dr). "</td>";            
            $tbl .= "<td class='text-right'>". BDT( (int) $user->cr). "</td>";            
            $tbl .= '</tr>';
        }
        $tbl .= '<tr>';
        $tbl .= "<th></th>";
        $tbl .= "<th class='text-right'>Day Total =</th>";
        $tbl .= "<th class='text-right'>". BDT( $total_dr ). "</th>";
        $tbl .= "<th class='text-right'>". BDT( $total_cr ). "</th>";
        $tbl .= '</tr>';                
        $tbl .= '</table>';
        
        return $tbl;
    }

    private function getTransAmount( $setDate, $nature = 'Dr' ){
        return Helper::getTransAmount( $setDate, $nature );
    }
        
    public function collection_report( $paid_date ){
                
        $this->db->select('log.id,log.amount,log.tx_date');
        $this->db->select('u.full_name as user_name');
        $this->db->from('transactions as log');
        $this->db->join('users as u','u.id=log.user_id','LEFT');
        $this->db->where('log.tx_status', 1);
        $this->db->where('log.nature', 'Cr');
        $this->db->where('log.tx_date', $paid_date);
        $this->db->where('log.user_id', $this->user_id );        
        $bills = $this->db->get()->result();
        
        $total = 0;
        $tbl = '<table class="table table-bordered table-striped table-condensed">';
        $tbl .= '<tr>';
        $tbl .= "<th width='50'>Tx.ID</th>";
        $tbl .= "<th>User Name</th>";
        $tbl .= "<th>Transaction Date</th>";
        $tbl .= "<th width='90' class='text-right'>Amount TK</th>";            
        $tbl .= '</tr>';
        foreach($bills as $bill){
            $total += (int)  $bill->amount;                        
            $tbl .= '<tr>';
            $tbl .= '<td>'. sprintf('%02d', $bill->id) .'</td>';
            $tbl .= '<td>'. $bill->user_name .'</td>';
            $tbl .= '<td>'. $bill->tx_date .'</td>';            
            $tbl .= "<td class='text-right'>". BDT( (int) $bill->amount). "</td>";            
            $tbl .= '</tr>';
        }
        $tbl .= '<tr>';
        $tbl .= "<th></th>";
        $tbl .= "<th></th>";
        $tbl .= "<th class='text-right'>Day Total =</th>";
        $tbl .= "<th class='text-right'>". BDT( $total ). "</th>";
        $tbl .= '</tr>';                
        $tbl .= '</table>';
                
        return $tbl;
    }
            
}