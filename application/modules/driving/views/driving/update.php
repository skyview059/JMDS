<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>
<section class="content-header">
    <h1>Driving <small><?php echo $button; ?></small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'driving'); ?>">Driving</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content">
    <?php echo drivingTabs($id, 'update'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Update Driving</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Learner</label>
                    <div class="col-sm-10">
                        <?php echo form_dropdown('learning_id', $learner_list, $learning_id, 'class="form-control"'); ?>
                        <?php echo form_error('learning_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Vehicle</label>
                    <div class="col-sm-10">
                        <?php echo form_dropdown('vehicle_id', $vehicle_list, $vehicle_id, 'class="form-control"'); ?>
                        <?php echo form_error('vehicle_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tx_date"
                               value="<?php echo htmlspecialchars($tx_date); ?>">
                        <?php echo form_error('tx_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="hidden" name="id" value="<?php echo (int) $id; ?>">
                        <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                        <a href="<?php echo site_url(Backend_URL . 'driving'); ?>" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
