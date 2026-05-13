<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Learner  <small>Control panel</small> <?php echo anchor(site_url( Backend_URL . 'learner/create'),' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li class="active">Learner</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url( Backend_URL .'learner'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url( Backend_URL .'learner'); ?>" class="btn btn-default">Reset</a>
                            <?php } ?>
                            <button class="btn btn-success" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                    	<th width="40">S/L</th>
		<th>Batch Id</th>
		<th>Name</th>
		<th>Dob</th>
		<th>Nid</th>
		<th>Father</th>
		<th>Mother</th>
		<th>Zila Id</th>
		<th>Primary Mobile</th>
		<th>Blood Group</th>
		<th>Second Contact Person</th>
		<th>Second Contact Mobile</th>
		<th>Is Resident</th>
		<th>Photo</th>
		<th>Remarks</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th class="text-center" width="160">Action</th>
                    </tr>
                </thead>

                <tbody>
	<?php foreach ($learners as $learner) { ?>
                    <tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $learner->batch_id; ?></td>
		<td><?php echo $learner->name; ?></td>
		<td><?php echo $learner->dob; ?></td>
		<td><?php echo $learner->nid; ?></td>
		<td><?php echo $learner->father; ?></td>
		<td><?php echo $learner->mother; ?></td>
		<td><?php echo $learner->zila_id; ?></td>
		<td><?php echo $learner->primary_mobile; ?></td>
		<td><?php echo $learner->blood_group; ?></td>
		<td><?php echo $learner->second_contact_person; ?></td>
		<td><?php echo $learner->second_contact_mobile; ?></td>
		<td><?php echo $learner->is_resident; ?></td>
		<td><?php echo $learner->photo; ?></td>
		<td><?php echo $learner->remarks; ?></td>
		<td><?php echo $learner->created_at; ?></td>
		<td><?php echo $learner->updated_at; ?></td>
		<td>
			<?php 
			echo anchor(site_url(Backend_URL .'learner/details/'.$learner->id),'<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-success"'); 
			echo anchor(site_url(Backend_URL .'learner/update/'.$learner->id),'<i class="fa fa-fw fa-edit"></i> Edit',  'class="btn btn-xs btn-warning"'); 
			echo anchor(site_url(Backend_URL .'learner/delete/'.$learner->id),'<i class="fa fa-fw fa-times"></i>', 'class="btn btn-xs btn-danger"'); 
			?>
		</td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        
        
            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-success">Total Learner: <?php echo $total_rows ?></span>
	    
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>