<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Learner  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>learner">Learner</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo learnerTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Batch Id</td><td width="5">:</td><td><?php echo $batch_id; ?></td></tr>
	    <tr><td width="150">Name</td><td width="5">:</td><td><?php echo $name; ?></td></tr>
	    <tr><td width="150">Dob</td><td width="5">:</td><td><?php echo $dob; ?></td></tr>
	    <tr><td width="150">Nid</td><td width="5">:</td><td><?php echo $nid; ?></td></tr>
	    <tr><td width="150">Father</td><td width="5">:</td><td><?php echo $father; ?></td></tr>
	    <tr><td width="150">Mother</td><td width="5">:</td><td><?php echo $mother; ?></td></tr>
	    <tr><td width="150">Zila Id</td><td width="5">:</td><td><?php echo $zila_id; ?></td></tr>
	    <tr><td width="150">Primary Mobile</td><td width="5">:</td><td><?php echo $primary_mobile; ?></td></tr>
	    <tr><td width="150">Blood Group</td><td width="5">:</td><td><?php echo $blood_group; ?></td></tr>
	    <tr><td width="150">Second Contact Person</td><td width="5">:</td><td><?php echo $second_contact_person; ?></td></tr>
	    <tr><td width="150">Second Contact Mobile</td><td width="5">:</td><td><?php echo $second_contact_mobile; ?></td></tr>
	    <tr><td width="150">Is Resident</td><td width="5">:</td><td><?php echo $is_resident; ?></td></tr>
	    <tr><td width="150">Photo</td><td width="5">:</td><td><?php echo $photo; ?></td></tr>
	    <tr><td width="150">Remarks</td><td width="5">:</td><td><?php echo $remarks; ?></td></tr>
	    <tr><td width="150">Created At</td><td width="5">:</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td width="150">Updated At</td><td width="5">:</td><td><?php echo $updated_at; ?></td></tr>
	</table>
	<div class="box-header">
			 <?php echo anchor(site_url(Backend_URL .'learner/delete_action/'.$id),'<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
	</div>
	</div></section>