<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Donation  <small>Entry</small> <a href="<?php echo site_url(Backend_URL . 'trans') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>trans">Trans</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Donation Entry</h3>
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="donor_id" class="col-sm-2 control-label">Select Donor :</label>
                <div class="col-sm-10">                    
                    <select class="form-control js_select2" name="donor_id" id="donor_id">
                        <?php echo Helper::getDonationDropDown($donor_id);?>
                    </select>
                    <?php echo form_error('donor_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="month" class="col-sm-2 control-label">Month :</label>
                <div class="col-sm-3">                    
                    <select class="form-control" name="month" id="month">
                        <?php echo Helper::buildMonths( $month ); ?>
                    </select>
                    <?php echo form_error('month') ?>
                </div>
            </div>            
            
            
            <div class="form-group">
                <label for="paid" class="col-sm-2 control-label">Donation Amount :</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon">General&nbsp;&nbsp;</span>
                        <input type="number" autocomplete="off" class="form-control" name="paid" id="paid" placeholder="Taka" value="<?php echo $paid; ?>" />
                        <span class="input-group-addon">TK</span>
                    </div>
                    <?php echo form_error('paid') ?>
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon">Personal</span>
                        <input type="number" autocomplete="off" class="form-control" name="personal" id="personal" placeholder="Taka" value="<?php echo $personal; ?>" />
                        <span class="input-group-addon">TK</span>
                    </div>                    
                </div>
            </div>
            <div class="form-group">
                <label for="month" class="col-sm-2 control-label">Head :</label>
                <div class="col-sm-3">                    
                    <select class="form-control" name="head_id" id="head_id">
                        <?php echo Helper::donationHeads( $head_id ); ?>
                    </select>
                    <?php echo form_error('head_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="paid_date" class="col-sm-2 control-label">Paid Date :</label>
                <div class="col-sm-2"> 
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control js_datepicker" autocomplete="off" name="paid_date" id="paid_date" placeholder="Paid Date" value="<?php echo $paid_date; ?>" />
                    </div>                    
                    <?php echo form_error('paid_date') ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="remark" class="col-sm-2 control-label">Remark :</label>
                <div class="col-sm-10">                    
                    <textarea class="form-control" name="remark" id="remark" placeholder="Remark"><?php echo $remark; ?></textarea>
                    <?php echo form_error('remark') ?>
                </div>
            </div>
            <div class="form-group hidden">
                <label for="collected_by" class="col-sm-2 control-label">Collected By :</label>
                <div class="col-sm-5">                    
                    <select class="form-control" name="user_id" id="user_id">
                        <?php echo Helper::getUserDropDown( $collected_by ); ?>
                    </select>
                    <?php echo form_error('collected_by') ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="status"  class="col-sm-2 control-label">Send Notify SMS:</label>
                <div class="col-sm-10"  style="padding-top:8px;">
                    <?php echo htmlRadio('send_sms', 'Yes', ['Yes' => 'Yes', 'No' => 'No']);
                    ?>
                </div>
            </div>
            
            <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary">Save</button> 
                <a href="<?php echo site_url(Backend_URL . 'trans') ?>" class="btn btn-default">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<script>
    $(function(){
        setTimeout(function(){ $('.ajax_success').slideUp('slow'); }, 1000);        
    });
</script>    