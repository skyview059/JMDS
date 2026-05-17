<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Transaction <small><?php echo $button ?></small>
        <a href="<?php echo site_url( Backend_URL .'transaction') ?>" class="btn btn-default">Back</a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>transaction">Transaction</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">
    <style>
        .tx-card{background:#fff;border:1px solid #e8eaed;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,.06);max-width:1080px;margin:0 auto;overflow:hidden;}
        .tx-card .tx-head{display:flex;justify-content:space-between;align-items:center;padding:16px 24px;background:#f8f9fa;border-bottom:1px solid #eef0f3;}
        .tx-card .tx-head h3{margin:0;font-size:18px;font-weight:600;color:#2c3e50;}
        .tx-card .tx-head .tx-x{color:#8a8f99;font-size:22px;text-decoration:none;line-height:1;}
        .tx-card .tx-head .tx-x:hover{color:#333;}
        .tx-card .tx-body{padding:26px 28px;}
        .tx-card .tx-foot{display:flex;justify-content:space-between;align-items:center;padding:14px 24px;border-top:1px solid #eef0f3;background:#fff;}
        .tx-row{display:flex;align-items:flex-start;margin-bottom:18px;}
        .tx-row .tx-label{width:140px;text-align:right;padding-right:18px;padding-top:10px;color:#525c6b;font-weight:500;font-size:14px;flex-shrink:0;}
        .tx-row .tx-label .req{color:#f4506c;margin-right:2px;font-weight:700;}
        .tx-row .tx-ctrl{flex:1;min-width:0;}
        .tx-input,.tx-select{display:block;width:100%;height:42px;padding:8px 14px;font-size:14px;color:#333;background-color:#fff;border:1px solid #dfe3e8;border-radius:6px;box-shadow:none;transition:border-color .15s ease-in-out;}
        .tx-select{appearance:none;-webkit-appearance:none;-moz-appearance:none;background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='%23888' d='M4 6l4 4 4-4'/%3e%3c/svg%3e");background-repeat:no-repeat;background-position:right 12px center;background-size:14px;padding-right:34px;}
        .tx-input:focus,.tx-select:focus,.tx-textarea:focus{border-color:#4d8af0;outline:0;box-shadow:0 0 0 3px rgba(77,138,240,.12);}
        .tx-textarea{display:block;width:100%;min-height:92px;padding:10px 14px;font-size:14px;color:#333;background-color:#fff;border:1px solid #dfe3e8;border-radius:6px;resize:vertical;font-family:inherit;}
        .tx-igroup{position:relative;}
        .tx-igroup .tx-pref{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#6c757d;pointer-events:none;}
        .tx-igroup .tx-input.with-pref{padding-left:42px;}
        .tx-headwrap{display:flex;gap:10px;align-items:stretch;}
        .tx-headwrap .tx-half{flex:1;display:flex;align-items:stretch;border:1px solid #dfe3e8;border-radius:6px;background:#fff;overflow:hidden;}
        .tx-headwrap .tx-half .tx-half-label{display:flex;align-items:center;padding:0 14px;background:#f1f3f5;color:#495057;font-size:13px;font-weight:500;white-space:nowrap;border-right:1px solid #dfe3e8;}
        .tx-headwrap .tx-half .tx-select{border:0;border-radius:0;height:40px;background-color:#fff;}
        .tx-headwrap .tx-half .tx-select:focus{box-shadow:none;}
        .tx-amount{display:flex;align-items:center;gap:18px;border:1px solid #dfe3e8;border-radius:6px;padding:4px 14px;background:#fff;}
        .tx-amount .tx-radio{display:inline-flex;align-items:center;font-weight:400;margin:0;cursor:pointer;font-size:14px;color:#4a4a4a;}
        .tx-amount .tx-radio input{margin:0 7px 0 0;accent-color:#4d8af0;}
        .tx-amount .tx-amt-input{flex:1;border:0;outline:0;height:38px;padding:0 6px;font-size:14px;background:transparent;min-width:60px;}
        .tx-amount .tx-amt-suffix{color:#6c757d;border-left:1px solid #dfe3e8;padding-left:14px;font-weight:500;}
        .tx-dropzone{border:2px dashed #c5cdd6;border-radius:8px;padding:22px 18px;text-align:center;background:#fafbfc;cursor:pointer;max-width:240px;transition:border-color .15s,background .15s;}
        .tx-dropzone:hover{border-color:#4d8af0;background:#f5f9ff;}
        .tx-dropzone .tx-up-ico{display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:6px;background:#e7f7ee;color:#2ecc71;font-size:22px;margin-bottom:8px;}
        .tx-dropzone .tx-dz-txt{color:#6c757d;font-size:13px;margin:2px 0;}
        .tx-dropzone .tx-browse{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border:1px solid #4d8af0;color:#4d8af0;background:#fff;border-radius:6px;font-size:13px;margin-top:6px;}
        .tx-btn-save{background:#28a745;color:#fff;border:0;padding:9px 18px;border-radius:6px;font-weight:500;font-size:14px;display:inline-flex;align-items:center;gap:7px;cursor:pointer;}
        .tx-btn-save:hover,.tx-btn-save:focus{background:#23913d;color:#fff;}
        .tx-btn-close{background:#fff;color:#525c6b;border:1px solid #dfe3e8;padding:8px 16px;border-radius:6px;font-weight:500;font-size:14px;display:inline-flex;align-items:center;gap:7px;text-decoration:none;}
        .tx-btn-close:hover{background:#f8f9fa;color:#333;text-decoration:none;}
        .tx-card .text-danger{display:block;margin-top:4px;font-size:12px;}
        @media (max-width:768px){
            .tx-row{flex-direction:column;}
            .tx-row .tx-label{width:100%;text-align:left;padding:0 0 6px;}
            .tx-headwrap{flex-direction:column;}
        }
    </style>

    <?php echo form_open( $action, array('class'=>'tx-form', 'method'=>'post', 'enctype'=>'multipart/form-data')); ?>
    <div class="tx-card">
        <div class="tx-head">
            <h3>Add Transaction</h3>
            <a href="<?php echo site_url( Backend_URL .'transaction') ?>" class="tx-x" aria-label="Close">&times;</a>
        </div>

        <div class="tx-body">
            <div class="tx-row">
                <label class="tx-label" for="tx_date">Date :</label>
                <div class="tx-ctrl">
                    <div class="tx-igroup">
                        <span class="tx-pref"><i class="fa fa-calendar-o"></i></span>
                        <input type="text" class="tx-input with-pref js_datepicker" autocomplete="off" name="tx_date" id="tx_date" placeholder="Select Date" value="<?php echo $tx_date ? $tx_date : date('d M, Y'); ?>" />
                    </div>
                    <?php echo form_error('tx_date'); ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="user_id"><span class="req">*</span> Source :</label>
                <div class="tx-ctrl">
                    <select class="tx-select" name="user_id" id="user_id">
                        <option value="">Select Source</option>
                        <?php if (isset($source_list) && is_array($source_list)) {
                            foreach ($source_list as $id => $name) { ?>
                                <option value="<?php echo $id; ?>" <?php echo ($user_id == $id) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                        <?php }
                        } ?>
                    </select>
                    <?php echo form_error('user_id'); ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="head_id"><span class="req">*</span> Head :</label>
                <div class="tx-ctrl">
                    <div class="tx-headwrap">
                        <div class="tx-half">
                            <select class="tx-select" name="head_id" id="head_id">
                                <option value="">Select Head</option>
                                <?php if (isset($head_list) && is_array($head_list)) {
                                    foreach ($head_list as $id => $name) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ($head_id == $id) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="tx-half">
                            <span class="tx-half-label">SubHead</span>
                            <select class="tx-select" name="subhead_id" id="subhead_id">
                                <option value="">Select Sub Head</option>
                                <?php if (isset($subhead_list) && is_array($subhead_list)) {
                                    foreach ($subhead_list as $id => $name) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ($subhead_id == $id) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <?php echo form_error('head_id'); echo form_error('subhead_id'); ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="amount"><span class="req">*</span> Amount :</label>
                <div class="tx-ctrl">
                    <div class="tx-amount">
                        <label class="tx-radio">
                            <input type="radio" name="nature" value="Cr" <?php echo ($nature === 'Cr') ? 'checked' : ''; ?> /> Income
                        </label>
                        <label class="tx-radio">
                            <input type="radio" name="nature" value="Dr" <?php echo ($nature === 'Dr' || $nature === '' || $nature === null) ? 'checked' : ''; ?> /> Expense
                        </label>
                        <input type="number" step="any" class="tx-amt-input" name="amount" id="amount" placeholder="0" value="<?php echo $amount; ?>" />
                        <span class="tx-amt-suffix">$</span>
                    </div>
                    <?php echo form_error('amount'); echo form_error('nature'); ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="remark">Remark :</label>
                <div class="tx-ctrl">
                    <textarea class="tx-textarea" name="remark" id="remark" placeholder="Enter remark"><?php echo $remark; ?></textarea>
                    <?php echo form_error('remark'); ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label">Attachments :</label>
                <div class="tx-ctrl">
                    <div class="tx-dropzone" onclick="document.getElementById('tx_attachment').click();">
                        <div class="tx-up-ico"><i class="fa fa-upload"></i></div>
                        <div class="tx-dz-txt">Drag &amp; drop files here</div>
                        <div class="tx-dz-txt">or</div>
                        <span class="tx-browse"><i class="fa fa-link"></i> Browse</span>
                        <input type="file" id="tx_attachment" name="tx_attachment" style="display:none;" />
                    </div>
                </div>
            </div>

            <input type="hidden" name="batch_id" value="<?php echo $batch_id !== '' ? $batch_id : 0; ?>" />
            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id !== '' ? $vehicle_id : 0; ?>" />
            <input type="hidden" name="tx_status" value="<?php echo $tx_status ? $tx_status : 'OK'; ?>" />
            <input type="hidden" name="created_at" value="<?php echo $created_at ? $created_at : date('Y-m-d H:i:s'); ?>" />
            <input type="hidden" name="updated_at" value="<?php echo $updated_at ? $updated_at : date('Y-m-d H:i:s'); ?>" />
        </div>

        <div class="tx-foot">
            <a href="<?php echo site_url( Backend_URL .'transaction') ?>" class="tx-btn-close"><i class="fa fa-times"></i> Close</a>
            <button type="submit" class="tx-btn-save"><i class="fa fa-floppy-o"></i> Save Transaction</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</section>

<script>
    $(function () {
        if ($.fn.datepicker) {
            $('.js_datepicker').datepicker({
                format: 'dd M, yyyy',
                autoclose: true,
                todayHighlight: true
            });
        }

        var $dz = $('.tx-dropzone');
        $dz.on('dragover', function (e) {
            e.preventDefault(); e.stopPropagation();
            $(this).css({ 'border-color': '#4d8af0', 'background': '#f5f9ff' });
        }).on('dragleave drop', function (e) {
            e.preventDefault(); e.stopPropagation();
            $(this).css({ 'border-color': '', 'background': '' });
        }).on('drop', function (e) {
            var files = e.originalEvent.dataTransfer.files;
            if (files && files.length) {
                $('#tx_attachment')[0].files = files;
                $(this).find('.tx-dz-txt').first().text(files[0].name);
            }
        });

        $('#tx_attachment').on('change', function () {
            if (this.files && this.files.length) {
                $('.tx-dropzone .tx-dz-txt').first().text(this.files[0].name);
            }
        });
    });
</script>
