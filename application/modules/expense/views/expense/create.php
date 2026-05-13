<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Expense  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'expense') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>expense">Expense</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Expense</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="trans_date" class="col-sm-2 control-label">Trans Date :</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control js_datepicker" autocomplete="off" name="trans_date" id="trans_date" placeholder="Paid Date" value="<?php echo $trans_date; ?>" />
                    </div>                    
                    <?php echo form_error('trans_date') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="head_id" class="col-sm-2 control-label">Select Head :</label>
                <div class="col-sm-3">                    
                    <select class="form-control" name="head_id" id="head_id">
                        <?php echo Helper::getDropDownHead('Head', $head_id );?>
                    </select>
                    <?php echo form_error('head_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="sub_head_id" class="col-sm-2 control-label">Select Sub Head :</label>
                <div class="col-sm-3">
                    <select class="form-control" name="sub_head_id" id="sub_head_id">
                        <?php echo Helper::getDropDownHead('SubHead', $sub_head_id);?>
                    </select>                    
                    <?php echo form_error('sub_head_id') ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="amount" class="col-sm-2 control-label">Amount :</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                        <input type="number" autocomplete="off" class="form-control" name="amount" id="amount" placeholder="Taka" value="<?php echo $amount; ?>" />
                        <span class="input-group-addon">TK</span>
                    </div>                    
                    <?php echo form_error('amount') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="remark" class="col-sm-2 control-label">Remark :</label>
                <div class="col-sm-3">                    
                    <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" value="<?php echo $remark; ?>" />
                    <?php echo form_error('remark') ?>
                </div>
            </div>
            <div class="form-group hidden">
                <label for="user_id" class="col-sm-2 control-label">Entry By User :</label>
                <div class="col-sm-10">                    
                    <select class="form-control" name="user_id" id="user_id">
                        <?php echo Helper::getUserDropDown( $user_id ); ?>
                    </select>
                    <?php echo form_error('user_id') ?>
                </div>
            </div>
            
            <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary">Save</button> 
                <a href="<?php echo site_url(Backend_URL . 'expense') ?>" class="btn btn-default">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>