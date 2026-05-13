<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Transaction  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'transaction' )?>">Transaction</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo transactionTabs($id, 'details'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">User Id</td><td width="5">:</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td width="150">Tx Date</td><td width="5">:</td><td><?php echo $tx_date; ?></td></tr>
	    <tr><td width="150">Nature</td><td width="5">:</td><td><?php echo $nature; ?></td></tr>
	    <tr><td width="150">Head Id</td><td width="5">:</td><td><?php echo $head_id; ?></td></tr>
	    <tr><td width="150">Subhead Id</td><td width="5">:</td><td><?php echo $subhead_id; ?></td></tr>
	    <tr><td width="150">Amount</td><td width="5">:</td><td><?php echo $amount; ?></td></tr>
	    <tr><td width="150">Remark</td><td width="5">:</td><td><?php echo $remark; ?></td></tr>
	    <tr><td width="150">Batch Id</td><td width="5">:</td><td><?php echo $batch_id; ?></td></tr>
	    <tr><td width="150">Vehicle Id</td><td width="5">:</td><td><?php echo $vehicle_id; ?></td></tr>
	    <tr><td width="150">Tx Status</td><td width="5">:</td><td><?php echo $tx_status; ?></td></tr>
	    <tr><td width="150">Created At</td><td width="5">:</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td width="150">Updated At</td><td width="5">:</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td></td>
		<td>
			<a href="<?php echo site_url( Backend_URL .'transaction') ?>" class="btn btn-default">
				<i class="fa fa-long-arrow-left"></i> 
				Back
			</a>
			<a href="<?php echo site_url( Backend_URL .'transaction/update/'.$id ) ?>" class="btn btn-success">
			<i class="fa fa-edit"></i> 
				Edit 
			</a>
		</td></tr>
	</table>
	</div></section>