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
            $required_docs = [
                'nid' => 'NID',
                'educational_certificate' => 'Educational Certificate',
                'medical_faintness' => 'Medical Faintness',
                'electricity_bill' => 'Electricity Bill'
            ];

            $uploaded_docs = [];
            foreach ($attachments as $att) {
                $key = strtolower(str_replace(' ', '_', $att->name));
                $uploaded_docs[$key] = $att;
            }
            ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Document Name</th>
                        <th>File Type</th>
                        <th>Size</th>
                        <th>Uploaded At</th>
                        <th width="320">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($required_docs as $key => $doc_name): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $doc_name; ?></td>
                            
                            <?php if (isset($uploaded_docs[$key])): $row = $uploaded_docs[$key]; ?>
                                <td><?php echo strtoupper(str_replace('.', '', $row->type)); ?></td>
                                <td><?php echo number_format($row->size / 1024, 2); ?> KB</td>
                                <td><?php echo date('d M Y, h:i A', strtotime($row->uploaded_at)); ?></td>
                                <td>
                                    <?php 
                                    $file_url = (strpos($row->path, 'uploads/') === 0) ? base_url($row->path) : base_url('uploads/attachments/' . $row->path); 
                                    ?>
                                    <button type="button" class="btn btn-sm btn-info view-document-btn" data-url="<?php echo $file_url; ?>" data-type="<?php echo strtolower(str_replace('.', '', $row->type)); ?>" title="View">
                                        <i class="fa fa-eye"></i> View
                                    </button>
                                    <a href="<?php echo site_url(Backend_URL . 'learner/document_delete/' . $learner->id . '/' . $row->id); ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this document?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            <?php else: ?>
                                <td colspan="3" class="text-center text-muted">Not Uploaded</td>
                                <td>
                                    <form action="<?php echo site_url(Backend_URL . 'learner/document_upload/' . $learner->id); ?>" method="post" enctype="multipart/form-data" class="form-inline">
                                        <input type="hidden" name="doc_type" value="<?php echo $key; ?>">
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <input type="file" name="file" class="form-control input-sm" required style="width: 190px;">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-upload"></i> Upload
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Document Viewer Modal -->
<div class="modal fade" id="documentViewModal" tabindex="-1" role="dialog" aria-labelledby="documentViewModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="documentViewModalLabel">Document Viewer</h4>
            </div>
            <div class="modal-body" id="documentViewModalBody" style="text-align: center; min-height: 400px;">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <a href="#" id="documentDownloadBtn" class="btn btn-primary" target="_blank" download>Download</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var viewBtns = document.querySelectorAll('.view-document-btn');
    viewBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var url = this.getAttribute('data-url');
            var ext = this.getAttribute('data-type');
            
            var modalBody = document.getElementById('documentViewModalBody');
            var downloadBtn = document.getElementById('documentDownloadBtn');
            
            modalBody.innerHTML = ''; // Clear previous content
            downloadBtn.href = url; // Set download link
            
            if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                modalBody.innerHTML = '<img src="' + url + '" style="max-width: 100%; max-height: 70vh; height: auto;">';
            } else if (ext === 'pdf') {
                modalBody.innerHTML = '<iframe src="' + url + '" style="width: 100%; height: 70vh;" frameborder="0"></iframe>';
            } else {
                modalBody.innerHTML = '<div class="alert alert-warning" style="margin-top: 20px;">Preview not available for this file type. Please use the download button below.</div>';
            }
            
            $('#documentViewModal').modal('show');
        });
    });
});
</script>
