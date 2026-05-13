<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>District  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'district' )?>">District</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo districtTabs($id, 'details'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Name</td><td width="5">:</td><td><?php echo $name; ?></td></tr>
	    <tr><td width="150">Bn Name</td><td width="5">:</td><td><?php echo $bn_name; ?></td></tr>
	    <tr><td width="150">Lat</td><td width="5">:</td><td><?php echo $lat; ?></td></tr>
	    <tr><td width="150">Lon</td><td width="5">:</td><td><?php echo $lon; ?></td></tr>
	    <tr><td></td><td></td>
		<td>
			<a href="<?php echo site_url( Backend_URL .'district') ?>" class="btn btn-default">
				<i class="fa fa-long-arrow-left"></i> 
				Back
			</a>
			<a href="<?php echo site_url( Backend_URL .'district/update/'.$id ) ?>" class="btn btn-success">
			<i class="fa fa-edit"></i> 
				Edit 
			</a>
		</td></tr>
	</table>
	</div></section>