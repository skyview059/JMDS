<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function getSmsTemplate($id) {
    $ci =& get_instance();
    $ci->db->where('id',$id);
    $sms = $ci->db->get('sms_templates')->row();
    if($sms){
        return $sms->body;
    } else {
        return 'No Body Found';
    }
}

function getDonorMobile($id) {
    $ci =& get_instance();
    $ci->db->select('contact');
    $ci->db->where('id',$id);
    $donor = $ci->db->get('donors')->row();
    if($donor){
        return $donor->contact;
    } else {
        // as fall back number to report delveloper
        return '01713900423';         
    }
}

function getAllDonorMobileNumber() {
    $ci =& get_instance();
    $ci->db->select('contact');    
    $ci->db->where('status','Active');
    //$ci->db->where_in('id', [58,97]);
    $donors = $ci->db->get('donors')->result();
    $sms_qty = 0;
    $mobile = [];
    foreach ($donors as $donor){
        if(mb_strlen($donor->contact) == 11){
            ++$sms_qty;
            $mobile[] = fix88($donor->contact);
        }
    }
    return [
        'sms_qty' => $sms_qty,
        'mobiles' => implode(',', $mobile),
    ];
}

function fix88($phone) {    
    if(substr($phone,0,2) == 88){
        return $phone;
    }
    return "88{$phone}";
}

function save_sms_log_in_db($id,$mobile,$sms_body,$respond){
    $data = [
        'donor_id'  => $id,
        'phone'     => $mobile,
        'body'      => $sms_body,
        'respond'   => $respond,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    $ci =& get_instance();
    $ci->db->insert('sms_log',$data);
}
