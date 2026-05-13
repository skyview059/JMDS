<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2016-10-14
 */

class Db_sync extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Db_sync_model');      
        $this->load->helper('db_sync');      
    }

    public function index() {
        $db_sync    = $this->Db_sync_model->get_all();
        $tables     = $this->db->list_tables();
        
        $data['db_sync_data']   = $db_sync;
        $data['tables']         = $tables; 
        
        
        $this->viewAdminContent('db_sync/index', $data);
    }

    

    public function delete() {
        $id = $this->input->post('id');
        $file = $this->input->post('file');
        
        $file_path = dirname ( BASEPATH ) .'/DB/' . $file;
        if($file && file_exists($file_path)){
            unlink($file_path);
        }
        
        $this->db->delete('db_sync', ['id' => $id]);
        echo ajaxRespond('OK', '<p class="ajax_success">File Deleted Successfully</p>');
    }
              

    public function  backup_full_db(){
        echo $this->backup_full_db_system();
    }

    public function restore(){
        ajaxAuthorized();
               
        $file_name   = $this->input->post('file');
        $table       = $this->input->post('table');

        if($table == 'db'){
            $this->backup_full_db_system();
        } else {
            $this->exportTableSystem( $table );
        }        
        
       
        $dbPath     = dirname( BASEPATH ) . '/DB/' . $file_name;       
        $templine   = '';	
        $lines      = file($dbPath); // Read in entire file
        foreach($lines as $line){
            if (substr($line, 0, 2) == '--' || $line == ''){
                continue;
            }
            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';'){
                $this->db->query($templine);
                $templine = '';
            }
        }            
              
        $respond['Status'] = 'OK';
        $respond['Msg']    = '<p class="ajax_success">'. ucfirst($table) .' Restored Successfully</p>';                                   
        echo json_encode($respond);                     
    }
    
    public function upload_sql_file(){
       ajaxAuthorized();
         
       $file_name   = 'test';       
       $dbPath      = dirname( BASEPATH ) . '/DB/' . $file_name;
        
       $event_fire  = 'Full DB Backuped';
       $record_id   = $this->add_change_log( $event_fire, 'db', $file_name );      
       
       $sql_file = "test.sql";
       $array['Status'] = 'OK';
       $array['Msg']    = '<p class="ajax_success">Full DB Export Successful</p>';
       $array['TblRow'] = '<tr>'
                            . '<td>'. $record_id .'</td>'
                            . '<td> <code> db</code> </td>'
                            . '<td> Full DB Backuped <br/><em class="small">'. date('h:i A d/m/y'). '</em></td>'                            
                            . '<td>'. 
                                db_download_btn( $sql_file ) .
                                ' <span class="btn btn-xs btn-warning"><i class="fa fa-rotate-left"></i></span>'
                                .' <span class="btn btn-xs btn-danger" onclick="deleteTable('. $record_id .',\''. $sql_file .'\' );">
                                <i class="fa fa-times"></i></span></td>'
                        . '</tr>';
       
                     
       echo json_encode($array);                     
    }
    
    public function exportTable( $table = null ){    
       ajaxAuthorized();        
       $table_new   = is_null($table) ? $this->input->post('table') : $table;        
       echo $this->exportTableSystem( $table_new);                    
       //$this->export_table( $table_new );
    }    

    function export_table( $tableName ){
        $timestamp = date('Y_m_d_H_i_s');
        $file_name  = dirname( BASEPATH ) . "/DB/{$tableName}.sql";        
        $file_name  = str_replace('/', '\\', $file_name);                        
        echo $sql_query  = "SELECT * INTO OUTFILE '{$file_name}' FROM {$tableName}";
        //$this->db->query($sql_query);        
    }
    
     
    public function truncateTable(){
        ajaxAuthorized();
        
        $table = $this->input->post('table');
        $truncate = $this->db->truncate($table);
        if($truncate){
            echo ajaxRespond('OK','Complete');
        } else {
            echo ajaxRespond('Fail','Fail To Truncate');
        }
        
        
    }
    
    private function add_change_log( $event_fired, $db_type, $file_name ) {
        ajaxAuthorized();
        
        $data = [
            'user_id'       => getLoginUserData('user_id'),
            'created'       => date('Y-m-d H:i:s'),
            'event_fired'   => $event_fired,            
            'db'            => $db_type,
            'file'          => $file_name . '.sql'
        ];
        return $this->Db_sync_model->insert($data);          
    }
    
    private function exportTableSystem($setTable = null)
    {
        ajaxAuthorized();
        if (!function_exists('system')) {
            echo ajaxRespond('Fail', '<p class="ajax_error">System Function Disabled</p>');
            exit;
        }
        $table = is_null($setTable) ? $this->input->post('table') : $setTable;

        $database = $this->db->database;
        $hostname = $this->db->hostname;
        $username = $this->db->username;
        $password = $this->db->password;
        
        $mysqlPath  = (PHP_OS == "WINNT") ? 'F:\\laragon\\bin\\mysql\\mysql-8.0.39-winx64\\bin\\' : '';        
        $file_name  = $table . date('_Y-m-d_H-i-s');
        $dbPath     = FCPATH . "/DB/{$file_name}";

        $sql_string = "mysqldump --host={$hostname} --user={$username} --password={$password} {$database} {$table} > {$dbPath}.sql";

        system($mysqlPath . $sql_string);

        $event_fire = ucfirst_fk($table) . ' Table Backup';
        $record_id = $this->add_change_log($event_fire, $table, $file_name);

        $sql_file = "{$file_name}.sql";
        $array['Status'] = 'OK';
        $array['Msg'] = '<p class="ajax_success">' . $table . ' Export Successfully</p>';
//        $array['TblRow'] = '<tr><td>'. $record_id .'</td><td>'. date('h:i A d/m/y').'</td><td>Backup ' . $table .'</td><td>' . getLoginUserData('name') .'</td></tr>';
        $array['TblRow'] = '<tr>'
            . '<td>' . $record_id . '</td>'
            . '<td> Full DB Backup <br/><em class="small">' . date('h:i A d/m/y') . '</em></td>'
            . '<td>' .
            db_download_btn($sql_file) .
            ' <span class="btn btn-xs btn-warning"><i class="fa fa-rotate-left"></i></span>'
            . ' <span class="btn btn-xs btn-danger" onclick="deleteTable(' . $record_id . ',\'' . $sql_file . '\' );">
                                <i class="fa fa-times"></i></span></td>'
            . '</tr>';


        return json_encode($array);
    }
    
    private function backup_full_db_system(){
       ajaxAuthorized();
       
       $database    = $this->db->database;
       $hostname    = $this->db->hostname;
       $username    = $this->db->username;
       $password    = $this->db->password;
       
       $mysql_path  = str_replace('htdocs', '', $_SERVER['DOCUMENT_ROOT']);
       $mysql_path  = str_replace('/', '\\', $mysql_path);
       $mysqlPath   = (PHP_OS == "WINNT") ? $mysql_path . 'mysql\\bin\\' : '';
       $file_name   = $database . date('_Y-m-d_H-i-s');
       
       $dbPath = dirname( BASEPATH ) . '/DB/' . $file_name;
       
       $sql_string = "mysqldump --host=$hostname --user=$username --password=$password $database > $dbPath.sql";
       
       system( $mysqlPath .$sql_string);

       $event_fire  = 'Full DB Backuped';
       $record_id   = $this->add_change_log( $event_fire, 'db', $file_name );      
       
       $sql_file = "{$file_name}.sql";
       $array['Status'] = 'OK';
       $array['Msg']    = '<p class="ajax_success">Full DB Export Successful</p>';
       $array['TblRow'] = '<tr>'
                            . '<td>'. $record_id .'</td>'                            
                            . '<td> Full DB Backuped <br/><em class="small">'. date('h:i A d/m/y'). '</em></td>'                            
                            . '<td>'. 
                                db_download_btn( $sql_file ) .
                                ' <span class="btn btn-xs btn-warning"><i class="fa fa-rotate-left"></i></span>'
                                .' <span class="btn btn-xs btn-danger" onclick="deleteTable('. $record_id .',\''. $sql_file .'\' );">
                                <i class="fa fa-times"></i></span></td>'
                        . '</tr>';
       
                     
        return json_encode($array);                     
    }
        
}
