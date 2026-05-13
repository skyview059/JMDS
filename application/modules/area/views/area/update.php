<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Area<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>area">Area</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content"><div class="box">
<div class="box-header with-border">
            <h3 class="box-title">Update Area</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        
        <div class="box-body">
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                    <label for="en_name" class="col-sm-2 control-label">En Name :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="en_name" id="en_name" placeholder="En Name" value="<?php echo $en_name; ?>" />
                        <?php echo form_error('en_name') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="bn_name" class="col-sm-2 control-label">Bn Name :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="bn_name" id="bn_name" placeholder="Bn Name" value="<?php echo $bn_name; ?>" />
                        <?php echo form_error('bn_name') ?>
                    </div>
                </div>
	<div class="col-md-12 text-right">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url( Backend_URL .'area') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
	</div>
</div>
</section>