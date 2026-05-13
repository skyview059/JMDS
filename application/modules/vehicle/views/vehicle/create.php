<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Vehicle  <small><?php echo $button ?></small> <a href="<?php echo site_url( Backend_URL .'vehicle') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>vehicle">Vehicle</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Vehicle</h3>
        </div>
        
        <div class="box-body">
        <?php echo form_open( $action, array('class'=>'form-horizontal', 'method'=>'post')); ?>
	    <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Photo :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?php echo $photo; ?>" />
                        <?php echo form_error('photo') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="number" class="col-sm-2 control-label">Number :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="number" id="number" placeholder="Number" value="<?php echo $number; ?>" />
                        <?php echo form_error('number') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="purchased_date" class="col-sm-2 control-label">Purchased Date :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="purchased_date" id="purchased_date" placeholder="Purchased Date" value="<?php echo $purchased_date; ?>" />
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
		    <a href="<?php echo site_url( Backend_URL .'vehicle') ?>" class="btn btn-default">Cancel</a>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>
</section>