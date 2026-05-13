<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> District  <small><?php echo $button ?></small> <a href="<?php echo site_url( Backend_URL .'district') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>district">District</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New District</h3>
        </div>
        
        <div class="box-body">
        <?php echo form_open( $action, array('class'=>'form-horizontal', 'method'=>'post')); ?>
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
		    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
		    <a href="<?php echo site_url( Backend_URL .'district') ?>" class="btn btn-default">Cancel</a>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>
</section>