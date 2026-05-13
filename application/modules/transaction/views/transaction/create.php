<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Transaction  <small><?php echo $button ?></small> <a href="<?php echo site_url( Backend_URL .'transaction') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>transaction">Transaction</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Transaction</h3>
        </div>
        
        <div class="box-body">
        <?php echo form_open( $action, array('class'=>'form-horizontal', 'method'=>'post')); ?>
	    <div class="form-group">
                    <label for="user_id" class="col-sm-2 control-label">User Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
                        <?php echo form_error('user_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="tx_date" class="col-sm-2 control-label">Tx Date :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="tx_date" id="tx_date" placeholder="Tx Date" value="<?php echo $tx_date; ?>" />
                        <?php echo form_error('tx_date') ?>
                    </div>
                </div>
	<div class="form-group">
                        <label for="nature"  class="col-sm-2 control-label">Nature :</label>
                        <div class="col-sm-10"  style="padding-top:8px;"><?php echo htmlRadio('nature',$nature,array('Dr' => 'Dr','Cr' => 'Cr'));  ?></div>
                </div>
	    <div class="form-group">
                    <label for="head_id" class="col-sm-2 control-label">Head Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="head_id" id="head_id" placeholder="Head Id" value="<?php echo $head_id; ?>" />
                        <?php echo form_error('head_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="subhead_id" class="col-sm-2 control-label">Subhead Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="subhead_id" id="subhead_id" placeholder="Subhead Id" value="<?php echo $subhead_id; ?>" />
                        <?php echo form_error('subhead_id') ?>
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
                    <label for="batch_id" class="col-sm-2 control-label">Batch Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="batch_id" id="batch_id" placeholder="Batch Id" value="<?php echo $batch_id; ?>" />
                        <?php echo form_error('batch_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="vehicle_id" class="col-sm-2 control-label">Vehicle Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="vehicle_id" id="vehicle_id" placeholder="Vehicle Id" value="<?php echo $vehicle_id; ?>" />
                        <?php echo form_error('vehicle_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="tx_status" class="col-sm-2 control-label">Tx Status :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="tx_status" id="tx_status" placeholder="Tx Status" value="<?php echo $tx_status; ?>" />
                        <?php echo form_error('tx_status') ?>
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
                    <label for="updated_at" class="col-sm-2 control-label">Updated At :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
                        <?php echo form_error('updated_at') ?>
                    </div>
                </div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
		    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
		    <a href="<?php echo site_url( Backend_URL .'transaction') ?>" class="btn btn-default">Cancel</a>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>
</section>