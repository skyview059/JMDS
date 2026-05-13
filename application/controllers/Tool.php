<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tool extends Admin_controller {
    // every thing coming form Frontend Controller

    public function fix_package(){        
        exit('__Remove Exit Comment__');                  
        $file_data = file_get_contents( __DIR__ . '/subscribers.txt');
        
        $list = ( explode("\n", $file_data));
                
        $data = array();
        foreach($list as $row ){
            $split = ( explode("\t", trim($row)));
            $data[] = array(
                'id'         => $split[0],
                'package_id' => $split[1],
                'status'     => $split[2],
            );
        }
                
        if(count($data)){
            $this->db->update_batch('subscribers', $data, 'id');  
            echo '<p>Package Updated Successfully.</p>';
        } else {
            echo '<p>Package Update Fail!.</p>';
        } 
    }
    
    public function exec_sql(){ 
        dd('Only For Update MySQL Stracture ');
        
        
        // Created New Table Throw Query....
        
//        $create = 'CREATE TABLE `bill_changes_log` (
//                    `id` int(11) NOT NULL,
//                    `bill_id` int(11) NOT NULL,
//                    `user_id` int(11) NOT NULL,
//                    `timestamp` datetime NOT NULL,
//                    `json_data` varchar(2000) NOT NULL
//                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
//        
//        $this->db->query('DROP TABLE IF EXISTS `bill_changes_log`;');         
//        $this->db->query($create);         
//        $this->db->query('ALTER TABLE `bill_changes_log`  ADD PRIMARY KEY (`id`);');        
//        $this->db->query('ALTER TABLE `bill_changes_log`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
//        echo $this->db->last_query();
    }
    
    
    public function not_found(){
        $this->viewAdminContent('404');
    }
      
    public function index(){
        
        dd('Want to Reset Database, Comment this line <br/>'. __FILE__ );
        exit;
        
        $this->db->truncate('subscriber_bills');
        $this->db->truncate('subscriber_bill_months');
        $this->db->truncate('tmp_yearly_bills');
    }
    
}