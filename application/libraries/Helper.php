<?php

/** @author Kanny */
class Helper {
    public static function buildMonths($selected=''){
        $months = array(
            date('Y-m-1', strtotime('-3 months')) => date('M, Y', strtotime('-3 months')),
            date('Y-m-1', strtotime('-2 months')) => date('M, Y', strtotime('-2 months')),
            date('Y-m-1', strtotime('-1 months')) => date('M, Y', strtotime('-1 months')),
            date('Y-m-1') => date('M, Y'),
            date('Y-m-1', strtotime('+1 months')) => date('M, Y', strtotime('+1 months')),
            date('Y-m-1', strtotime('+2 months')) => date('M, Y', strtotime('+2 months')),
            date('Y-m-1', strtotime('+3 months')) => date('M, Y', strtotime('+3 months')),
        );
        
        foreach ($months as $month => $label ) {
            $row .= "<option value=\"{$month}\"";
            $row .= ($selected == $month ) ? ' selected' : '';            
            $row .= ">{$label}</option>";
        }
        return $row;
    }

    public static function getMonthlyOverview($month = 0) {
        $ci = & get_instance();
        $ci->db->select('count(*) as qty');
        $ci->db->select_sum('total_bill');
        $ci->db->select_sum('discount');
        $ci->db->select_sum('paid');
        $ci->db->where('month', $month);
        $summery = $ci->db->get('subscriber_bills')->row();
        
        if($summery){
            return $summery;
        } else {
            return (object)['bill' => 0, 'discount' => 0, 'paid' => 0, 'qty' => 0];
        }
    }
    
    public static function getUserName($user_id = 0) {
        $ci = & get_instance();
        
        $ci->db->select('first_name,last_name');
        $ci->db->where('id', $user_id);
        $user = $ci->db->get('users')->row();
        
        if($user){
            return $user->first_name .' '. $user->last_name;
        } else {
            return 'Unknown #ID-' . $user_id;
        }
    }
        
    public static function getAreaName($id = 0) {
        return self::getSingleColumnName('service_areas', 'bn_name', $id);
    }
    
    public static function getDropDownArea($id = 0, $label = '--Select--') {
        return self::getTableToSelector('service_areas', 'bn_name', $label, $id);
    }
    
    public static function donationHeads($id = 0, $label = '--Select--') {
        return self::getTableToSelector('donation_heads', 'name', $label, $id);
    }
    
    public static function getDropDownHead($type = 'Head', $select = 0, $label = '--Select--' ) {
                
        $ci = & get_instance();
        $ci->db->select('id,name');
        $ci->db->where('type', $type );
        $heads = $ci->db->get('expense_heads')->result();  
        $row = '<option value="0">' . $label . '</option>';
        $sl = 0;
        foreach ($heads as $head) {
            $sl++;
            $row .= "<option value=\"{$head->id}\"";
            $row .= ($select == $head->id ) ? ' selected' : '';            
            $row .= ">{$head->name}</option>";
        }
        return $row;
        
    }
    
    
    public static function donorName($id = 0) {
        return self::getSingleColumnName('donors', 'name', $id);
    }
    
    public static function getDonationDropDown( $area_id = 0, $label = '--Select--' ) {
                
        $ci = & get_instance();
        $ci->db->select('id,name,add_line1,contact');
        if($area_id){ $ci->db->where('area_id', $area_id) ; }
        $subscribers = $ci->db->get('donors')->result();  
        $row = '<option value="0">' . $label . '</option>';
        $sl = 0;
        foreach ($subscribers as $subs) {
            $sl++;
            $row .= "<option value=\"{$subs->id}\">";
            $row .= $sl .'. ';
            if($area_id ==0 ){
                $row .= $subs->add_line1 . ', ';
            }
            $row .= $subs->name . ', '. $subs->contact;
            $row .= '</option>';
        }
        return $row;
        
    }
    
    public static function getLoginUsers() {
        $row = '';
        $ci = & get_instance();        
        $d = ($ci->input->get('d')) ? false : true;        
        $ci->db->select('email,first_name,last_name');        
        if($d){ $ci->db->where('role_id !=', 1 ); }        
        $users = $ci->db->get('users')->result();        
        foreach ($users as $user) {
            $row .= "<option value=\"{$user->email}\">";
            $row .= $user->first_name .' '. $user->last_name;
            $row .= '</option>';
        }
        return $row;
    }
    
    public static function getUserDropDown($id = 0, $label = '--Select--') {
        $ci = & get_instance();
        $ci->db->select('id,first_name,last_name');
        $role_id = getLoginUserData('role_id');
        if($role_id != 1){ $ci->db->where('role_id !=', 1); }
        $users = $ci->db->get('users')->result();            
        $row = '<option value="0">' . $label . '</option>';
        foreach ($users as $user) {
            $row .= '<option value="' . $user->id . '"';
            $row .= ($id == $user->id ) ? ' selected' : '';
            $row .= '>'. $user->first_name .' '. $user->last_name .'</option>';
        }
        return $row;
    }
                        
    public static function getTableToSelector($table, $column, $label, $selected = 0, $get_where_col = false, $get_where_val = 0) {
        $ci = & get_instance();
        $exists = $ci->db->table_exists($table);

        $row = '<option value="0">' . $label . '</option>';
        if ($exists) {
            if ($get_where_col) {
                $results = $ci->db->get_where($table, [$get_where_col => $get_where_val])->result();
            } else {
                $results = $ci->db->get($table)->result();
            }

            foreach ($results as $result) {
                $row .= '<option value="' . $result->id . '"';
                $row .= ($selected == $result->id ) ? ' selected' : '';
                $row .= '>';
                $row .= ($result->$column) ? $result->$column : '-- ID#' . $result->id;
                $row .= '</option>';
            }

            if (count($results) == 0) {
                $row .= '<option ="0">No Item Found</p>';
            }
        } else {
            $row .= '<option>-: Tbl ' . $table . ' Not Exists :-</option>';
        }
        return $row;
    }

    private static function getSingleColumnName($table, $column, $id = 0) {
        $ci = & get_instance();
        $exists = $ci->db->table_exists($table);

        if ($exists) {
            $result = $ci->db->get_where($table, ['id' => $id])->row();
            if ($result) {
                return $result->$column;
            }
        } else {
            return '-: Tbl ' . $table . ' Not Exists :-';
        }
    }
    
    static public function rate($bill,$qty){
        $rate = ($bill / $qty);
        
        if($rate == 150 || $rate == 100 ){
            return '-';
        } else {
            return 'Problem';
        }
    }
}
