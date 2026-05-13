<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">                             
        <ul class="sidebar-menu">            
            <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>           
            <?php            

            echo add_main_menu('Batch', 'batch', 'batch', 'fa-users');
            echo add_main_menu('Report', 'report', 'report', 'fa-calendar');
            echo add_main_menu('Transaction', 'transaction', 'transaction', 'fa-money');           
            // echo Modules::run('report/_menu');                                 
            echo Modules::run('transaction/_menu');            
            // echo Modules::run('learner/_menu');   
            echo add_main_menu('Learner Manager', 'learner', 'learner', 'fa-user');            
            echo add_main_menu('Vehicle Manager', 'vehicle', 'vehicle', 'fa-car');             
            

            echo Modules::run('sms/_menu');         
            echo add_main_menu('District', 'district', 'district', 'fa-map');                             
            // Speceally for Developers            
            echo add_main_menu('Settings', 'settings', 'settings', 'fa-gear');            
            echo add_main_menu('DB Backup & Restore', 'db_sync', 'db_sync', 'fa-hdd-o');
            echo Modules::run('module/menu');          
            echo Modules::run('profile/_menu');
                             
            // echo Modules::run('area/_menu'); 
            // echo Modules::run('donor/_menu');    
            // echo Modules::run('expense/_menu');    
            
            $role_id = getLoginUserData('role_id');
            if($role_id == 1){
                echo Modules::run('users/_menu');                
            } else {
                echo add_main_menu('Users', 'users', 'users', 'fa-gear');
            }            
            echo add_main_menu('Logout', 'logout', 'dashboard', 'fa-sign-out');            
           ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


<!-- Body Content Start -->
<div class="content-wrapper">
	<div id="ajaxContent">