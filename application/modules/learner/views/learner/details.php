<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Learner  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'learner' )?>">Learner</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo learnerTabs($id, 'details'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Batch</td><td width="5">:</td><td><?php echo $batch_name; ?></td></tr>
	    <tr><td width="150">Name</td><td width="5">:</td><td><?php echo $name; ?></td></tr>
	    <tr><td width="150">Gender</td><td width="5">:</td><td><?php echo isset($gender) ? $gender : ''; ?></td></tr>
	    <tr><td width="150">Date Of Birth</td><td width="5">:</td><td><?php echo $dob; ?></td></tr>
	    <tr><td width="150">NID/BID</td><td width="5">:</td><td><?php echo $nid; ?></td></tr>
	    <tr><td width="150">Father</td><td width="5">:</td><td><?php echo $father; ?></td></tr>
	    <tr><td width="150">Mother</td><td width="5">:</td><td><?php echo $mother; ?></td></tr>
	    <tr><td width="150">Current Address</td><td width="5">:</td>
            <td>
                <?php echo "Village: $cu_village, P.O: $cu_postoffice, P.C: $cu_postcode, P.S: $cu_ps, District: " . (isset($cu_district_name) ? $cu_district_name : ''); ?>
            </td>
        </tr>
	    <tr><td width="150">Permanent Address</td><td width="5">:</td>
            <td>
                <?php echo "Village: $pa_village, P.O: $pa_postoffice, P.C: $pa_postcode, P.S: $pa_ps"; ?>
            </td>
        </tr>
	    <tr><td width="150">Primary Mobile</td><td width="5">:</td><td><?php echo $primary_mobile; ?></td></tr>
	    <tr><td width="150">Blood Group</td><td width="5">:</td><td><?php echo $blood_group; ?></td></tr>
	    <tr><td width="150">Second Contact Person</td><td width="5">:</td><td><?php echo $second_contact_person; ?></td></tr>
	    <tr><td width="150">Second Contact Mobile</td><td width="5">:</td><td><?php echo $second_contact_mobile; ?></td></tr>
	    <tr><td width="150">Is Resident</td><td width="5">:</td><td><?php echo $is_resident; ?></td></tr>
	    <tr>
            <td width="150">Photo</td>
            <td width="5">:</td>
            <td>                
                <img src="<?php echo getPhoto($photo ? 'uploads/learner/' . $photo : ''); ?>" alt="Photo" style="max-width:200px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                
            </td>
        </tr>
	    <tr><td width="150">Remarks</td><td width="5">:</td><td><?php echo $remarks; ?></td></tr>
	    <tr><td width="150">Created At</td><td width="5">:</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td width="150">Updated At</td><td width="5">:</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td></td>
		<td>
			<a href="<?php echo site_url( Backend_URL .'learner') ?>" class="btn btn-default">
				<i class="fa fa-long-arrow-left"></i> 
				Back
			</a>
			<a href="<?php echo site_url( Backend_URL .'learner/update/'.$id ) ?>" class="btn btn-success">
			<i class="fa fa-edit"></i> 
				Edit 
			</a>
		</td></tr>
	</table>
	</div></section>