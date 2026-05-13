<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Vehicle  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'vehicle' )?>">Vehicle</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo vehicleTabs($id, 'details'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Photo</td><td width="5">:</td><td><?php echo $photo; ?></td></tr>
	    <tr><td width="150">Number</td><td width="5">:</td><td><?php echo $number; ?></td></tr>
	    <tr><td width="150">Purchased Date</td><td width="5">:</td><td><?php echo bdDateFormat($purchased_date); ?></td></tr>
	    <tr><td width="150">Amount</td><td width="5">:</td><td><?php echo $amount; ?></td></tr>
	    <tr><td width="150">Remark</td><td width="5">:</td><td><?php echo $remark; ?></td></tr>
	    <tr><td></td><td></td>
		<td>
			<a href="<?php echo site_url( Backend_URL .'vehicle') ?>" class="btn btn-default">
				<i class="fa fa-long-arrow-left"></i> 
				Back
			</a>
			<a href="<?php echo site_url( Backend_URL .'vehicle/update/'.$id ) ?>" class="btn btn-success">
			<i class="fa fa-edit"></i> 
				Edit 
			</a>
		</td></tr>
	</table>
	</div></section>