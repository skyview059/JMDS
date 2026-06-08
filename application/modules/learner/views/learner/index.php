<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Learner <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'learner/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Learner</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-8">
                    <form method="get" action="<?php echo site_url(Backend_URL . 'learner'); ?>" class="form-inline">
                        <div class="form-group">
                            <label>Batch:</label>
                            <?php echo form_dropdown('batch_id', $batch_list, $batch_id, 'class="form-control input-sm"'); ?>
                        </div>
                        <div class="form-group">
                            <label>District:</label>
                            <?php echo form_dropdown('district_id', $district_list, $district_id, 'class="form-control input-sm"'); ?>
                        </div>
                        <div class="form-group">
                            <label>Resident:</label>
                            <?php echo form_dropdown('is_resident', $resident_list, $is_resident, 'class="form-control input-sm"'); ?>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        <a href="<?php echo site_url(Backend_URL . 'learner'); ?>" class="btn btn-sm btn-default">Reset</a>
                    </form>
                </div>
                <div class="col-md-4 text-right">
                    <form action="<?php echo site_url(Backend_URL . 'learner'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" name="q" value="<?php echo $q; ?>" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-sm" type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Batch</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>District</th>
                            <th>Primary Mobile</th>
                            <th>Blood Group</th>
                            <th>Is Resident</th>
                            
                            <th>Remarks</th>
                            <th class="text-center" width="160">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($learners as $learner) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $learner->batch_name; ?></td>                                
                                <td>
                                    <img src="<?php echo getPhoto($learner->photo ? 'uploads/learner/' . $learner->photo : ''); ?>" alt="Photo" style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
                                </td>
                                <td><?php echo $learner->name; ?></td>
                                <td><?php echo rand(18, 40); ?> years</td>
                                <td><?php echo $learner->district_name; ?></td>
                                <td><?php echo $learner->primary_mobile; ?></td>
                                <td><?php echo $learner->blood_group; ?></td>
                                <td><?php echo $learner->is_resident; ?></td>
                                <td><?php echo $learner->remarks; ?></td>
                                <td width="200">
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'learner/details/' . $learner->id), '<i class="fa fa-fw fa-external-link"></i>', 'class="btn btn-xs btn-success" title="View"');
                                    // echo anchor(site_url(Backend_URL . 'learner/document/' . $learner->id), '<i class="fa fa-fw fa-file-text-o"></i>', 'class="btn btn-xs btn-info" title="Documents"');
                                    echo anchor(site_url(Backend_URL . 'learner/print/' . $learner->id), '<i class="fa fa-fw fa-print"></i>', 'class="btn btn-xs btn-info" title="Print ID Card" target="_blank"');
                                    echo anchor(site_url(Backend_URL . 'learner/certificate/' . $learner->id), '<i class="fa fa-fw fa-file"></i>', 'class="btn btn-xs btn-info" title="Print Certificate" target="_blank"');
                                    echo anchor(site_url(Backend_URL . 'learner/update/' . $learner->id), '<i class="fa fa-fw fa-edit"></i>',  'class="btn btn-xs btn-warning" title="Edit"');
                                    echo anchor(site_url(Backend_URL . 'learner/delete/' . $learner->id), '<i class="fa fa-fw fa-times"></i>', 'class="btn btn-xs btn-danger" title="Delete"');
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <span class="btn btn-success">Total Learner: <?php echo $total_rows ?></span>
                    <a href="<?php echo site_url(Backend_URL . 'learner/print'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i> Print All ID Card</a>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
    </div>
</section>