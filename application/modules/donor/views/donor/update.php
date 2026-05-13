<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users', 'css'); ?>
<section class="content-header">
    <h1>Donor<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>donor">Donor</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content"><?php echo donorTabs($id, 'update'); ?><div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Update Donor</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>

            <div class="form-group">
                <label for="area_id" class="col-sm-2 control-label"><sup>*</sup> Area:</label>
                <div class="col-sm-10">                    
                    <select class="form-control" name="area_id" id="area_id">
                        <?php echo Helper::getDropDownArea($area_id); ?>
                    </select>                    
                    <?php echo form_error('area_id') ?>
                </div>
            </div>


            <div class="form-group">
                <label for="name" class="col-sm-2 control-label"><sup>*</sup> Name:</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="<?php echo $name; ?>" />
                    <?php echo form_error('name') ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="amount" class="col-sm-2 control-label"><sup>*</sup>Monthly Amount:</label>                                
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                        <input type="text" autocomplete="off" class="form-control" 
                               name="amount" id="amount" placeholder="Taka" 
                               onkeypress="return DigitOnly(event);"
                               maxlength="6"
                               value="<?php echo $amount; ?>" />
                        <span class="input-group-addon">TK</span>
                    </div>                                         
                    <?php echo form_error('amount') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="ref_id" class="col-sm-2 control-label">Ref ID:</label>
                <div class="col-sm-2">                    
                    <input type="text" class="form-control" name="ref_id" id="ref_id" placeholder="Ref. ID" value="<?php echo $ref_id; ?>" />                  
                    <?php echo form_error('ref_id') ?>
                </div>
            </div>


            <div class="form-group">
                <label for="contact" class="col-sm-2 control-label"><sup>*</sup> Contact:</label>
                <div class="col-sm-10">                    
                    <input type="number" class="form-control" name="contact" id="contact" placeholder="Contact" value="<?php echo $contact; ?>" />
                    <?php echo form_error('contact') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="add_line1" class="col-sm-2 control-label">Address Line1:</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="add_line1" id="add_line1" placeholder="Address Line1" value="<?php echo $add_line1; ?>" />
                    <?php echo form_error('add_line1') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="add_line2" class="col-sm-2 control-label">Address Line2:</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="add_line2" id="add_line2" placeholder="Address Line2" value="<?php echo $add_line2; ?>" />
                    <?php echo form_error('add_line2') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="reg_date" class="col-sm-2 control-label"><sup>*</sup> Registration Date:</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>                     
                        <input type="text" class="form-control js_datepicker" readonly="readonly"  
                               name="reg_date" id="reg_date" placeholder="Registration Date" 
                               value="<?php echo $reg_date; ?>" />
                    </div>
                    <?php echo form_error('reg_date') ?>
                </div>
            </div>




            <div class="form-group">
                <label for="status"  class="col-sm-2 control-label">Status:</label>
                <div class="col-sm-10"  style="padding-top:8px;">
                    <?php
                    echo htmlRadio('status', $status, array(
                        'Active' => 'Active', 'Inactive' => 'Inactive')
                    );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="remark" class="col-sm-2 control-label">Remark:</label>
                <div class="col-sm-10">                    
                    <textarea class="form-control" name="remark" id="remark" placeholder="Remark"><?php echo $remark; ?></textarea>
                    <?php echo form_error('remark') ?>
                </div>
            </div>


            <div class="form-group">
                
                <div class="col-md-10 col-md-offset-2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url(Backend_URL . 'donor') ?>" class="btn btn-default">Back to List</a>
                </div>                
            </div>
            
            <?php echo form_close(); ?>
        </div>

    </div>
</section>