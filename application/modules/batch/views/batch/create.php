<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Batch <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'batch') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>batch">Batch</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Batch</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label"><sup>*</sup>Name :</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                    <?php echo form_error('name') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="seat" class="col-sm-2 control-label"><sup>*</sup>Seat :</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="seat" id="seat" placeholder="Seat" value="<?php echo $seat; ?>" />
                    <?php echo form_error('seat') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="date_start" class="col-sm-2 control-label"><sup>*</sup>Date Start :</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control js_datepicker" autocomplete="off" name="date_start" id="date_start" placeholder="Start Date" value="<?php echo $date_start; ?>" />
                    </div>
                    <?php echo form_error('date_start') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="date_end" class="col-sm-2 control-label"><sup>*</sup>Date End :</label>
                <div class="col-sm-6">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control js_datepicker" autocomplete="off" name="date_end" id="date_end" placeholder="End Date" value="<?php echo $date_end; ?>" />
                    </div>
                    <?php echo form_error('date_end') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status :</label>
                <div class="col-sm-6" style="padding-top:8px;"><?php echo htmlRadio('status', $status, array('Running' => 'Running', 'Close' => 'Close', 'Upcoming' => 'Upcoming'));  ?></div>
            </div>
            <div class="form-group">
                <label for="remarks" class="col-sm-2 control-label">Remarks :</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php echo $remarks; ?></textarea>
                    <?php echo form_error('remarks') ?>
                </div>
            </div>            
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-2">
                    <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                    <a href="<?php echo site_url(Backend_URL . 'batch') ?>" class="btn btn-default">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>