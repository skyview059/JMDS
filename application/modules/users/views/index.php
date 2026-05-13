<?php load_module_asset('users', 'css'); ?>
<?php load_module_asset('users', 'js'); ?>
<section class="content-header">
    <h1> User <small>list</small> &nbsp;&nbsp;
        <?php 
        if($role_id == 1 ){        
            echo anchor(
                site_url(Backend_URL . 'users/create'), 
                ' + Add User', 
                'class="btn btn-default"'
            ); 
        }
        ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL; ?>"><i class="fa fa-dashboard"></i> Admin </a></li>        
        <li class="active">User list</li>
    </ol>
</section>

<section class="content"> 
    <div class="box">

        <div class="box-header">
            <?php $this->load->view('filter_form'); ?>       
        </div>
        <div class="box-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="40">ID</th>
                            <th width="90">Reg.Date</th>
                            <th>Full Name</th>                                                    
                            <th>Primary Email </th>
                            <th>Contact</th>                    
                            <th width="220">Role/Department </th>       
                            <th width="150">Action </th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php foreach ($users_data as $user) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo globalDateFormat($user->created); ?></td>                        
                                <td><?php echo $user->first_name . ' ' . $user->last_name; ?></td>

                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->contact; ?></td>                  
                                <td><?php echo Users_helper::getRoleNameByID($user->role_id); ?></td>
                                <td><?php
                                    echo anchor(site_url(Backend_URL . 'users/profile/' . $user->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-default"');                                    
                                    echo anchor(site_url(Backend_URL . 'users/update/' . $user->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-primary"');
                                    ?>                                                      
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>     

            </div>
        </div>

        <div class="row" style="padding-top: 10px; padding-bottom: 10px; margin: 0;">
            <div class="col-md-6">
                <span class="btn btn-primary">Total Record : <?php echo $total_rows ?></span>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</section>    