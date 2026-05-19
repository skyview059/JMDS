<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>
<div class="content-wrapper">
<div class="container"></h1>
<section class="content-header">
    <h1>
        <i class="fa fa-history"></i> Driving History
        <small>Report &amp; audit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'driving'); ?>">Driving</a></li>
        <li class="active">History</li>
    </ol>
</section>

<section class="content">
    <?php echo $this->session->flashdata('message'); ?>

    <!-- ============================ Filter strip ============================ -->
    <form method="get" action="<?php echo site_url(Backend_URL . 'driving/history'); ?>" class="dv-filter-strip">
        <div class="row">
            <div class="col-sm-3 form-group">
                <label>From</label>
                <input type="date" name="from_date" class="form-control input-sm"
                       value="<?php echo htmlspecialchars($filters['from_date'] ?? ''); ?>">
            </div>
            <div class="col-sm-3 form-group">
                <label>To</label>
                <input type="date" name="to_date" class="form-control input-sm"
                       value="<?php echo htmlspecialchars($filters['to_date'] ?? ''); ?>">
            </div>
            <div class="col-sm-3 form-group">
                <label>Batch</label>
                <?php echo form_dropdown('batch_id', $batch_list, $filters['batch_id'] ?? '', 'class="form-control input-sm"'); ?>
            </div>
            <div class="col-sm-3 form-group">
                <label>Vehicle</label>
                <?php echo form_dropdown('vehicle_id', $vehicle_list, $filters['vehicle_id'] ?? '', 'class="form-control input-sm"'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 form-group">
                <label>Stage</label>
                <?php echo form_dropdown('stage', $stage_list, $filters['stage'] ?? '', 'class="form-control input-sm"'); ?>
            </div>
            <div class="col-sm-6 form-group">
                <label>Search</label>
                <input type="text" name="q" class="form-control input-sm"
                       placeholder="Learner name, mobile, vehicle name or number..."
                       value="<?php echo htmlspecialchars($filters['q'] ?? ''); ?>">
            </div>
            <div class="col-sm-3 form-group" style="padding-top:24px;">
                <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
                <a href="<?php echo site_url(Backend_URL . 'driving/history'); ?>" class="btn btn-sm btn-default">Reset</a>
            </div>
        </div>
    </form>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">#</th>
                            <th width="100">Date</th>
                            <th>Learner</th>
                            <th>Batch</th>
                            <th>Vehicle</th>
                            <th width="110">Stage</th>
                            <th width="140">First Log</th>
                            <th width="140">Last Log</th>
                            <th width="130" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($rows)): ?>
                        <tr><td colspan="9" class="text-center text-muted" style="padding:30px;">
                            No driving records match the filters.
                        </td></tr>
                    <?php else: ?>
                        <?php $i = $start; foreach ($rows as $r): $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo htmlspecialchars($r->tx_date); ?></td>
                                <td>
                                    <a href="<?php echo site_url(Backend_URL . 'driving/learner/' . (int) $r->learner_id); ?>">
                                        <?php echo htmlspecialchars($r->learner_name ?: ('#' . $r->learner_id)); ?>
                                    </a>
                                    <?php if (!empty($r->primary_mobile)): ?>
                                        <div class="text-muted" style="font-size:11px;">
                                            <i class="fa fa-phone"></i> <?php echo htmlspecialchars($r->primary_mobile); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($r->batch_name ?: '-'); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($r->vehicle_name ?: ('#' . $r->vehicle_id)); ?>
                                    <?php if (!empty($r->vehicle_number)): ?>
                                        <div class="text-muted" style="font-size:11px;">
                                            <?php echo htmlspecialchars($r->vehicle_number); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo driving_stage_label($r->current_stage); ?></td>
                                <td><?php echo driving_format_dt($r->first_log_time); ?></td>
                                <td><?php echo driving_format_dt($r->last_log_time); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo site_url(Backend_URL . 'driving/details/' . (int) $r->driving_id); ?>"
                                       class="btn btn-xs btn-success" title="View timeline">
                                        <i class="fa fa-external-link"></i>
                                    </a>
                                    <a href="<?php echo site_url(Backend_URL . 'driving/learner/' . (int) $r->learner_id); ?>"
                                       class="btn btn-xs btn-info" title="Learner history">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <a href="<?php echo site_url(Backend_URL . 'driving/reset_action/' . (int) $r->driving_id); ?>"
                                       class="btn btn-xs btn-danger" title="Remove"
                                       onclick="return confirm('Remove this driving record?')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="btn btn-success">Total: <?php echo (int) $total_rows; ?></span>
                </div>
                <div class="col-md-6 text-right"><?php echo $pagination; ?></div>
            </div>
        </div>
    </div>
</section>
</div>
</div>