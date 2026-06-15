<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Batch <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'batch/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Batch</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url(Backend_URL . 'batch'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url(Backend_URL . 'batch'); ?>" class="btn btn-default">Reset</a>
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
                <table class="table table-hover table-striped table-bordered table-condensed" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th width="30" class="text-center">S/L</th>
                            <th width="250">Batch & Course Details</th>                                        
                            <th>Timeline & Duration</th>
                            <th class="text-center" width="130">Seats Status</th>
                            <th class="text-center" width="130">Book Status</th>
                            <th class="text-right text-success bg-success">Income</th>
                            <th class="text-right text-danger bg-danger">Expenses</th>   
                            <th  class="text-right text-info">Profit</th>                     
                            <th class="text-center" width="130">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($batchs as $batch) { 
                            $booked_seat = $this->Batch_model->get_booked_seat($batch->id);
                            $available_seat = $batch->seat - $booked_seat;   
                            
                            // Fetching gender breakdown from your model
                            $male_count = 20; 
                            $female_count = 15;
                        ?>
                            <tr>
                                <td class="text-center" style="vertical-align: middle;"><?php echo ++$start ?></td>
                                <td style="vertical-align: middle;">
                                    <strong style="color: #333; font-size: 14px;"><?php echo $batch->name; ?></strong>
                                    <br>
                                    <span class="label label-info" style="font-size: 10px; padding: 2px 6px;"><?php echo $batch->course_type; ?></span>
                                </td>                                
                                <td style="vertical-align: middle;">
                                    <small class="text-muted"><i class="fa fa-calendar"></i> <?php echo getBatchTimeline($batch->date_start, $batch->date_end); ?></small>
                                </td>
                                <td style="vertical-align: middle; font-size: 12px; line-height: 1.5;">
                                    <div style="margin-bottom: 4px;">
                                        <span class="label label-default" style="display: inline-block; width: 100%;">Total: <?php echo $batch->seat; ?></span>
                                    </div>
                                    <div>
                                        <span class="label <?php echo ($available_seat > 0) ? 'label-success' : 'label-danger'; ?>" style="display: inline-block; width: 100%;">
                                            Available: <?php echo $available_seat; ?>
                                        </span>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; font-size: 12px; line-height: 1.5;">
                                    <div style="margin-bottom: 4px;">
                                        <span class="label label-primary" style="display: inline-block; width: 100%;">Booked: <?php echo $booked_seat; ?></span>
                                    </div>
                                    <!-- Gender Breakdown Badge -->
                                    <div style="background: #f1f3f5; padding: 3px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; text-align: center; margin-bottom: 4px; border: 1px solid #e2e8f0;">
                                        <span style="color: #0284c7;" title="Male Bookings"><i class="fa fa-mars"></i> M-<?php echo (int)$male_count; ?></span>
                                        <span style="color: #d946ef; margin-left: 8px;" title="Female Bookings"><i class="fa fa-venus"></i> F-<?php echo (int)$female_count; ?></span>
                                    </div>
                                </td>
                                <td class="text-right text-success" style="vertical-align: middle; font-weight: bold; background-color: #f8fff9;">
                                    <?php echo bdMoneyFormat($this->Batch_model->get_total_income($batch->id)); ?>
                                </td>
                                <td class="text-right text-danger" style="vertical-align: middle; font-weight: bold; background-color: #fff8f8;">
                                    <?php echo bdMoneyFormat($this->Batch_model->get_total_expenses($batch->id)); ?>
                                </td>  
                                <td class="text-right" style="vertical-align: middle; font-weight: bold; color: #28a745; background-color: #f8fff9;">
                                    0
                                </td>                                    
                                <td class="text-center" style="vertical-align: middle;">
                                    <div style="display: flex; gap: 4px; justify-content: center;">
                                        <?php
                                        echo anchor(site_url(Backend_URL . 'batch/details/' . $batch->id), '<i class="fa fa-external-link"></i>', 'class="btn btn-xs btn-success" title="View" style="padding: 4px 8px;"');
                                        echo anchor(site_url(Backend_URL . 'batch/update/' . $batch->id), '<i class="fa fa-edit"></i>',  'class="btn btn-xs btn-warning" title="Edit" style="padding: 4px 8px;"');                                        
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <span class="btn btn-success">Total Batch: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
    </div>
</section>