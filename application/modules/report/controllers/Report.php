<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2018-12-01
 */

class Report extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Report_model');
    }

    public function index(){        
        $setDate        = date('Y-m-d', strtotime('-1 day'));
        $data['users']  = $this->Report_model->users( $setDate );         
        $data['incomes']  = $this->Report_model->head_income();
        $data['expenses']  = $this->Report_model->head_expense( );         
                
        $this->viewAdminContent('report/index', $data);
    }
    
    public function print_view(){
        $year   = ( $this->input->get('y') ) ? (int) $this->input->get('y') : date('Y');
        $month  = ( $this->input->get('m') ) ? (int) $this->input->get('m') : date('m');
        $y_m    = "{$year}-" . sprintf('%02d', $month);
        
        $data   = [
            'incomes'   => $this->Report_model->incomes( $y_m ),
            'expenses'  => $this->Report_model->expenses( $y_m ),
            'year'      => $year,
            'month'     => $month,
            'min_year'  => 2019,
            'max_year'  => date('Y'),
            'label'     => $this->getMonthName( $month ) . ' ' . $year,
        ];
                        
        $this->viewAdminContent('report/print', $data);
    }
    
    
    
    public function graph() {

        $year   = ($this->input->get('year')) ? $this->input->get('year') : 2019;
        $month  = ($this->input->get('month')) ? sprintf('%02d', $this->input->get('month')) : 0;

        $data['days']    = $this->Report_model->graph($year,$month);
        $data['year']       = $year;
        $data['month']      = $month;
        

        $this->viewAdminContent('report/graph', $data);
    }

    
    public function _menu(){        
        return buildMenuForMoudle([
            'module'    => 'Report',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'report',                    
            'children'  => [
                [
                    'title' => 'Summery',
                    'icon'  => 'fa fa-bar-chart-o',
                    'href'  => 'report'
                ],[
                    'title' => 'Print View',
                    'icon'  => 'fa fa-print',
                    'href'  => 'report/print_view'
                ]
            ]        
        ]);
    }
    
    private function getMonthName($m){
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];        
        return $months[ (int) $m ];
    }
}