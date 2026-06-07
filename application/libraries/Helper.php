<?php

/** @author Kanny */
class Helper {

    public static function getTransAmount( $setDate, $nature = 'Dr' ){        
        return get_instance()->db->select_sum('amount')
            ->where('user_id','u.id', false)
            ->where('tx_date', $setDate )
            ->where('tx_status', 1)
            ->where('nature', $nature )
            ->get_compiled_select('transactions');  
    }

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

   
    
    public static function getUserName($user_id = 0) {            
        $user = get_instance()->db
                    ->select('full_name')
                    ->where('id', $user_id)
                    ->get('users')->row();             
        return ($user) ? $user->full_name : "Unknown #ID-{$user_id}";        
    }
    
    public static function donationHeads($id = 0, $label = '--Select--') {
        return self::getTableToSelector('trans_heads', 'name', $label, $id);
    }
    
    public static function getDropDownHead($type = 'Head', $select = 0, $label = '--Select--' ) {
                
        $ci = & get_instance();
        $ci->db->select('id,name');
        $ci->db->where('type', $type );
        $heads = $ci->db->get('trans_heads')->result();  
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
    
    public static function getLoginUsers() {
        $row = '';
        $ci = & get_instance();        
        $d = ($ci->input->get('d')) ? false : true;        
        $ci->db->select('email,full_name');        
        if($d){ $ci->db->where('role_id !=', 1 ); }        
        $users = $ci->db->get('users')->result();        
        foreach ($users as $user) {
            $row .= "<option value=\"{$user->email}\">";
            $row .= $user->full_name;
            $row .= '</option>';
        }
        return $row;
    }
    
    public static function getUserDropDown($id = 0, $label = '--Select--') {
        $ci = & get_instance();
        $ci->db->select('id,full_name');
        $role_id = getLoginUserData('role_id');
        if($role_id != 1){ $ci->db->where('role_id !=', 1); }
        $users = $ci->db->get('users')->result();            
        $row = '<option value="0">' . $label . '</option>';
        foreach ($users as $user) {
            $row .= '<option value="' . $user->id . '"';
            $row .= ($id == $user->id ) ? ' selected' : '';
            $row .= '>'. $user->full_name .'</option>';
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
}
