<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.tx-page { padding-bottom: 24px; }
.tx-page .tx-toolbar { margin-bottom: 14px; }
.tx-page .tx-toolbar h1 { margin: 0 0 4px 0; font-size: 24px; font-weight: 600; color: #2c3e50; display: inline-block; vertical-align: middle; }
.tx-page .tx-toolbar .tx-subtle { font-size: 13px; color: #6c757d; font-weight: 400; }
.tx-page .btn-tx-green { background: #22a958; border-color: #1e984e; color: #fff !important; }
.tx-page .btn-tx-green:hover { background: #1d964c; border-color: #198543; color: #fff !important; }
.tx-page .btn-tx-orange { background: #f39c12; border-color: #e08e0b; color: #fff !important; }
.tx-page .btn-tx-orange:hover { background: #e08e0b; border-color: #d0850b; color: #fff !important; }

.tx-stat-cards { margin-bottom: 18px; }
.tx-stat-card { border-radius: 8px; padding: 16px 18px; margin-bottom: 12px; display: flex; align-items: center; gap: 14px; border: 1px solid transparent; box-shadow: 0 2px 8px rgba(0,0,0,.06); background: #fff; }
.tx-stat-card .ico { width: 48px; height: 48px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 20px; color: #fff; flex-shrink: 0; }
.tx-stat-card.income .ico { background: linear-gradient(135deg,#5fabf7,#3d89e8); }
.tx-stat-card.expense .ico { background: linear-gradient(135deg,#f66b6b,#e84c4c); }
.tx-stat-card.balance .ico { background: linear-gradient(135deg,#4bc97b,#34a867); }
.tx-stat-card .lbl { font-size: 13px; color: #667085; font-weight: 500; margin: 0; }
.tx-stat-card .val { font-size: 20px; font-weight: 700; color: #1d2939; margin: 2px 0 0 0; }

.tx-tabs-row { margin-bottom: 14px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; border-bottom: 2px solid #eef0f3; padding-bottom: 8px; }
.tx-tabs-row .tabs { margin: 0; padding: 0; list-style: none; display: flex; gap: 6px 18px; }
.tx-tabs-row .tabs li a { padding: 8px 2px 10px 2px; display: inline-flex; align-items: center; gap: 8px; color: #64748b; font-weight: 500; border-bottom: 3px solid transparent; margin-bottom: -10px; }
.tx-tabs-row .tabs li.active a { color: #22a958; border-bottom-color: #22a958; }
.tx-tabs-row .tabs li a:hover { color: #1a7f44; text-decoration: none; }
.tx-tab-filter-dropdown .btn-dd { padding: 6px 12px; }

.tx-panel-inner { padding: 0 4px 8px 4px; }
.tx-inner-title { text-align: center; font-size: 12px; font-weight: 700; letter-spacing: .12em; color: #98a2b3; margin: 14px 0 6px; }
.tx-meta-line { text-align: center; font-size: 12px; color: #8792a8; margin-bottom: 14px; }

.tx-ist-table { border-collapse: separate; border-spacing: 0; width: 100%; }
.tx-ist-table thead th { background: #fafbfc; color: #425466; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; border-bottom: 2px solid #e8ecf0 !important; vertical-align: middle !important; padding: 12px 10px !important; }
.tx-ist-table tbody td { padding: 10px !important; vertical-align: middle !important; font-size: 14px; border-color: #eef0f3 !important; }
.tx-ist-table tbody tr:hover td { background: #fbfcfd; }
.tx-ist-table .col-dr { background: #fff4ef !important; color: #a63b29; font-weight: 600; text-align: right; max-width: 120px; }
.tx-ist-table .col-cr { background: #e9fbf0 !important; color: #1b6b43; font-weight: 600; text-align: right; max-width: 120px; }
.tx-dash { color: #c4cbd4; }

.tx-mini-btn { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 30px; border-radius: 5px; border: 1px solid transparent; text-decoration: none !important; }
.tx-mini-btn + .tx-mini-btn { margin-left: 4px; }
.tx-mini-btn.view { background: #edeafd; border-color: #dfd8fc; color: #5b43c6 !important; }
.tx-mini-btn.edit { background: #e8f4fe; border-color: #d3eafd; color: #1c7bcf !important; }
.tx-mini-btn.void { background: #fdeef0; border-color: #fcd7dc; color: #c93545 !important; }
.tx-mini-btn:hover { filter: brightness(0.96); opacity: .95; }
</style>

<?php

$money = static function ($n) {
    return "\xC2\xA3" . number_format((float) $n, 2);
};

$params_base = [];
if ($q !== '' && $q !== null) {
    $params_base['q'] = $q;
}
if (!empty($filters['source'])) {
    $params_base['source'] = $filters['source'];
}
if (!empty(trim((string) $filters['date_from']))) {
    $params_base['date_from'] = trim($filters['date_from']);
}
if (!empty(trim((string) $filters['date_to']))) {
    $params_base['date_to'] = trim($filters['date_to']);
}

$params_base = array_filter($params_base, static function ($v) {
    return $v !== '' && $v !== null;
});

$list_url_fn = static function (array $overrides) use ($params_base) {
    return site_url(Backend_URL . 'transaction') . '?' . \http_build_query(array_merge($params_base, $overrides));
};

/** Preserve tab (+ optional keyword) but drop source/date filters */
$clear_filter_params = ['tab' => $tab];
if ($q !== '' && $q !== null) {
    $clear_filter_params['q'] = $q;
}
$clear_filter_url = site_url(Backend_URL . 'transaction') . '?' . \http_build_query($clear_filter_params);

$subtitle_source = isset($source_filter_options[(string) $filters['source']])
    ? $source_filter_options[(string) $filters['source']]
    : 'All Source';

$subtitle_dates = 'Any';
$df = trim((string) $filters['date_from']);
$dt = trim((string) $filters['date_to']);
if ($df !== '' || $dt !== '') {
    if ($df !== '' && $dt !== '') {
        $subtitle_dates = htmlspecialchars($df) . ' &ndash; ' . htmlspecialchars($dt);
    } elseif ($df !== '') {
        $subtitle_dates = 'From ' . htmlspecialchars($df);
    } else {
        $subtitle_dates = 'Until ' . htmlspecialchars($dt);
    }
}
?>

<section class="content-header" style="display:none;"></section>

<section class="content tx-page">
    <div class="tx-toolbar row">
        <div class="col-sm-7">
            <h1>Transaction <small class="tx-subtle">Income Statement</small></h1>
            <div class="clearfix" style="margin-top:8px;">
                <?php echo anchor(site_url(Backend_URL . 'transaction/create'), '<i class="fa fa-plus"></i> Add New', 'class="btn btn-tx-green"'); ?>
                <button type="button" class="btn btn-tx-orange" onclick="alert('CSV import coming soon'); return false;">
                    <i class="fa fa-upload"></i> Import Data (CSV)
                </button>
            </div>
        </div>
    </div>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row tx-stat-cards">
        <div class="col-md-4">
            <div class="tx-stat-card income">
                <span class="ico"><i class="fa fa-plus"></i></span>
                <div>
                    <p class="lbl">Total Income</p>
                    <p class="val"><?php echo $money(isset($totals['total_income']) ? $totals['total_income'] : 0); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tx-stat-card expense">
                <span class="ico"><i class="fa fa-minus"></i></span>
                <div>
                    <p class="lbl">Total Expense</p>
                    <p class="val"><?php echo $money(isset($totals['total_expense']) ? $totals['total_expense'] : 0); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tx-stat-card balance">
                <span class="ico"><i class="fa fa-balance-scale"></i></span>
                <div>
                    <p class="lbl">Total Balance</p>
                    <p class="val"><?php echo $money(isset($totals['balance']) ? $totals['balance'] : 0); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="box" style="border-radius:10px;border:1px solid #e9ecef;">
        <div class="box-body" style="padding-top:14px;">
            <div class="tx-tabs-row">
                <ul class="tabs">
                    <li class="<?php echo $tab === 'transaction' ? 'active' : ''; ?>">
                        <a href="<?php echo htmlspecialchars($list_url_fn(['tab' => 'transaction'])); ?>"><i class="fa fa-bar-chart"></i> Transaction</a>
                    </li>
                    <li class="<?php echo $tab === 'void' ? 'active' : ''; ?>">
                        <a href="<?php echo htmlspecialchars($list_url_fn(['tab' => 'void'])); ?>"><i class="fa fa-ban"></i> Void</a>
                    </li>
                    <li class="<?php echo $tab === 'imported' ? 'active' : ''; ?>">
                        <a href="<?php echo htmlspecialchars($list_url_fn(['tab' => 'imported'])); ?>"><i class="fa fa-download"></i> Imported(CSV)</a>
                    </li>
                </ul>

                <div class="pull-right dropdown tx-tab-filter-dropdown">
                    <button class="btn btn-tx-orange btn-dd dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-filter"></i> Filter <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="min-width:280px;padding:14px;">
                        <form method="get" action="<?php echo site_url(Backend_URL . 'transaction'); ?>">
                            <?php if ($q !== '' && $q !== null): ?>
                                <input type="hidden" name="q" value="<?php echo htmlspecialchars($q); ?>">
                            <?php endif; ?>
                            <input type="hidden" name="tab" value="<?php echo htmlspecialchars($tab); ?>">
                            <div class="form-group">
                                <label class="small">Source</label>
                                <select class="form-control input-sm" name="source">
                                    <?php foreach ($source_filter_options as $sid => $slabel): ?>
                                        <option value="<?php echo htmlspecialchars($sid); ?>" <?php echo ((string)$filters['source'] === (string)$sid || ($filters['source'] === null && $sid === '')) ? 'selected' : ''; ?>><?php echo htmlspecialchars($slabel); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small">From</label>
                                <input type="text" name="date_from" class="form-control input-sm js_datepicker" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars((string)$filters['date_from']); ?>">
                            </div>
                            <div class="form-group">
                                <label class="small">To</label>
                                <input type="text" name="date_to" class="form-control input-sm js_datepicker" autocomplete="off" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars((string)$filters['date_to']); ?>">
                            </div>
                            <button type="submit" class="btn btn-sm btn-success btn-block">Apply</button>
                            <a href="<?php echo htmlspecialchars($clear_filter_url); ?>" class="btn btn-sm btn-default btn-block" style="margin-top:6px;">Clear filter</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tx-inner-title">INCOME STATEMENT</div>
            <div class="tx-meta-line">
                SOURCE: <?php echo htmlspecialchars($subtitle_source); ?> &nbsp; | &nbsp;
                DATE: <?php echo $subtitle_dates === 'Any' ? 'Any' : $subtitle_dates; ?>
            </div>

            <?php echo form_open('#', ['id' => 'tx-bulk-placeholder']); ?>
            <div class="table-responsive">
                <table class="table table-bordered tx-ist-table">
                    <thead>
                        <tr>
                            <th width="36"><input type="checkbox" id="chk-all-tx"></th>
                            <th width="118">Trans Date</th>
                            <th width="132">Source</th>
                            <th>Head / Sub Head</th>
                            <th>Remark</th>
                            <th width="132" class="text-right">Expense(Dr)</th>
                            <th width="132" class="text-right">Income(Cr)</th>
                            <th width="112" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($transactions as $transaction) {
                            $d = strtotime($transaction->tx_date);
                            $ts = isset($transaction->tx_status) ? $transaction->tx_status : null;
                            $is_voided = $ts === 0 || $ts === '0' || $ts === 'Void';

                            ?>
                            <tr>
                                <td><input type="checkbox" name="tid[]" value="<?php echo (int) $transaction->id; ?>" class="row-chk"></td>
                                <td><?php echo $d ? htmlspecialchars(date('j M, Y', $d)) : '-'; ?></td>
                                <td><?php echo !empty($transaction->source_name) ? htmlspecialchars($transaction->source_name) : '<span class="tx-dash">—</span>'; ?></td>
                                <td>
                                    <?php
                                    $hn = isset($transaction->head_name) && $transaction->head_name !== '' ? htmlspecialchars($transaction->head_name) : '-';
                                    $sn = isset($transaction->subhead_name) && $transaction->subhead_name !== '' ? htmlspecialchars($transaction->subhead_name) : '-';

                                    ?>
                                    <?php echo $hn; ?> <span style="color:#98a2b3;">/</span> <?php echo $sn; ?>
                                </td>
                                <td><?php echo htmlspecialchars((string)$transaction->remark); ?></td>
                                <td class="col-dr">
                                    <?php
                                    if (($transaction->nature ?? '') === 'Dr') {
                                        echo $money($transaction->amount);
                                    } else {
                                        echo '<span class="tx-dash">&mdash;</span>';
                                    }

                                    ?>
                                </td>
                                <td class="col-cr">
                                    <?php
                                    if (($transaction->nature ?? '') === 'Cr') {
                                        echo $money($transaction->amount);
                                    } else {
                                        echo '<span class="tx-dash">&mdash;</span>';
                                    }

                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php echo anchor(site_url(Backend_URL . 'transaction/details/' . $transaction->id), '<i class="fa fa-eye"></i>', 'class="tx-mini-btn view" title="View"'); ?>
                                    <?php echo anchor(site_url(Backend_URL . 'transaction/update/' . $transaction->id), '<i class="fa fa-pencil-square-o"></i>', 'class="tx-mini-btn edit" title="Edit"'); ?>
                                    <?php if (! $is_voided): ?>
                                        <?php echo anchor(site_url(Backend_URL . 'transaction/void_action/' . $transaction->id), '<i class="fa fa-ban"></i>', 'class="tx-mini-btn void" title="Void" onclick="return confirm(\'Void this transaction?\');"'); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                        }

                        if (empty($transactions)) {
                            ?>

                            <tr>
                                <td colspan="8" class="text-center text-muted" style="padding:36px;">
                                    No transactions found for this tab or filter.
                                </td>
                            </tr>
                            <?php
                        }

                            ?>
                    </tbody>
                </table>
            </div>
            <?php echo form_close(); ?>

            <div class="row">
                <div class="col-md-6" style="padding-top:12px;">
                    <span class="label label-success" style="font-size:13px;padding:8px 10px;font-weight:normal;">Listed: <?php echo (int) $total_rows; ?> row<?php echo (int)$total_rows === 1 ? '' : 's'; ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/lib/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script>
    (function () {
        $('.js_datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
        $('#chk-all-tx').on('change', function () {
            $('.tx-ist-table tbody .row-chk').prop('checked', $(this).prop('checked'));
        });
    })();
</script>
