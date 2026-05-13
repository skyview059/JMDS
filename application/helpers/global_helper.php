<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function getShortContent($long_text = '', $show = 100) {

    $filtered_text = strip_tags($long_text);
    if ($show < strlen($filtered_text)) {
        return substr($filtered_text, 0, $show) . '...';
    } else {
        return $filtered_text;
    }
}

function labelStatus($status = 'Active') {
    switch ($status){
        case 'Active':
            $output = '<span class="label label-success">'.$status.'</span>';
            break;
        case 'Inactive':
            $output = '<span class="label label-default">'.$status.'</span>';
            break;
        default:
            $output = '<span class="label label-default">'.$status.'</span>';                            
    }
    return $output;
}

function getLoginUserData($key = '') {
    //key: user_id, user_mail, role_id, name, photo
    $data = & get_instance();
    $prefix = $data->config->item('cookie_prefix');
    $global = json_decode(base64_decode_fk($data->input->cookie("{$prefix}login_data", false)));
    return isset($global->$key) ? $global->$key : 0;
}

function numericDropDown($i = 0, $end = 12, $incr = 1, $selected = 0) {
    $option = '';
    for ($i; $i <= $end; $i+=$incr) {
        $option .= '<option value="' . $i . '"';
        $option .= ( $selected == $i) ? ' selected' : '';
        $option .= '>' . sprintf('%02d', $i) . '</option>';
    }
    return $option;
}

function htmlRadio($name = 'input_radio', $selected = '', $array = ['Male' => 'Male', 'Female' => 'Female']) {
    $radio = '';
    $id = 0;

    if (count($array)) {
        foreach ($array as $key => $value) {
            $id++;
            $radio .= '<label>';
            $radio .= '<input type="radio" name="' . $name . '" id="' . $name . '_' . $id . '"';
            $radio .= ( trim($selected) === $key) ? ' checked ' : '';
            $radio .= 'value="' . $key . '" /> ' . $value;
            $radio .= '&nbsp;&nbsp;&nbsp;</label>';
        }
    }
    return $radio;
}

function selectOptions($selected = '', $array = null) {


    $options = '';
    if (count($array)) {
        foreach ($array as $key => $value) {
            $options .= '<option value="' . $key . '" ';
            $options .= ($key == $selected ) ? ' selected="selected"' : '';
            $options .= '>' . $value . '</option>';
        }
    }
    return $options;
}

/*
 * We will use it into header.php or footer.php or any view page
 * to load module wise css or js file
 */

function load_module_asset($module = null, $type = 'css', $script = null) {

    $file = ($type == 'css') ? 'style.css.php' : 'script.js.php';
    if ($script) {
        $file = $script;
    }

    $path = APPPATH . '/modules/' . $module . '/assets/' . $file;
    if ($module && file_exists($path)) {
        include ($path);
    }
}

//$limit    = 2;
//$start    = getPaginatorStart($limit);
//showPaginator($total_rows, 'admin.php?page=list&p', $limit);


function ageCalculator($date = null) {
    if ($date) {
        $tz = new DateTimeZone('Europe/London');
        $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
                        ->diff(new DateTime('now', $tz))
                ->y;
        return $age . ' years';
    } else {
        return 'Unknown';
    }
}

function sinceCalculator($date = null) {

    if ($date) {

        $date = date('Y-m-d', strtotime($date));
        $tz = new DateTimeZone('Europe/London');
        $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
                ->diff(new DateTime('now', $tz));

        $result = '';
        $result .= ($age->y) ? $age->y . 'y ' : '';
        $result .= ($age->m) ? $age->m . 'm ' : '';
        $result .= ($age->d) ? $age->d . 'd ' : '';
        $result .= ($age->h) ? $age->h . 'h ' : '';
        return $result;
    } else {
        return 'Unknown';
    }
}

function password_encription($string = '') {
    return password_hash($string, PASSWORD_BCRYPT);
}


function get_admin_email() {
    return getSettingItem('IncomingEmail');
}

function getSettingItem($setting_key = null) {
    $ci = & get_instance();
    $setting = $ci->db->get_where('settings', ['label' => $setting_key])->row();
    return isset($setting->value) ? $setting->value : false;
}

