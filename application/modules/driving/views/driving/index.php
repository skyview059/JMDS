<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('driving', 'css'); ?>
<section class="content-header">
    <h1>Driving <small>Raw records</small>
        <a href="<?php echo site_url(Backend_URL . 'driving'); ?>" class="btn btn-info">
            <i class="fa fa-dashboard"></i> Dashboard
        </a>
        <a href="<?php echo site_url(Backend_URL . 'driving/history'); ?>" class="btn btn-info">
            <i class="fa fa-history"></i> History
        </a>
        <?php echo anchor(site_url(Backend_URL . 'driving/create'), ' + Add New', 'class="btn btn-default"'); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'driving'); ?>">Driving</a></li>
        <li class="active">All Rows</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url(Backend_URL . 'driving/listing'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q !== '') { ?>
                                <a href="<?php echo site_url(Backend_URL . 'driving/listing'); ?>" class="btn btn-default">Reset</a>
                            <?php } ?>
                            <button class="btn btn-success" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Driving #</th>
                            <th>Learner ID</th>
                            <th>Vehicle ID</th>
                            <th>Date</th>
                            <th class="text-center" width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($drivings as $driving) { ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td>#<?php echo (int) $driving->id; ?></td>
                                <td><?php echo (int) $driving->learning_id; ?></td>
                                <td><?php echo (int) $driving->vehicle_id; ?></td>
                                <td><?php echo $driving->tx_date; ?></td>
                                <td>
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'driving/details/' . $driving->id),
                                        '<i class="fa fa-fw fa-external-link"></i> View',
                                        'class="btn btn-xs btn-success"');
                                    echo anchor(site_url(Backend_URL . 'driving/update/' . $driving->id),
                                        '<i class="fa fa-fw fa-edit"></i> Edit',
                                        'class="btn btn-xs btn-warning"');
                                    echo anchor(site_url(Backend_URL . 'driving/delete/' . $driving->id),
                                        '<i class="fa fa-fw fa-times"></i>',
                                        'class="btn btn-xs btn-danger"');
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="btn btn-success">Total Driving: <?php echo $total_rows; ?></span>
                </div>
                <div class="col-md-6 text-right"><?php echo $pagination; ?></div>
            </div>
        </div>
    </div>
</section>
