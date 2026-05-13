<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Donor  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'donor' )?>">Donor</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo donorTabs($id, 'profile'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
            <tr><td width="150">Name</td><td width="5">:</td><td><?php echo $name; ?></td></tr>
            <tr><td>Ref Id</td ><td>:</td><td><?php echo $ref_id; ?></td></tr>	     
            <tr><td>Contact</td><td>:</td><td><?php echo $contact; ?></td></tr>
            <tr><td>Area</td><td>:</td><td><?php echo $area_id; ?></td></tr>	   
	    <tr><td>Address Line1</td><td>:</td><td><?php echo $add_line1; ?></td></tr>
	    <tr><td>Address Line2</td><td>:</td><td><?php echo $add_line2; ?></td></tr>
	    <tr><td>Registration Date</td><td>:</td><td><?php echo $reg_date; ?></td></tr>
	    <tr><td>Remark</td><td>:</td><td><?php echo $remark; ?></td></tr>
	    <tr><td>Status</td><td>:</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td></td><td><a href="<?php echo site_url( Backend_URL .'donor') ?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> Back</a><a href="<?php echo site_url( Backend_URL .'donor/update/'.$id ) ?>" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a></td></tr>
	</table>
	</div></section>