<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>
<section class="content-header">
    <h1>Driving <small>Details</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'driving'); ?>">Driving</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo drivingTabs($id, 'details'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Driving Details</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="box-body">
            <table class="table table-striped">
                <tr><td width="150">Driving ID</td><td width="5">:</td>
                    <td>#<?php echo (int) $driving->id; ?></td></tr>
                <tr><td>Learner</td><td>:</td>
                    <td>
                        <a href="<?php echo site_url(Backend_URL . 'driving/learner/' . (int) $driving->learning_id); ?>">
                            <?php echo htmlspecialchars($driving->learner_name ?: ('#' . $driving->learning_id)); ?>
                        </a>
                        <?php if (!empty($driving->primary_mobile)): ?>
                            <span class="text-muted">(<?php echo htmlspecialchars($driving->primary_mobile); ?>)</span>
                        <?php endif; ?>
                    </td></tr>
                <tr><td>Batch</td><td>:</td>
                    <td><?php echo htmlspecialchars($driving->batch_name ?: '-'); ?></td></tr>
                <tr><td>Vehicle</td><td>:</td>
                    <td>
                        <?php echo htmlspecialchars($driving->vehicle_name ?: ('#' . $driving->vehicle_id)); ?>
                        <?php if (!empty($driving->vehicle_number)): ?>
                            <span class="text-muted">(<?php echo htmlspecialchars($driving->vehicle_number); ?>)</span>
                        <?php endif; ?>
                    </td></tr>
                <tr><td>Date</td><td>:</td>
                    <td><?php echo htmlspecialchars($driving->tx_date); ?></td></tr>
            </table>

            <h4 style="margin-top:24px;">
                <i class="fa fa-clock-o"></i> Stage Timeline
            </h4>
            <?php if (empty($logs)): ?>
                <p class="text-muted">No log entries yet.</p>
            <?php else: ?>
                <ul class="dv-timeline">
                    <?php foreach ($logs as $log): ?>
                        <li class="stage-<?php echo htmlspecialchars($log->stage); ?>">
                            <?php echo driving_stage_label($log->stage); ?>
                            <span class="ts"><?php echo driving_format_dt($log->datetime); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div style="margin-top:18px;">
                <a href="<?php echo site_url(Backend_URL . 'driving'); ?>" class="btn btn-default">
                    <i class="fa fa-long-arrow-left"></i> Back
                </a>
                <a href="<?php echo site_url(Backend_URL . 'driving/update/' . (int) $driving->id); ?>"
                   class="btn btn-success">
                    <i class="fa fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</section>
