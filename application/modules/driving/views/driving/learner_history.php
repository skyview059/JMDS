<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>

<section class="content-header">
    <h1>
        <i class="fa fa-user"></i> <?php echo htmlspecialchars($learner->name); ?>
        <small>Driving history</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'driving'); ?>">Driving</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'driving/history'); ?>">History</a></li>
        <li class="active">Learner #<?php echo (int) $learner->id; ?></li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Learner #<?php echo (int) $learner->id; ?> &middot; <?php echo htmlspecialchars($learner->name); ?>
                <?php if (!empty($learner->primary_mobile)): ?>
                    <small class="text-muted"><i class="fa fa-phone"></i> <?php echo htmlspecialchars($learner->primary_mobile); ?></small>
                <?php endif; ?>
            </h3>
        </div>

        <div class="box-body">
            <?php if (empty($drivings)): ?>
                <p class="text-muted">No driving records found for this learner.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th width="40">#</th>
                                <th width="110">Date</th>
                                <th>Vehicle</th>
                                <th width="120">Final Stage</th>
                                <th>Timeline</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ($drivings as $d): $i++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($d->tx_date); ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($d->vehicle_name ?: ('#' . $d->vehicle_id)); ?>
                                        <?php if (!empty($d->vehicle_number)): ?>
                                            <span class="text-muted">(<?php echo htmlspecialchars($d->vehicle_number); ?>)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo driving_stage_label($d->current_stage); ?></td>
                                    <td>
                                        <ul class="dv-timeline">
                                            <?php foreach (($timelines[$d->driving_id] ?? []) as $log): ?>
                                                <li class="stage-<?php echo htmlspecialchars($log->stage); ?>">
                                                    <?php echo driving_stage_label($log->stage); ?>
                                                    <span class="ts"><?php echo driving_format_dt($log->datetime); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                            <?php if (empty($timelines[$d->driving_id])): ?>
                                                <li class="text-muted">No log entries</li>
                                            <?php endif; ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url(Backend_URL . 'driving/details/' . (int) $d->driving_id); ?>"
                                           class="btn btn-xs btn-success" title="View details">
                                            <i class="fa fa-external-link"></i> View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
