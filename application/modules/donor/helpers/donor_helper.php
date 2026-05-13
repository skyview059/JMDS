<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function donorTabs($id, $active_tab) {
    $html = '<ul class="tabsmenu">';
    $tabs = [
        'stmt' => 'Statement',
        'profile' => 'Details',
        'update' => 'Update',
        'delete' => 'Delete'
    ];

    foreach ($tabs as $link => $tab) {
        $html .= '<li><a href="' . Backend_URL . "donor/{$link}/{$id}\"";
        $html .= ($link == $active_tab ) ? ' class="active"' : '';
        $html .= '>' . $tab . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}

function findOutMissingMonths($donor_id = null, $year = 2019, $reg_date = NULL) {
    $all_month = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];
    $ci = & get_instance();
    $p_months = $ci->db->select('DATE_FORMAT(donations.month, "%b") AS month')
                    ->from('donations')
//                    ->join('donors','donors.id=donations.donor_id')
//                    ->where('donors.reg_date >=',$reg_date)
                    ->where(['donations.donor_id' => $donor_id, 'donations.status' => 'OK'])
                    ->like('donations.month', $year . '-')
                    ->get()->result();
//    echo $ci->db->last_query();
//    dd($p_months);
    $result = [];
    foreach ($p_months as $month) {
        $result[] = $month->month;
    }
    
    // removeing next month.
    if (date('Y') == $year) {
        $tem = date('Y-m-d');
        $left = date('m', strtotime(date("Y-12-31"))) - date('m', strtotime($tem));
        for ($i = 1; $i <= $left; $i++) {
            $tem = date("Y-m-d", strtotime($tem . " + 1 month"));
            $result[] = date("M", strtotime($tem));
        }
    }
    
    //removing month before registered.
    $months = array_diff($all_month, $result);
    $regMonth = date("M",strtotime($reg_date));
    foreach ($months as $k => $m) {
        if ($m == $regMonth) {
            break;
        }
        unset($months[$k]);
    }
    
    $data['count'] = count($months);
    $data['months'] = implode(', ', $months);
    return $data;
}
