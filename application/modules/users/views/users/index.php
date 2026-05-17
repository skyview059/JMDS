<?php load_module_asset('users', 'css'); ?>
<?php load_module_asset('users', 'js'); ?>
<section class="content-header">
    <h1> User <small>list</small> &nbsp;&nbsp;
        <?php echo anchor(site_url('users/create'), ' + Add User', 'class="btn btn-default"'); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL; ?>"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li class="active">User list</li>
    </ol>
</section>

<section class="content">
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-users" aria-hidden="true"></i> List of All User
            </h3>
        </div>

        <div class="box-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th width="40">SL</th>                            
                            <th>Name</th>                            
                            <th>Email </th>
                            <th>Contact</th>
                            <th width="100">Designation</th>
                            <th width="90">Reg.Date</th>
                            <th class="text-center" width="140">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr class="<?= $user->status; ?>">
                                <td><?php echo sprintf('%02d', ++$start); ?></td>                                
                                <td><?php echo $user->full_name; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->contact; ?></td>
                                <td><?php echo Users_helper::getRoleNameByID($user->role_id); ?></td>
                                <td><?php echo globalDateFormat($user->created); ?></td>
                                <td class="text-center">
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'users/profile/' . $user->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-default"');
                                    echo anchor(site_url(Backend_URL . 'users/update/' . $user->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-default"');
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="box-footer">
            <div class="col-md-6">
                <span class="btn btn-primary">Total User: <?php echo $total_rows ?></span>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</section>