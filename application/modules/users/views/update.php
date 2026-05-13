<?php
defined('BASEPATH') OR exit('No direct script access allowed');

load_module_asset('users', 'css');
load_module_asset('users', 'js');
?>
<section class="content-header">    
    <h1>User Details <small>of</small> <?php echo $first_name . ' ' . $last_name; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php Backend_URL ?>"><i class="fa fa-user"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL . 'users/' ?>"> User</a></li>    
        <li class="active">Update Profile</li>
    </ol>
</section>


<section class="content">
          
    <?php echo Users_helper::makeTab($id, 'update'); ?>
    <div class="box no-border">
        <div class="box-body">
            <div id="success_report"></div>                        
            
            <form method="post" id="update_user" role="form" name="fileinfo"  class="form-horizontal">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role_id" class="col-sm-3 control-label">Role<sup>*</sup> :<?php echo form_error('role_id') ?></label>
                            <div class="col-sm-9">
                                <select name="role_id" class="form-control" id="role_id">
                                    <?php echo Users_helper::getDropDownRoleName($role_id); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="first_name" class="col-sm-3 control-label">First Name<sup>*</sup> :<?php echo form_error('first_name') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" />

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-sm-3 control-label">Last Name<sup>*</sup> :<?php echo form_error('last_name') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" />
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email<sup>*</sup> <?php echo form_error('email') ?></label>
                            <div class="col-sm-9"> <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                            </div>   
                        </div>

                        <div class="form-group">
                            <label for="contact" class="col-sm-3 control-label">Contact :<?php echo form_error('contact') ?></label>
                            <div class="col-sm-9"><input type="text" class="form-control" name="contact" id="contact" placeholder="Contact" value="<?php echo $contact; ?>" />
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">

                        <div class="form-group">
                            <label for="add_line1" class="col-sm-4 control-label">Address Line1 :<?php echo form_error('add_line1') ?></label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="add_line1" id="add_line1" placeholder="Add Line1" value="<?php echo $add_line1; ?>" />
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="add_line2" class="col-sm-4 control-label">Address Line2 :<?php echo form_error('add_line2') ?></label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="add_line2" id="add_line2" placeholder="Add Line2" value="<?php echo $add_line2; ?>" />
                            </div>   </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-4 control-label">City :<?php echo form_error('city') ?></label>
                            <div class="col-sm-6"> <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $city; ?>" />
                            </div>  </div>
                        <div class="form-group">
                            <label for="state" class="col-sm-4 control-label">State :<?php echo form_error('state') ?></label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="state" id="state" placeholder="State" value="<?php echo $state; ?>" />
                            </div>  </div>
                        <div class="form-group">
                            <label for="postcode" class="col-sm-4 control-label">Postcode :<?php echo form_error('postcode') ?></label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" value="<?php echo $postcode; ?>" />
                            </div>  </div>
                        <div class="form-group hidden">
                            <label for="country_id" class="col-sm-4 control-label">Country :<?php echo form_error('country_id') ?></label>
                            <div class="col-sm-6">
                                <select name="country_id" class="form-control" id="country_id">
                                    <option value="17">Bangladesh</option>
                                    <?php //echo getDropDownCountries($country_id); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <label for="profilePic" class="col-sm-4 control-label">Profile Photo :<?php echo form_error('profile_photo') ?></label>
                            <input type="hidden" name="profile_photo" value="<?php echo $profile_photo; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-4 control-label">Status :<?php echo form_error('status') ?></label>
                            <div class="col-sm-6"><select name="status" class="form-control" id="status">
                                    <?php echo userStatus($status) ?>
                                </select>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>             
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </form>
        </div>
    </div>

        
</section>