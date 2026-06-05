<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Driving  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>driving">Driving</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo drivingTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Learning Id</td><td width="5">:</td><td><?php echo $learning_id; ?></td></tr>
	    <tr><td width="150">Vehicle Id</td><td width="5">:</td><td><?php echo $vehicle_id; ?></td></tr>
	    <tr><td width="150">Tx Date</td><td width="5">:</td><td><?php echo $tx_date; ?></td></tr>
	</table>
	<div class="box-header">
			 <?php echo anchor(site_url(Backend_URL .'driving/delete_action/'.$id),'<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
	</div>
	</div></section>