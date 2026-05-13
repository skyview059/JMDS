<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Batch <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'batch/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Batch</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url(Backend_URL . 'batch'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url(Backend_URL . 'batch'); ?>" class="btn btn-default">Reset</a>
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
                            <th>Name</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Created At</th>
                            <th class="text-center" width="160">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($batchs as $batch) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $batch->name; ?></td>
                                <td><?php echo bdDateFormat($batch->date_start); ?></td>
                                <td><?php echo bdDateFormat($batch->date_end); ?></td>
                                <td><?php echo $batch->status; ?></td>
                                <td><?php echo $batch->remarks; ?></td>
                                <td><?php echo bdDateFormat($batch->created_at); ?></td>
                                <td>
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'batch/details/' . $batch->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-success"');
                                    echo anchor(site_url(Backend_URL . 'batch/update/' . $batch->id), '<i class="fa fa-fw fa-edit"></i> Edit',  'class="btn btn-xs btn-warning"');
                                    echo anchor(site_url(Backend_URL . 'batch/delete/' . $batch->id), '<i class="fa fa-fw fa-times"></i>', 'class="btn btn-xs btn-danger"');
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <span class="btn btn-success">Total Batch: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
    </div>
</section>