<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Vehicle <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'vehicle') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>vehicle">Vehicle</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">
     <style>
        .tx-dropzone{border:2px dashed #c5cdd6;border-radius:8px;padding:22px 18px;text-align:center;background:#fafbfc;cursor:pointer;max-width:240px;transition:border-color .15s,background .15s;position:relative;}
        .tx-dropzone:hover{border-color:#4d8af0;background:#f5f9ff;}
        .tx-dropzone input[type="file"]{position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;cursor:pointer;}
        .tx-dropzone .tx-up-ico{display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:6px;background:#e7f7ee;color:#2ecc71;font-size:22px;margin-bottom:8px;}
        .tx-dropzone .tx-dz-txt{color:#6c757d;font-size:13px;margin:2px 0;}
        .tx-dropzone img{max-width:100%;max-height:150px;margin-top:10px;display:none;border-radius:4px;}
    </style>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Vehicle</h3>
        </div>

        <div class="box-body">
        
            <?php echo form_open_multipart($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label"><sup>*</sup> Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                    <?php echo form_error('name') ?>
                </div>
            </div>
             <div class="form-group">
                <label for="photo" class="col-sm-2 control-label">Photo :</label>
                <div class="col-sm-10">
                  <div class="tx-dropzone" id="photo_dropzone">
                        <div class="tx-up-ico"><i class="fa fa-cloud-upload"></i></div>
                        <div class="tx-dz-txt">Click to upload photo</div>
                        <input type="file" name="photo" id="photo_input" accept="image/*" onchange="previewImage(this)">
                        <img id="photo_preview" src="<?php echo getPhoto(''); ?>" alt="Preview" style="display:none;">
                    </div>
                    <?php echo form_error('photo') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="number" class="col-sm-2 control-label"><sup>*</sup>Number :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="number" id="number" placeholder="Number" value="<?php echo $number; ?>" />
                    <?php echo form_error('number') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="purchased_date" class="col-sm-2 control-label">Purchased Date :</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control js_datepicker" autocomplete="off" name="purchased_date" id="purchased_date" placeholder="Purchased Date" value="<?php echo $purchased_date; ?>" />
                    </div>
                    <?php echo form_error('purchased_date') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="amount" class="col-sm-2 control-label">Amount :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo $amount; ?>" />
                    <?php echo form_error('amount') ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="remark" class="col-sm-2 control-label">Remark :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" value="<?php echo $remark; ?>" />
                    <?php echo form_error('remark') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                    <a href="<?php echo site_url(Backend_URL . 'vehicle') ?>" class="btn btn-default">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>

<script>
function previewImage(input) {
    var preview = document.getElementById('photo_preview');
    var dzTxt = document.querySelector('.tx-dz-txt');
    var dzIco = document.querySelector('.tx-up-ico');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            dzTxt.style.display = 'none';
            dzIco.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "#";
        preview.style.display = 'none';
        dzTxt.style.display = 'block';
        dzIco.style.display = 'block';
    }
}
</script>