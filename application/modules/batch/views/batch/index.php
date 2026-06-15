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
                            <th width="30" class="text-center" style="vertical-align: middle;">S/L</th>
                            <th width="200" style="vertical-align: middle;">Batch & Course Type</th>                                        
                            <th width="220" style="vertical-align: middle;">Timeline</th>
                            <th width="50" style="vertical-align: middle;">Duration</th>
                            <th class="text-center" width="130" style="padding: 8px 0; vertical-align: middle;">
                                <div style="margin-bottom: 4px;">Seat</div>
                                <div class="row" style="margin: 0; border-top: 1px solid #ccc; padding-top: 4px; font-size: 13px;">
                                    <div class="col-xs-6" style="border-right: 1px solid #ccc; padding: 0;">Booked</div>
                                    <div class="col-xs-6" style="padding: 0;">Left</div>
                                </div>
                            </th>
                            <th class="text-center" width="130" style="padding: 8px 0; vertical-align: middle;">
                                <div style="margin-bottom: 4px;">Gender</div>
                                <div class="row" style="margin: 0; border-top: 1px solid #ccc; padding-top: 4px; font-size: 13px;">
                                    <div class="col-xs-6" style="border-right: 1px solid #ccc; padding: 0;">Male</div>
                                    <div class="col-xs-6" style="padding: 0;">Female</div>
                                </div>
                            </th>
                            <th class="text-right text-success bg-success" style="vertical-align: middle;">Income</th>
                            <th class="text-right text-danger bg-danger" style="vertical-align: middle;">Expenses</th>   
                            <th  class="text-right text-info " style="vertical-align: middle;">Profit</th>                     
                            <th class="text-center" width="130" style="vertical-align: middle;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($batchs as $batch) { 
                            $booked_seat = isset($batch->booked_seat) ? $batch->booked_seat : $this->Batch_model->get_booked_seat($batch->id);
                            $available_seat = $batch->seat - $booked_seat;   
                            
                            // Fetching gender breakdown from your model
                            $male_count = isset($batch->male_count) ? $batch->male_count : 0; 
                            $female_count = isset($batch->female_count) ? $batch->female_count : 0;

                            $total_income = isset($batch->total_income) ? $batch->total_income : $this->Batch_model->get_total_income($batch->id);
                            $total_expenses = isset($batch->total_expenses) ? $batch->total_expenses : $this->Batch_model->get_total_expenses($batch->id);
                        ?>
                            <tr>
                                <td class="text-center" style="vertical-align: middle;"><?php echo ++$start ?></td>
                                <td style="vertical-align: middle;">
                                    <strong style="color: #333; font-size: 16px;"><?php echo $batch->name; ?></strong>
                                    <br>
                                    <div style="margin-top: 5px;">
                                        <span class="label label-info" style="font-size: 12px; padding: 4px 8px;"><?php echo $batch->course_type; ?></span>
                                    </div>
                                </td>                                
                                <td style="vertical-align: middle; font-size: 14px;">
                                    <span class="text-muted"> <?php echo getBatchTimeline($batch->date_start, $batch->date_end); ?></span>
                                </td>
                                <td style="vertical-align: middle; font-size: 14px;">
                                    <span class="text-muted"><?php echo get_difference_in_weeks($batch->date_start, $batch->date_end); ?></span>
                                </td>
                                <td class="text-center" style="vertical-align: middle; padding: 8px 0;">
                                    <div class="row" style="margin: 0; font-size: 14px;">
                                        <div class="col-xs-6" style="border-right: 1px solid #ddd; padding: 0; font-weight: bold;"><?php echo $booked_seat; ?></div>
                                        <div class="col-xs-6" style="padding: 0; font-weight: bold;"><?php echo $available_seat; ?></div>
                                    </div>
                                </td>
                                <td class="text-center" style="vertical-align: middle; padding: 8px 0;">
                                    <div class="row" style="margin: 0; font-size: 14px;">
                                        <div class="col-xs-6" style="border-right: 1px solid #ddd; padding: 0; font-weight: bold; color: #0284c7;"><?php echo (int)$male_count; ?></div>
                                        <div class="col-xs-6" style="padding: 0; font-weight: bold; color: #d946ef;"><?php echo (int)$female_count; ?></div>
                                    </div>
                                </td>
                                <td class="text-right text-success bg-success" style="vertical-align: middle; font-weight: bold; ">
                                    <?php echo bdMoneyFormat($total_income); ?>
                                </td>
                                <td class="text-right text-danger bg-danger" style="vertical-align: middle; font-weight: bold; ">
                                    <?php echo bdMoneyFormat($total_expenses); ?>
                                </td>  
                                <td class="text-right" style="vertical-align: middle; font-weight: bold; ">
                                    <?php echo bdMoneyFormat($total_income - $total_expenses); ?>
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