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
            $data['collections'] = $this->collectores_collections( $setDate );
            
            $data['today']      = getDonationValue(date('Y-m-d'));
            $data['this_week']  = getDonationValue(date('Y-m-d', strtotime('-7 days')));
            $data['this_month'] = getDonationValue(date('Y-m-01'));
            $data['this_year']  = getDonationValue(date('Y-01-01'));
            $data['till_now']   = getDonationValue();

            $data['today_exp']      = getExpanseValue(date('Y-m-d'));
            $data['this_week_exp']  = getExpanseValue(date('Y-m-d', strtotime('-7 days')));
            $data['this_month_exp'] = getExpanseValue(date('Y-m-01'));
            $data['this_year_exp']  = getExpanseValue(date('Y-01-01'));
            $data['till_now_exp']   = getExpanseValue();                        
            
            $this->viewAdminContent('dashboard', $data);
        } else {
            $data['collections'] = $this->collection_report(  $setDate );        
            $this->viewAdminContent('collector', $data);
        }
    }
    
    public function get_report( $setDate ){
        $data['Collector']  = $this->collectores_collections( $setDate );
        
        echo json_encode($data);
    }

    private function area_wise_collection( $setDate ){
        
        $this->db->select_sum('paid');
        $this->db->where('area_id = sa.id');
        $this->db->where('paid_date', $setDate );
        $this->db->where('status', 'Paid' );
        $sql = $this->db->get_compiled_select('subscriber_bills as b');  
                        
        $this->db->select("sa.*, ({$sql}) as paid");
        $this->db->from('service_areas as sa');
        $areas = $this->db->get()->result();
        
        $total = 0;
        $tbl = '<table class="table table-bordered table-striped table-condensed">';
        $tbl .= '<tr>';
        $tbl .= "<th width='40'>S/L</th>";
        $tbl .= "<th>Name of Area</th>";
        $tbl .= "<th width='90' class='text-right'>Collected TK</th>";            
        $tbl .= '</tr>';
        foreach($areas as $area){
            $total += (int)  $area->paid;
            $id = sprintf('%02d', $area->id);
            $tbl .= '<tr>';
            $tbl .= "<td>{$id}</td>";                        
            $tbl .= "<td><a href=\"bill/report?date={$setDate}&area_id={$id}\" target='_blank'>";
            $tbl .= "{$area->bn_name}";
            $tbl .= '</a></td>';                        
            $tbl .= "<td class='text-right'>". BDT( (int) $area->paid). "</td>";            
            $tbl .= '</tr>';
        }
        $tbl .= '<tr>';
        $tbl .= "<th></th>";
        $tbl .= "<th class='text-right'>Day Total =</th>";
        $tbl .= "<th class='text-right'>". BDT( $total ). "</th>";
        $tbl .= '</tr>';                
        $tbl .= '</table>';
                
        return $tbl;
    }
         
    private function collectores_collections( $setDate ){
        
        // $this->db->select_sum('paid');
        // $this->db->where('collected_by = u.id');
        // $this->db->where('paid_date', $setDate );
        // $this->db->where('status', 'OK' );
        // $sql = $this->db->get_compiled_select('donations');  
                        
        $this->db->select("u.id,u.first_name,u.last_name, (0) as paid");
        $this->db->from('users as u');
        if($this->role_id != 1){ $this->db->where('u.id >=',2); }        
        $users = $this->db->get()->result();
        
        $total = 0;
        $tbl = '<table class="table table-bordered table-striped table-condensed">';
        $tbl .= '<tr>';
        $tbl .= "<th width='40'>S/L</th>";
        $tbl .= "<th>Operator Name</th>";
        $tbl .= "<th width='90' class='text-right'>Collected TK</th>";            
        $tbl .= '</tr>';
        $sl = 0;
        foreach($users as $user){
            $total += (int)  $user->paid;
            $id = sprintf('%02d', ++$sl );
            $tbl .= '<tr>';
            $tbl .= "<td>{$id}</td>";
            $tbl .= "<td><a href=\"report\" target='_blank'>";
            $tbl .= "{$user->first_name} {$user->last_name}";
            $tbl .= '</a></td>';
            $tbl .= "<td class='text-right'>". BDT( (int) $user->paid). "</td>";            
            $tbl .= '</tr>';
        }
        $tbl .= '<tr>';
        $tbl .= "<th></th>";
        $tbl .= "<th class='text-right'>Day Total =</th>";
        $tbl .= "<th class='text-right'>". BDT( $total ). "</th>";
        $tbl .= '</tr>';                
        $tbl .= '</table>';
        
        return $tbl;
    }
        
    public function collection_report( $paid_date ){
                
        $this->db->select('log.id,log.donor_id,log.month,log.paid');
        $this->db->select('d.name as donor_name');
        $this->db->from('donations as log');
        $this->db->join('donors as d','d.id=log.donor_id','LEFT');
        $this->db->where('log.status', 'OK');
        $this->db->where('paid_date', $paid_date);
        $this->db->where('collected_by', $this->user_id );        
        $bills = $this->db->get()->result();
        
        $total = 0;
        $tbl = '<table class="table table-bordered table-striped table-condensed">';
        $tbl .= '<tr>';
        $tbl .= "<th width='50'>Tx.ID</th>";
        $tbl .= "<th>Donoar Name</th>";
        $tbl .= "<th>Month of Donation</th>";
        $tbl .= "<th width='90' class='text-right'>Paid TK</th>";            
        $tbl .= '</tr>';
        foreach($bills as $bill){
            $total += (int)  $bill->paid;                        
            $tbl .= '<tr>';
            $tbl .= '<td>'. sprintf('%02d', $bill->id) .'</td>';
            $tbl .= '<td>'. $bill->donor_name .'</td>';
            $tbl .= '<td>'. billingMonth($bill->month) .'</td>';            
            $tbl .= "<td class='text-right'>". BDT( (int) $bill->paid). "</td>";            
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