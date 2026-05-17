<?php

defined('BASEPATH') or exit('No direct script access allowed');

load_module_asset('users', 'css');
load_module_asset('users', 'js');

?>

<section class="content-header">
    <h1>User Details <small>of</small> <?php echo $full_name; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li class="active">User list</li>
    </ol>
</section>

<section class="content">
    <?php echo Users_helper::makeTab($id,  'delete'); ?>
    <div class="box no-border">
        <div class="box-body">
            <div class="box box-primary no-border">
                <p>&nbsp;</p>
                <p class="alert alert-warning">Delete a user not accepted. as business logic </p>
            </div>
        </div>
    </div>

</section>