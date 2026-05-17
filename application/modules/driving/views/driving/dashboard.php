<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>

<?php
$base_query = array_filter([
    'tx_date'  => $tx_date,
    'batch_id' => $batch_id,
]);
$base_qs = $base_query ? ('?' . http_build_query($base_query)) : '';

$learners = $pivot['learners'] ?? [];
$grid     = $pivot['pivot']    ?? [];
$counts   = $pivot['counts']   ?? [];
?>

<section class="content-header">
    <h1>
        <i class="fa fa-car"></i> Driving Dashboard
        <small>Daily queue &amp; live status</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Driving</li>
    </ol>
</section>

<section class="content">
    <?php echo $this->session->flashdata('message'); ?>

    <div class="box">
        <div class="box-body">

            <!-- Toolbar: date / batch filter + actions -->
            <div class="dv-toolbar">
                <form method="get" action="<?php echo site_url(Backend_URL . 'driving'); ?>" class="form-inline">
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" name="tx_date" value="<?php echo htmlspecialchars($tx_date); ?>" class="form-control input-sm">
                    </div>
                    <div class="form-group" style="margin-left:8px;">
                        <label>Batch:</label>
                        <?php echo form_dropdown('batch_id', $batch_list, $batch_id, 'class="form-control input-sm"'); ?>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-filter"></i> Filter</button>
                    <a href="<?php echo site_url(Backend_URL . 'driving'); ?>" class="btn btn-sm btn-default">Reset</a>
                </form>

                <div>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#dvAssignModal">
                        <i class="fa fa-plus"></i> Assign to Queue
                    </button>
                    <a href="<?php echo site_url(Backend_URL . 'driving/history') . $base_qs; ?>"
                       class="btn btn-sm btn-info">
                        <i class="fa fa-history"></i> History
                    </a>
                    <a href="<?php echo site_url(Backend_URL . 'driving/listing'); ?>"
                       class="btn btn-sm btn-default">
                        <i class="fa fa-list"></i> All Rows
                    </a>
                </div>
            </div>

            <!-- Summary cards -->
            <div class="dv-summary">
                <div class="dv-stat">
                    <div class="dv-stat-title"><i class="fa fa-users"></i> Total Students</div>
                    <div class="dv-stat-value"><?php echo (int) $total_learners; ?></div>
                    <div class="dv-stat-sub">
                        <?php echo (int) $students_today; ?> active on <?php echo $tx_date; ?>
                    </div>
                </div>
                <?php foreach ($vehicles as $v):
                    $used = $counts[$v->id]['active'] ?? 0;
                    echo driving_capacity_card($v->name, $v->number, $used, $daily_limit);
                endforeach; ?>
            </div>

            <!-- Pivot table -->
            <div class="table-responsive">
                <table class="dv-pivot table">
                    <thead>
                        <tr>
                            <th style="width:80px;">Student</th>
                            <th>Learner</th>
                            <?php foreach ($vehicles as $v): ?>
                                <th class="dv-cell"><?php echo htmlspecialchars($v->name); ?></th>
                            <?php endforeach; ?>
                            <th style="width:160px;">First Log</th>
                            <th style="width:160px;">Last Log</th>
                            <th class="text-center" style="width:120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($learners)): ?>
                        <tr>
                            <td colspan="<?php echo 6 + count($vehicles); ?>" class="text-center text-muted" style="padding:30px;">
                                No drivings recorded for <b><?php echo $tx_date; ?></b>.
                                Click <b>"Assign to Queue"</b> to start.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($learners as $learner): ?>
                            <?php
                                $first_seen = null;
                                $last_seen  = null;
                                foreach ($grid[$learner->id] ?? [] as $cell) {
                                    if ($cell->last_log_time) {
                                        if (!$first_seen || $cell->last_log_time < $first_seen) {
                                            $first_seen = $cell->last_log_time;
                                        }
                                        if (!$last_seen || $cell->last_log_time > $last_seen) {
                                            $last_seen = $cell->last_log_time;
                                        }
                                    }
                                }
                                $reset_row_url = site_url(Backend_URL . 'driving/reset_row') . '?'
                                    . http_build_query([
                                        'learning_id' => $learner->id,
                                        'tx_date'     => $tx_date,
                                    ]);
                            ?>
                            <tr>
                                <td><b>#<?php echo (int) $learner->id; ?></b></td>
                                <td>
                                    <a href="<?php echo site_url(Backend_URL . 'driving/learner/' . (int) $learner->id); ?>">
                                        <?php echo htmlspecialchars($learner->name); ?>
                                    </a>
                                    <?php if (!empty($learner->batch_name)): ?>
                                        <div class="text-muted" style="font-size:11px;">
                                            <i class="fa fa-tag"></i> <?php echo htmlspecialchars($learner->batch_name); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <?php foreach ($vehicles as $v):
                                    $cell = $grid[$learner->id][$v->id] ?? null;
                                ?>
                                    <td class="dv-cell <?php echo $cell ? '' : 'dv-empty'; ?>">
                                        <?php if ($cell): ?>
                                            <?php echo driving_stage_badge($cell->current_stage, $v->name); ?>
                                            <?php echo driving_action_buttons($cell); ?>
                                        <?php else: ?>
                                            <a class="btn btn-xs btn-default"
                                               href="#"
                                               data-toggle="modal"
                                               data-target="#dvAssignModal"
                                               data-prefill-learner="<?php echo (int) $learner->id; ?>"
                                               data-prefill-vehicle="<?php echo (int) $v->id; ?>">
                                                <i class="fa fa-plus"></i> Assign
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>

                                <td><?php echo driving_format_dt($first_seen); ?></td>
                                <td><?php echo driving_format_dt($last_seen); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo $reset_row_url; ?>"
                                       class="btn btn-xs btn-danger"
                                       onclick="return confirm('Reset all driving entries for this learner on <?php echo $tx_date; ?>?')">
                                        <i class="fa fa-refresh"></i> Reset
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <p class="text-muted" style="margin-top:8px;">
                <i class="fa fa-info-circle"></i>
                Each vehicle accepts up to <b><?php echo (int) $daily_limit; ?></b> active learners per day
                (Queued + ON DRIVING). Use the action icons inside a cell to start, complete or rewind a stage.
            </p>
        </div>
    </div>
</section>

<!-- ============================== Assign-to-queue modal ========================= -->
<div class="modal fade" id="dvAssignModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?php echo site_url(Backend_URL . 'driving/assign_action'); ?>" class="dv-assign-form">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Assign Learner to Queue</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="batch_id" value="<?php echo htmlspecialchars($batch_id); ?>">

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="tx_date" value="<?php echo htmlspecialchars($tx_date); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Learner</label>
                <?php echo form_dropdown('learning_id', $learner_list, '',
                    'class="form-control" id="dvAssignLearner" required'); ?>
            </div>
            <div class="form-group">
                <label>Vehicle</label>
                <?php echo form_dropdown('vehicle_id', $vehicle_list, '',
                    'class="form-control" id="dvAssignVehicle" required'); ?>
            </div>
            <p class="text-muted" style="margin:0;">
                A new <b>Queued</b> log will be created automatically.
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Add to Queue</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
(function($){
    if (!window.jQuery) { return; }
    $(document).on('click', '[data-prefill-learner]', function(){
        var learnerId = $(this).data('prefill-learner');
        var vehicleId = $(this).data('prefill-vehicle');
        $('#dvAssignLearner').val(learnerId);
        $('#dvAssignVehicle').val(vehicleId);
    });
})(jQuery);
</script>
