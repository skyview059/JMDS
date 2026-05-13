<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Template  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'sms/template') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>sms">Sms</a></li>
        <li><a href="<?php echo Backend_URL ?>sms/template">Template</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Template</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title :</label>
                <div class="col-sm-6">                    
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
                    <?php echo form_error('title') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Body :</label>
                <div class="col-sm-6">                    
                    <textarea rows="5" class="form-control" name="body" id="body"><?php echo $body; ?></textarea>                        
                    <p class="help-block text-red"><em>Letter Limit <b>160</b>. Write: <b id="write">0</b> Left: <b id="limit">0</b>.</em></p>
                    <?php echo form_error('body') ?>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url(Backend_URL . 'sms/template') ?>" class="btn btn-default">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<?php load_module_asset('sms', 'js'); ?>