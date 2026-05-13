<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Vehicle  <small>Control panel</small> <?php echo anchor(site_url( Backend_URL . 'vehicle/create'),' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li class="active">Vehicle</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url( Backend_URL .'vehicle'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url( Backend_URL .'vehicle'); ?>" class="btn btn-default">Reset</a>
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
		<th>Photo</th>
		<th>Number</th>
		<th>Purchased Date</th>
		<th>Amount</th>
		<th>Remark</th>
		<th class="text-center" width="160">Action</th>
                    </tr>
                </thead>

                <tbody>
	<?php foreach ($vehicles as $vehicle) { ?>
                    <tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $vehicle->photo; ?></td>
		<td><?php echo $vehicle->number; ?></td>
		<td><?php echo $vehicle->purchased_date; ?></td>
		<td><?php echo $vehicle->amount; ?></td>
		<td><?php echo $vehicle->remark; ?></td>
		<td>
			<?php 
			echo anchor(site_url(Backend_URL .'vehicle/details/'.$vehicle->id),'<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-success"'); 
			echo anchor(site_url(Backend_URL .'vehicle/update/'.$vehicle->id),'<i class="fa fa-fw fa-edit"></i> Edit',  'class="btn btn-xs btn-warning"'); 
			echo anchor(site_url(Backend_URL .'vehicle/delete/'.$vehicle->id),'<i class="fa fa-fw fa-times"></i>', 'class="btn btn-xs btn-danger"'); 
			?>
		</td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        
        
            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-success">Total Vehicle: <?php echo $total_rows ?></span>
	    
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>