function userStatus($selected = null) {
    $status = ['Pending', 'Active', 'Inactive'];
    $options = '';
    foreach ($status as $row) {
        $options .= '<option value="' . $row . '" ';
        $options .= ($row == $selected ) ? 'selected="selected"' : '';
        $options .= '>' . $row . '</option>';
    }
    return $options;
}




function bdDateFormat($data = '0000-00-00') {
    return ($data == '0000-00-00') ? 'Unknown' : date('d/m/y', strtotime($data));
}
function bdDateTimeFormat($data = '0000-00-00') {
    return ($data == '0000-00-00') ? 'Unknown' : date('d M y, h:i a', strtotime($data));
}

function dateTimeFormat($data = '0000-00-00') {
    return bdDateFormat($data);
}
function monthFormat($data = '0000-00-00') {
    return date('M, Y', strtotime($data));
}


function isCheck($checked = 0, $match = 1) {
    $checked = ($checked);
    return ($checked == $match) ? 'checked="checked"' : '';
}

function getCurrency($selected = '&pound') {
    $codes = [
        '&pound' => "&pound; GBP",
        '&dollar' => "&dollar; USD",
        '&nira' => "&#x20A6; NGN"
    ];

    $row = '<select name="data[Setting][Currency]" class="form-control">';
    foreach ($codes as $key => $option) {
        $row .= '<option value="' . htmlentities($key) . '"';
        $row .= ($selected == $key) ? ' selected' : '';
        $row .= '>' . $option . '</option>';
    }
    $row .= '</select>';
    return $row;
}


function billingMonth($datetime = '0000-00-00') {
    if ($datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }

    return date('M-Y', strtotime($datetime));
}

function globalDateTimeFormat($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date('h:i A d/m/y', strtotime($datetime));
}

function invoiceDateFormat($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }
    return date('d M Y h:i A ', strtotime($datetime));
}

function saleDate($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == '') {
        return 'Unknown';
    }

    $date = date('d/m/y', strtotime($datetime));
    $time = date('h:i a', strtotime($datetime));

    return $date . '<br/>' . $time;
}

function globalTimeStamp($datetime = '0000-00-00 00:00:00') {   
    return date('d-M-y - h:i a', strtotime($datetime));
}

function globalDateFormat($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == null) {
        return 'Unknown';
    }
    return date('d-M-y', strtotime($datetime));
}

function globalTimeOnly($datetime = '0000-00-00 00:00:00') {

    if ($datetime == '0000-00-00 00:00:00' or $datetime == '0000-00-00' or $datetime == null) {
        return 'Unknown';
    }
    return date('h:i A', strtotime($datetime));
}

function returnJSON($array = []) {
    return json_encode($array);
}

function ajaxRespond($status = 'FAIL', $msg = 'Fail! Something went wrong') {
    return returnJSON([ 'Status' => strtoupper($status), 'Msg' => $msg]);
}

function ajaxAuthorized() {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower_fk($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        //die( ajaxRespond('Fail', 'Access Forbidden') ); 

        $html = '';
        $html .= '<center>';
        $html .= '<h1 style="color:red;">Access Denied !</h1>';
        $html .= '<hr>';
        $html .= '<p>It seems that you might come here via an unauthorised way</p>';
        $html .= '</center>';

        die($html);
    }
}

function globalCurrencyFormat($string = 0, $prefix = '৳ ', $sufix = '') {

    if (is_null($string) or empty($string)) {
        return 0 . $sufix;
    } else {        
        return number_format($string, 0) . $sufix;
    }
}
function BDT($tk = 0) {
    if(is_null($tk)){
        return 0;
    }
    switch ($tk){
        case '0':
            return 0;
        default :
            return Currency::formatAsBDT($tk, '/=');
    }    
}

function bdContactNumber($contact = null) {

    if ($contact && strlen($contact) == 11) {
        return substr($contact, 0, 5) . '-' . substr($contact, 5, 3) . '-' . substr($contact, 8, 3);
    } else {
        return $contact;
    }
}

function getPaginatorLimiter($selected = 100) {
    $range = [100, 500, 1000, 2000, 5000];
    $option = '';
    foreach ($range as $limit) {
        $option .= '<option';
        $option .= ( $selected == $limit) ? ' selected' : '';
        $option .= '>' . $limit . '</option>';
    }
    return $option;
}

