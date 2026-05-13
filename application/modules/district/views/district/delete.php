<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>District  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>district">District</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo districtTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Name</td><td width="5">:</td><td><?php echo $name; ?></td></tr>
	    <tr><td width="150">Bn Name</td><td width="5">:</td><td><?php echo $bn_name; ?></td></tr>
	    <tr><td width="150">Lat</td><td width="5">:</td><td><?php echo $lat; ?></td></tr>
	    <tr><td width="150">Lon</td><td width="5">:</td><td><?php echo $lon; ?></td></tr>
	</table>
	<div class="box-header">
			 <?php echo anchor(site_url(Backend_URL .'district/delete_action/'.$id),'<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
	</div>
	</div></section>