<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Batch  <small><?php echo $button ?></small> <a href="<?php echo site_url( Backend_URL .'batch') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>batch">Batch</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Batch</h3>
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
                    <label for="date_start" class="col-sm-2 control-label">Date Start :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="date_start" id="date_start" placeholder="Date Start" value="<?php echo $date_start; ?>" />
                        <?php echo form_error('date_start') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="date_end" class="col-sm-2 control-label">Date End :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="date_end" id="date_end" placeholder="Date End" value="<?php echo $date_end; ?>" />
                        <?php echo form_error('date_end') ?>
                    </div>
                </div>
	<div class="form-group">
                        <label for="status"  class="col-sm-2 control-label">Status :</label>
                        <div class="col-sm-10"  style="padding-top:8px;"><?php echo htmlRadio('status',$status,array('Running' => 'Running','Close' => 'Close','Upcoming' => 'Upcoming'));  ?></div>
                </div>
	    <div class="form-group">
                    <label for="remarks" class="col-sm-2 control-label">Remarks :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks" value="<?php echo $remarks; ?>" />
                        <?php echo form_error('remarks') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="created_at" class="col-sm-2 control-label">Created At :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
                        <?php echo form_error('created_at') ?>
                    </div>
                </div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
		    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
		    <a href="<?php echo site_url( Backend_URL .'batch') ?>" class="btn btn-default">Cancel</a>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>
</section>