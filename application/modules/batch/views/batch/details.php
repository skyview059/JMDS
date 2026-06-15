<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Batch  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'batch' )?>">Batch</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo batchTabs($id, 'details'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php 
            $booked_seat = $this->Batch_model->get_booked_seat($id);
            $available_seat = $seat - $booked_seat;
            $male_count = $this->Batch_model->get_male_count($id); 
            $female_count = $this->Batch_model->get_female_count($id);
            $income = $this->Batch_model->get_total_income($id);
            $expenses = $this->Batch_model->get_total_expenses($id);
            $profit = $income - $expenses;
        ?>
        <table class="table table-striped">
            <tr><td width="150">Name</td><td width="5">:</td>
                <td><strong style="color: #333; font-size: 14px;"><?php echo $name; ?></strong></td>
            </tr>
            <tr><td width="150">Course Type</td><td width="5">:</td>
                <td><span class="label label-info" style="font-size: 10px; padding: 2px 6px;"><?php echo $course_type; ?></span></td>
            </tr>
            <tr><td width="150">Timeline</td><td width="5">:</td>
                <td><small class="text-muted"><i class="fa fa-calendar"></i> <?php echo getBatchTimeline($date_start, $date_end); ?></small></td>
            </tr>
            <tr><td width="150">Seats Status</td><td width="5">:</td>
                <td>
                    <span class="label label-default" style="display: inline-block; margin-right: 5px;">Total: <?php echo $seat; ?></span>
                    <span class="label <?php echo ($available_seat > 0) ? 'label-success' : 'label-danger'; ?>" style="display: inline-block;">Available: <?php echo $available_seat; ?></span>
                </td>
            </tr>
            <tr><td width="150">Book Status</td><td width="5">:</td>
                <td>
                    <span class="label label-primary" style="display: inline-block; margin-right: 5px; vertical-align: middle;">Booked: <?php echo $booked_seat; ?></span>
                    <div style="background: #f1f3f5; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; display: inline-block; border: 1px solid #e2e8f0; vertical-align: middle;">
                        <span style="color: #0284c7;" title="Male Bookings"><i class="fa fa-mars"></i> M-<?php echo (int)$male_count; ?></span>
                        <span style="color: #d946ef; margin-left: 8px;" title="Female Bookings"><i class="fa fa-venus"></i> F-<?php echo (int)$female_count; ?></span>
                    </div>
                </td>
            </tr>
            <tr><td width="150">Financials</td><td width="5">:</td>
                <td>
                    <span class="text-success" style="font-weight: bold; margin-right: 15px;"><i class="fa fa-arrow-up"></i> Income: <?php echo bdMoneyFormat($income); ?></span>
                    <span class="text-danger" style="font-weight: bold; margin-right: 15px;"><i class="fa fa-arrow-down"></i> Expenses: <?php echo bdMoneyFormat($expenses); ?></span>
                    <span class="text-info" style="font-weight: bold;"><i class="fa fa-money"></i> Profit: <?php echo bdMoneyFormat($profit); ?></span>
                </td>
            </tr>
            <tr><td width="150">Status</td><td width="5">:</td><td><?php echo labelStatus($status); ?></td></tr>
            <tr><td width="150">Remarks</td><td width="5">:</td><td><?php echo $remarks; ?></td></tr>
            <tr><td width="150">Created At</td><td width="5">:</td><td><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo bdDateTimeFormat($created_at); ?></small></td></tr>
	    <tr><td></td><td></td>
		<td>
			<a href="<?php echo site_url( Backend_URL .'batch') ?>" class="btn btn-default">
				<i class="fa fa-long-arrow-left"></i> 
				Back
			</a>
			<a href="<?php echo site_url( Backend_URL .'batch/update/'.$id ) ?>" class="btn btn-success">
			<i class="fa fa-edit"></i> 
				Edit 
			</a>            
		    <?php if ($booked_seat == 0): ?>
		        <?php echo anchor(site_url(Backend_URL .'batch/delete_action/'.$id),'<i class="fa fa-fw fa-trash"></i> Delete ', 'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
            <?php endif; ?>
		</td></tr>
	</table>
	</div></section>