<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Vehicle  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>vehicle">Vehicle</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo vehicleTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Photo</td><td width="5">:</td><td><?php echo $photo; ?></td></tr>
	    <tr><td width="150">Number</td><td width="5">:</td><td><?php echo $number; ?></td></tr>
	    <tr><td width="150">Purchased Date</td><td width="5">:</td><td><?php echo $purchased_date; ?></td></tr>
	    <tr><td width="150">Amount</td><td width="5">:</td><td><?php echo $amount; ?></td></tr>
	    <tr><td width="150">Remark</td><td width="5">:</td><td><?php echo $remark; ?></td></tr>
	</table>
	<div class="box-header">
			 <?php echo anchor(site_url(Backend_URL .'vehicle/delete_action/'.$id),'<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
	</div>
	</div></section>