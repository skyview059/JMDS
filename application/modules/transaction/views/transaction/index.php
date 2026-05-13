<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Transaction  <small>Control panel</small> <?php echo anchor(site_url( Backend_URL . 'transaction/create'),' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li class="active">Transaction</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url( Backend_URL .'transaction'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url( Backend_URL .'transaction'); ?>" class="btn btn-default">Reset</a>
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
		<th>User Id</th>
		<th>Tx Date</th>
		<th>Nature</th>
		<th>Head Id</th>
		<th>Subhead Id</th>
		<th>Amount</th>
		<th>Remark</th>
		<th>Batch Id</th>
		<th>Vehicle Id</th>
		<th>Tx Status</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th class="text-center" width="160">Action</th>
                    </tr>
                </thead>

                <tbody>
	<?php foreach ($transactions as $transaction) { ?>
                    <tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $transaction->user_id; ?></td>
		<td><?php echo $transaction->tx_date; ?></td>
		<td><?php echo $transaction->nature; ?></td>
		<td><?php echo $transaction->head_id; ?></td>
		<td><?php echo $transaction->subhead_id; ?></td>
		<td><?php echo $transaction->amount; ?></td>
		<td><?php echo $transaction->remark; ?></td>
		<td><?php echo $transaction->batch_id; ?></td>
		<td><?php echo $transaction->vehicle_id; ?></td>
		<td><?php echo $transaction->tx_status; ?></td>
		<td><?php echo $transaction->created_at; ?></td>
		<td><?php echo $transaction->updated_at; ?></td>
		<td>
			<?php 
			echo anchor(site_url(Backend_URL .'transaction/details/'.$transaction->id),'<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-success"'); 
			echo anchor(site_url(Backend_URL .'transaction/update/'.$transaction->id),'<i class="fa fa-fw fa-edit"></i> Edit',  'class="btn btn-xs btn-warning"'); 
			echo anchor(site_url(Backend_URL .'transaction/delete/'.$transaction->id),'<i class="fa fa-fw fa-times"></i>', 'class="btn btn-xs btn-danger"'); 
			?>
		</td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        
        
            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-success">Total Transaction: <?php echo $total_rows ?></span>
	    
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>