<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>

<?php
$base_query = array_filter([
    'tx_date'  => $tx_date,
    'batch_id' => $batch_id,
]);
$base_qs = $base_query ? ('?' . http_build_query($base_query)) : '';

$learners     = $pivot['learners'] ?? [];
$grid         = $pivot['pivot']    ?? [];
$counts       = $pivot['counts']   ?? [];
$learner_logs = $learner_logs     ?? [];
?>
<div class="content-wrapper">
<div class="container">
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
                    <div class="dv-stat-row">
                        <div class="dv-stat-title"><i class="fa fa-users"></i> Total Learners</div>
                        <div class="dv-stat-value"><?php echo (int) $total_learners; ?></div>
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
                            <th style="width:80px;">Index</th>
                            <th>Learner</th>
                            <?php foreach ($vehicles as $v): ?>
                                <th class="dv-cell"><?php echo htmlspecialchars($v->name); ?></th>
                            <?php endforeach; ?>
                            <th class="text-center" style="width:70px;">Log</th>
                            <th class="text-center" style="width:90px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($learners)): ?>
                        <tr>
                            <td colspan="<?php echo 4 + count($vehicles); ?>" class="text-center text-muted" style="padding:30px;">
                                No learners found<?php echo $batch_id ? ' for this batch' : ''; ?>.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($learners as $learner): ?>
                            <?php
                                $log_groups = $learner_logs[$learner->id] ?? [];
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
                                </td>

                                <?php foreach ($vehicles as $v):
                                    $cell = $grid[$learner->id][$v->id] ?? null;
                                ?>
                                    <td class="dv-cell <?php echo $cell ? '' : 'dv-empty'; ?>">
                                        <?php if ($cell): ?>
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

                                <td class="text-center">
                                    <?php if (!empty($log_groups)): ?>
                                        <button type="button"
                                                class="btn btn-xs btn-info dv-view-log"
                                                data-learner-id="<?php echo (int) $learner->id; ?>"
                                                data-learner-name="<?php echo htmlspecialchars($learner->name, ENT_QUOTES); ?>">
                                            <i class="fa fa-list"></i> Log
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">&mdash;</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($log_groups)): ?>
                                        <a href="<?php echo $reset_row_url; ?>"
                                           class="btn btn-xs btn-danger"
                                           onclick="return confirm('Reset all driving entries for this learner on <?php echo $tx_date; ?>?')">
                                            <i class="fa fa-refresh"></i> Reset
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">&mdash;</span>
                                    <?php endif; ?>
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

<?php if (!empty($learners)): ?>
    <?php foreach ($learners as $learner): ?>
        <div id="dvLogData-<?php echo (int) $learner->id; ?>" class="hidden dv-log-data">
            <?php echo driving_learner_log_groups_html($learner_logs[$learner->id] ?? []); ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- ============================== Driving log modal ========================= -->
<div class="modal fade" id="dvLogModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-list"></i> <span id="dvLogModalTitle">Driving Log</span></h4>
      </div>
      <div class="modal-body" id="dvLogModalBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
            <input type="hidden" name="batch_id" value="<?php echo ($batch_id); ?>">

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="tx_date" value="<?php echo ($tx_date); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Learner</label>
                <?php echo form_dropdown('learning_id', $learner_list, '',
                    'class="form-control" id="dvAssignLearner" required'); ?>
            </div>
            <div class="form-group">
                <label>Vehicle</label>
                <div class="dv-inline-radios" id="dvAssignVehicleRadios">
                <?php
                $first_vehicle = true;
                foreach ($vehicle_list as $vid => $vlabel):
                    if ($vid === '' || $vid === null) { continue; }
                ?>
                    <label class="radio-inline">
                        <input type="radio" name="vehicle_id" value="<?php echo (int) $vid; ?>"
                               <?php echo $first_vehicle ? 'checked' : ''; ?> required>
                        <?php echo htmlspecialchars($vlabel); ?>
                    </label>
                <?php
                    $first_vehicle = false;
                endforeach;
                ?>
                </div>
            </div>
            <div class="form-group">
                <label>Drive Type</label>
                <div class="dv-inline-radios">
                <?php foreach (driving_drive_types() as $value => $label): ?>
                    <label class="radio-inline">
                        <input type="radio" name="drive_type" value="<?php echo htmlspecialchars($value); ?>"
                               <?php echo $value === 'F' ? 'checked' : ''; ?> required>
                        <?php echo htmlspecialchars($label); ?>
                    </label>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Round Qty</label>
                <div class="dv-inline-radios">
                <?php foreach (driving_round_qty_options() as $value => $label): ?>
                    <label class="radio-inline">
                        <input type="radio" name="round_qty" value="<?php echo (int) $value; ?>"
                               <?php echo $value === 1 ? 'checked' : ''; ?> required>
                        <?php echo htmlspecialchars($label); ?>
                    </label>
                <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Add to Queue</button>
        </div>

      </div>
    </form>
  </div>
</div>
</div>
</div>


<script>
(function($){
    if (!window.jQuery) { return; }
    $(document).on('click', '[data-prefill-learner]', function(){
        var learnerId = $(this).data('prefill-learner');
        var vehicleId = $(this).data('prefill-vehicle');
        $('#dvAssignLearner').val(learnerId);
        $('#dvAssignVehicleRadios input[name="vehicle_id"][value="' + vehicleId + '"]').prop('checked', true);
    });
    $(document).on('click', '.dv-view-log', function(){
        var learnerId = $(this).data('learner-id');
        var learnerName = $(this).data('learner-name') || 'Driving Log';
        var html = $('#dvLogData-' + learnerId).html();
        $('#dvLogModalTitle').text(learnerName);
        $('#dvLogModalBody').html(html || '<p class="text-muted">No driving logs for this day.</p>');
        $('#dvLogModal').modal('show');
    });
})(jQuery);
</script>
