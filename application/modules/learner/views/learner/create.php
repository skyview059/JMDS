<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Learner  <small><?php echo $button ?></small> <a href="<?php echo site_url( Backend_URL .'learner') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>learner">Learner</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Learner</h3>
        </div>
        
        <div class="box-body">
        <?php echo form_open( $action, array('class'=>'form-horizontal', 'method'=>'post')); ?>
	    <div class="form-group">
                    <label for="batch_id" class="col-sm-2 control-label">Batch Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="batch_id" id="batch_id" placeholder="Batch Id" value="<?php echo $batch_id; ?>" />
                        <?php echo form_error('batch_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                        <?php echo form_error('name') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="dob" class="col-sm-2 control-label">Dob :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="dob" id="dob" placeholder="Dob" value="<?php echo $dob; ?>" />
                        <?php echo form_error('dob') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="nid" class="col-sm-2 control-label">Nid :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="nid" id="nid" placeholder="Nid" value="<?php echo $nid; ?>" />
                        <?php echo form_error('nid') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="father" class="col-sm-2 control-label">Father :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="father" id="father" placeholder="Father" value="<?php echo $father; ?>" />
                        <?php echo form_error('father') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="mother" class="col-sm-2 control-label">Mother :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="mother" id="mother" placeholder="Mother" value="<?php echo $mother; ?>" />
                        <?php echo form_error('mother') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="zila_id" class="col-sm-2 control-label">Zila Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="zila_id" id="zila_id" placeholder="Zila Id" value="<?php echo $zila_id; ?>" />
                        <?php echo form_error('zila_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="primary_mobile" class="col-sm-2 control-label">Primary Mobile :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="primary_mobile" id="primary_mobile" placeholder="Primary Mobile" value="<?php echo $primary_mobile; ?>" />
                        <?php echo form_error('primary_mobile') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="blood_group" class="col-sm-2 control-label">Blood Group :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="blood_group" id="blood_group" placeholder="Blood Group" value="<?php echo $blood_group; ?>" />
                        <?php echo form_error('blood_group') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="second_contact_person" class="col-sm-2 control-label">Second Contact Person :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="second_contact_person" id="second_contact_person" placeholder="Second Contact Person" value="<?php echo $second_contact_person; ?>" />
                        <?php echo form_error('second_contact_person') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="second_contact_mobile" class="col-sm-2 control-label">Second Contact Mobile :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="second_contact_mobile" id="second_contact_mobile" placeholder="Second Contact Mobile" value="<?php echo $second_contact_mobile; ?>" />
                        <?php echo form_error('second_contact_mobile') ?>
                    </div>
                </div>
	<div class="form-group">
                        <label for="is_resident"  class="col-sm-2 control-label">Is Resident :</label>
                        <div class="col-sm-10"  style="padding-top:8px;"><?php echo htmlRadio('is_resident',$is_resident,array('Yes' => 'Yes','No' => 'No'));  ?></div>
                </div>
	    <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Photo :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?php echo $photo; ?>" />
                        <?php echo form_error('photo') ?>
                    </div>
                </div>
	    <div class="form-group">        
                    <label for="remarks" class="col-sm-2 control-label">Remarks :</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="remarks" id="remarks" placeholder="Remarks"><?php echo $remarks; ?></textarea>
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
                    <label for="updated_at" class="col-sm-2 control-label">Updated At :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
                        <?php echo form_error('updated_at') ?>
                    </div>
                </div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
		    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
		    <a href="<?php echo site_url( Backend_URL .'learner') ?>" class="btn btn-default">Cancel</a>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>
</section>