<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 21th Nov 2022
 */

class Report extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Expense_model');
        $this->load->helper('expense');
        $this->load->library('form_validation');
    }

    public function index(){

        
        
        /* SELECT SUM(paid) FROM `donations` WHERE collected_by = 1 AND status = 'OK'; */        
        /* SELECT * FROM `donations` WHERE DATE_FORMAT(month, "%Y-%m") = '2020-01'; */
        
        
        /* SELECT DATE_FORMAT(month, "%Y-%M") as mon2, SUM(paid) as income FROM `donations` WHERE status = 'OK' GROUP BY DATE_FORMAT(month, "%Y-%M"); */

        
        $year = (int) $this->input->get('year');
        if(empty($year)){ $year = date('Y'); }
        
        $user_id = (int) $this->input->get('user_id');
        if(empty($user_id)){ $user_id = 2; }
        
        $this->db->select('DATE_FORMAT(month, "%Y-%M") as n_month, SUM(paid) as cr');
        $this->db->where('collected_by', $user_id );        
        $this->db->where('DATE_FORMAT(month, "%Y") = ', $year, false );  
        $this->db->group_by('DATE_FORMAT(month, "%Y-%M")');   		
        $incomes = $this->db->get('donations')->result();
        
        
        $this->db->select('DATE_FORMAT(trans_date, "%Y-%M") as n_month, SUM(amount) as dr');
        $this->db->where('user_id', $user_id );        
        $this->db->where('user_id', $user_id );        
        $this->db->where('DATE_FORMAT(trans_date, "%Y") =', $year, false ); 
        $this->db->group_by('DATE_FORMAT(trans_date, "%Y-%M")');        		
        $expenses = $this->db->get('expenses')->result(); 
        

        $data = array(
            'incomes' => $incomes,
            'expenses' => $expenses,
            'dr_sl' => 0,
            'cr_sl' => 0,
            'total_dr' => 0,
            'total_cr' => 0,
            'user_id' => $user_id,
            'min_year' => date('Y', strtotime('-2 Year')),
            'max_year' => date('Y', strtotime('+1 Year')),
            'year' => $year,
            
        );
        
        $this->viewAdminContent('expense/expense/report', $data);
    }

    
}