function dd($string = 0) {
    echo '<pre>';
    print_r($string);
    echo '</pre>';
    exit;
}

function pp($string = 0) {
    echo '<pre>';
    print_r($string);
    echo '</pre>';    
}

function printTimeStamp(){
    return '<p>Print: '. date('d M y - h:i a') .'</p>'; 
}


function upload_file($input_name, $folder = './uploads/folder', $force_name = false) {
    $uploaded_file_name_with_path = '';
    $handle = new upload($_FILES[$input_name]);

    if($force_name){
        $handle->file_new_name_body = $force_name;
    } else {
        $handle->file_new_name_body = md5(time() . rand(1, 2));
    }
    
    if ($handle->uploaded) {
        $handle->process($folder);
        if ($handle->processed) {
            $uploaded_file_name_with_path = $handle->file_dst_pathname;
            $handle->clean();
        }
    }
    return $uploaded_file_name_with_path;
}

function removeFile($full_path = false){
    $filename = dirname( APPPATH ) .'/'. $full_path;
    if( $full_path && file_exists($filename)){            
        unlink($filename);
    }    
}

function getDropDownCountries($country_id = 0) {

    $array = [
        ['id' => 17, 'name' => 'Banglaesh'],
    ];

    
    $make_as_db = json_encode( $array );
    $countries = json_decode( $make_as_db );

    $options = '<option value="">--Select Country--</option>';
    foreach ($countries as $country) {
        $options .= '<option value="' . $country->id . '" ';
        $options .= ($country->id == $country_id ) ? 'selected="selected"' : '';
        $options .= '>' . $country->name . '</option>';
    }
    return $options;
}

function getCountryName() {
    return 'Bangladesh';
}

function build_pagination_url( $link = 'search', $page = 'page', $ext = false ){        
    $ci =& get_instance();
    $array  = $ci->input->get();
    $url    = $link . '?';

    unset($array[$page]);
    unset($array['_']);

    if($array){
       $url .= \http_build_query($array);
    }
    if($ext){ $url    .= "&{$page}"; }
    return $url;       
}


function time_count($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) { $string = array_slice($string, 0, 1); }
    return $string ? implode(', ', $string) . ' ago' : 'Just Now';
}

function getDonationValue($date=''){
    $ci =& get_instance();        
    $ci->db->select_sum('paid');
    $ci->db->from('donations');
    if($date){ $ci->db->where('paid_date >=', "{$date}"); }    
    $ci->db->where('status', 'OK');
    $items = $ci->db->get()->row();    
    return $items->paid;
}

function getExpanseValue($date = ''){
    $ci =& get_instance();        
    $ci->db->select_sum('amount');
    $ci->db->from('expenses');
    if($date){ $ci->db->where('trans_date >=', "{$date}"); }
    $ci->db->where('status', 'OK');
    $items = $ci->db->get()->row();    
    return $items->amount;
}

function getMonthDropDown($selected=0, $label = '--All-'){
    $months = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];
    $options = '<option value="0">' . $label . '</option>';
    foreach ($months as $m_id => $m_name ) {
        $options .= '<option value="' . $m_id . '" ';
        $options .= ($m_id == $selected ) ? ' selected="selected"' : '';
        $options .= '>' . $m_name . '</option>';                
    }
    return $options;
}

function GetOptions($tbl, $column, $condition = NULL, $selected = 0) {
    // $condition = 'WHERE id = 2 OR id = 3';
    // $column = ['column1','$clumn2']
    $ci = & get_instance();
    $results = $ci->db->query("SELECT * FROM {$tbl} " . ($condition ? $condition : '') . ";");
    $html = '';
    if (!$results->result()) {
        return '<option value="0">--No Data--</options>';
    } 
    
    foreach ($results->result() as $sm) {
        $html .= '<option value="' . $sm->id . '" ';
        $html .= ($selected == $sm->id ? 'Selected' : '');
        $html .= ' >';
        if (is_array($column)) {
            for ($i = 0; $i < count($column); $i++) {
                $html .= $sm->$column[$i];
                $html .= ' ';
            }
            $html = rtrim($html,' ');
        } else {
            $html .= $sm->$column;
        }
    } 

    $html .= '</option>';
   
    return $html;
}