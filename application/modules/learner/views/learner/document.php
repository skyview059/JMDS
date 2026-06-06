<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>Learner <small>Documents</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'learner') ?>">Learner</a></li>
        <li class="active">Documents</li>
    </ol>
</section>

<section class="content">
    <?php echo learnerTabs($learner->id, 'document'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Upload Documents for <?php echo $learner->name; ?></h3>
            <div class="pull-right">
                <a href="<?php echo site_url(Backend_URL . 'learner/details/' . $learner->id) ?>" class="btn btn-default btn-sm">
                    <i class="fa fa-long-arrow-left"></i> Back to Details
                </a>
            </div>
        </div>
        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            
            <?php 
            $uploaded_types = [];
            foreach ($attachments as $att) {
                $uploaded_types[] = strtolower(str_replace(' ', '_', $att->name));
            }
            ?>

            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>NID <?php echo in_array('nid', $uploaded_types) ? '<span class="label label-success">Uploaded</span>' : ''; ?></label>
                            <input type="file" name="nid" class="form-control" <?php echo in_array('nid', $uploaded_types) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Educational Certificate <?php echo in_array('educational_certificate', $uploaded_types) ? '<span class="label label-success">Uploaded</span>' : ''; ?></label>
                            <input type="file" name="educational_certificate" class="form-control" <?php echo in_array('educational_certificate', $uploaded_types) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Medical Faintness <?php echo in_array('medical_faintness', $uploaded_types) ? '<span class="label label-success">Uploaded</span>' : ''; ?></label>
                            <input type="file" name="medical_faintness" class="form-control" <?php echo in_array('medical_faintness', $uploaded_types) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Electricity Bill <?php echo in_array('electricity_bill', $uploaded_types) ? '<span class="label label-success">Uploaded</span>' : ''; ?></label>
                            <input type="file" name="electricity_bill" class="form-control" <?php echo in_array('electricity_bill', $uploaded_types) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" <?php echo count($uploaded_types) >= 4 ? 'disabled' : ''; ?>>
                        <i class="fa fa-upload"></i> Upload
                    </button>
                    <?php if(count($uploaded_types) >= 4): ?>
                        <span class="text-info ml-2">All documents uploaded.</span>
                    <?php endif; ?>
                </div>
            </form>

            <hr>

            <h4>Uploaded Documents</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Document Name</th>
                        <th>File Type</th>
                        <th>Size</th>
                        <th>Uploaded At</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($attachments)): ?>
                        <?php $i = 1; foreach ($attachments as $row): ?>
                            <tr>
                                <td width="10"><?php echo $i++; ?></td>
                                <td width="200"><?php echo $row->name; ?></td>
                                <td width="100"><?php echo strtoupper(str_replace('.', '', $row->type)); ?></td>
                                <td width="100"><?php echo number_format($row->size / 1024, 2); ?> KB</td>
                                <td width="150"><?php echo date('d M Y, h:i A', strtotime($row->uploaded_at)); ?></td>
                                <td width="150">
                                    <a href="<?php echo base_url('uploads/attachments/' . $row->path); ?>" target="_blank" class="btn btn-xs btn-info" title="View">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="<?php echo site_url(Backend_URL . 'learner/document_delete/' . $learner->id . '/' . $row->id); ?>" class="btn btn-xs btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this document?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No documents uploaded yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
