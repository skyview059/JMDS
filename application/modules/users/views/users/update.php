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
    <div class="row">
        <div class="col-md-9">
            <?php echo Users_helper::makeTab($id, 'update'); ?>

            <div class="box no-border">
                <div class="box-body">
                    <h2 id="success_report"></h2>

                    <form method="post" id="update_user_aliza" name="fileinfo" class="form-horizontal">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <!-- form action="<?php echo $action; ?>" id="user_form" name="fileinfo" method="POST" enctype="multipart/form-data"  class="form-horizontal"-->
                        <input name="isRobot" type="hidden" value="0" />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="role_id" class="col-sm-3 control-label">Role<sup>*</sup> :<?php echo form_error('role_id') ?></label>
                                    <div class="col-sm-9">
                                        <select name="role_id" class="form-control" id="role_id">
                                            <?php echo Users_helper::getDropDownRoleName($role_id); ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="full_name" class="col-sm-3 control-label">Full Name<sup>*</sup> :<?php echo form_error('full_name') ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?php echo $full_name; ?>" />

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">Email<sup>*</sup> <?php echo form_error('email') ?></label>
                                    <div class="col-sm-9"> <input type="text" class="form-control" name="email" id="email" placeholder="Email or Mobile No" value="<?php echo $email; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact" class="col-sm-3 control-label">Contact :<?php echo form_error('contact') ?></label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="contact" id="contact" placeholder="Contact" value="<?php echo $contact; ?>" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Status :<?php echo form_error('status') ?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control" id="status">
                                            <?php echo selectOptions($status, ['Active' => 'Active', 'Inactive' => 'Inactive']); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>