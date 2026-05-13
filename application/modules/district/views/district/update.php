<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>District<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>district">District</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content"><div class="box">
<div class="box-header with-border">
            <h3 class="box-title">Update District</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        
        <div class="box-body">
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                        <?php echo form_error('name') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="bn_name" class="col-sm-2 control-label">Bn Name :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="bn_name" id="bn_name" placeholder="Bn Name" value="<?php echo $bn_name; ?>" />
                        <?php echo form_error('bn_name') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="lat" class="col-sm-2 control-label">Lat :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="lat" id="lat" placeholder="Lat" value="<?php echo $lat; ?>" />
                        <?php echo form_error('lat') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="lon" class="col-sm-2 control-label">Lon :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="lon" id="lon" placeholder="Lon" value="<?php echo $lon; ?>" />
                        <?php echo form_error('lon') ?>
                    </div>
                </div>
	<div class="form-group">
	<div class="col-sm-10 col-sm-offset-2">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url( Backend_URL .'district') ?>" class="btn btn-default">Cancel</a>
	</div>
	</div>
<?php echo form_close(); ?>
	</div>
</div>
</section>