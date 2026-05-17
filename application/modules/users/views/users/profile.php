<?php

defined('BASEPATH') or exit('No direct script access allowed');
load_module_asset('users', 'css');

?>

<section class="content-header">
    <h1>User Details <small>of</small> <?= $full_name; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li class="active">User list</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-9">
            <?php echo Users_helper::makeTab($id,  'profile'); ?>

            <div class="box box-primary no-border">
                <div class="box-body">

                    <table class="table table-striped table-condensed">
                        <tr>
                            <td width="150">Full Name</td>
                            <td>: <?= $full_name; ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>: <?= $role_id; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: <?= $email; ?></td>
                        </tr>                        
                        <tr>
                            <td> Contact </td>
                            <td>: <?= $contact; ?></td>
                        </tr>

                        <tr>
                            <td>Registration Date </td>
                            <td>: <?= $created; ?></td>
                        </tr>
                        <tr>
                            <td>Account Status </td>
                            <td>: <?= $status; ?></td>
                        </tr>
                        <tr>
                            <td>Last Access </td>
                            <td>: <?= $last_access; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>