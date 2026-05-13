<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Subscriber  <small>Control panel</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Subscriber</li>
    </ol>
</section>

<section class="content">       
    <div class="box">     
        
        <div class="box-header with-border text-center">
            <h1 class="no-margin"><?php echo getSettingItem('ComName'); ?></h1> 
            <p>Due Bills & Amount of  <?php echo Helper::getAreaName($area_id); ?></p> 
            <form action="<?php echo site_url(Backend_URL . 'donor/dues'); ?>" class="form-inline hide_on_print" method="get">

                <div class="input-group">
                    <span class="input-group-addon">Area</span>
                    <select name="area_id" class="form-control">
                        <?php echo Helper::getDropDownArea($area_id, '--Select--'); ?>
                    </select>                            
                </div>
                <div class="input-group">
                    <span class="input-group-addon"> Year</span>
                    <select name="year" class="form-control">
                        <?php echo numericDropDown(2018, 2022, 1, $year); ?>
                    </select>                            
                </div>
                <div class="input-group">
                    <span class="input-group-addon">Status</span>
                    <select name="status" class="form-control">
                        <?php
                        echo selectOptions($status, [
                            'All' => '-- All --',
                            'Active' => 'Active',
                            'Inactive' => 'Inactive',
                        ]);
                        ?>                        
                    </select>                            
                </div>

                <div class="input-group">                    
                    <span class="input-group-btn">                                                                                                
                        <button class="btn btn-primary" type="submit">Show Due List</button>                        
                    </span>
                </div>
            </form>

        </div>

        <div class="box-body zero_padding_on_print"> 
            
            <pre class="text-red"><?php echo $last_query;// echo "<pre>"; print_r($donors); echo "</pre>";?></pre>
            <div class="table-responsive">
                <table id="print_tbl" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>                            
                            <th width="220">Name</th>                            
                            <th width="100">Contact</th>
                            <th>Month(s) &nbsp;</th>
                            <th width="40" class="text-center">Qty</th>
                            <th width="100" class="text-right">Monthly Pay</th>                                                        
                            <th width="100" class="text-right text-red">Total Due</th>                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $t_qty = $m_pay = $total = 0;
                        foreach ($donors as $donor) {
                            $dueData = findOutMissingMonths($donor->id,$year,$donor->reg_date);
                            $total += $donor->amount * $dueData['count'];
                            $m_pay += $donor->amount;
                            $t_qty += $dueData['count'];
                            ?>
                            <tr>
                                <td><?php echo $donor->id//echo ++$start ?></td>                               
                                <td><?php echo $donor->name?></td>
                                <td><?php echo bdContactNumber($donor->contact); ?></td>
                                <td><?php echo $dueData['months']; ?></td>
                                <td class="text-center"><?php echo $dueData['count']; ?></td>
                                <td class="text-right"><?php echo BDT($donor->amount); ?></td>
                                <td class="text-right text-red text-bold"><?php echo BDT($donor->amount * $dueData['count']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <th class="text-right" colspan="4">Total = </th>                        
                        <th class="text-center"><?php  echo $t_qty; ?></th>
                        <th class="text-right"><?php echo BDT($m_pay); ?></th>           
                        <th class="text-right text-red"><?php echo BDT($total); ?></th>           
                    </tr>
                </table>
            </div>
            <p class="show_on_print" style="font-style: italic;">Print at <?php echo date('d-M-y - h:ia') ?>. Software By FreelancerKlub.com</p>
        </div>

        <div class="box-footer text-center hide_on_print">
            <span class="btn btn-primary" onclick="print(document);"><i class="fa fa-print"></i> Print </span>
        </div>
    </div>
</section>