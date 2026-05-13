<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php load_module_asset('users', 'css'); ?>
<section class="content-header">
    <h1>Batch<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>batch">Batch</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content"><?php echo batchTabs($id, 'update'); ?><div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Update Batch</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                        <?php echo form_error('name') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="seat" class="col-sm-2 control-label">Seat :</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="seat" id="seat" placeholder="Seat" value="<?php echo $seat; ?>" />
                        <?php echo form_error('seat') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_start" class="col-sm-2 control-label">Date Start :</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control js_datepicker" autocomplete="off" name="date_start" id="date_start" placeholder="Start Date" value="<?php echo $date_start; ?>" />
                    </div>
                        <?php echo form_error('date_start') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_end" class="col-sm-2 control-label">Date End :</label>
                    <div class="col-sm-10">                        
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control js_datepicker" autocomplete="off" name="date_end" id="date_end" placeholder="End Date" value="<?php echo $date_end; ?>" />
                        </div>
                        <?php echo form_error('date_end') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status :</label>
                    <div class="col-sm-10" style="padding-top:8px;"><?php echo htmlRadio('status', $status, array('Running' => 'Running', 'Close' => 'Close', 'Upcoming' => 'Upcoming'));  ?></div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-2 control-label">Remarks :</label>
                    <div class="col-sm-10">                    
                        <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"><?php echo $remarks; ?></textarea>
                        <?php echo form_error('remarks') ?>
                    </div>
                </div>                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                        <a href="<?php echo site_url(Backend_URL . 'batch') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </div>
                <?php echo form_close(); ?>
        </div>
    </div>
</section>