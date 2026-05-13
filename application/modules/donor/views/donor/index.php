<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Donor  <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'donor/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Donor</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">
             
            <form action="<?php echo site_url(Backend_URL . 'donor'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <span class="input-group-addon"> Limit</span>
                    <select name="limit" class="form-control">
                        <?php echo numericDropDown(50,1000,50, $limit );?>
                    </select>                            
                </div>

                <div class="input-group">
                    <span class="input-group-addon"> Area</span>
                    <select name="area_id" class="form-control">
                        <?php echo Helper::getDropDownArea($area_id, '--All--' );?>
                    </select>                            
                </div>

                <div class="input-group">
                    <span class="input-group-addon"> Order by</span>
                    <select name="order_by" class="form-control">
                        <?php echo selectOptions($order_by, [
                            'Default' => 'Default',
                            'High2Low' => 'High 2 Low',
                            'Low2Hight' => 'Low 2 High',
                            'MaxTrans' => 'Maximum Trans',
                            'MinTrans' => 'Minimum Trans',
                        ]);?>
                    </select>                            
                </div>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Keyword" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">                                                                                                
                        <button class="btn btn-primary" type="submit">Search</button>
                        <a href="<?php echo site_url(Backend_URL . 'donor'); ?>" class="btn btn-default">Reset</a>
                    </span>
                </div>
            </form>
                 
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>                            
                            <th width="40">Ref.ID</th>                            
                            <th>Name</th>
                            <th class="text-right">Amount&nbsp;&nbsp;</th>
                            <th>Address</th>
                            <th width="100">Contact</th>
                            <th width="50" class="text-right text-green">Paid &nbsp;</th>
                            <th width="60" class="text-center">Times</th>
                            <th width="50" class="text-right text-green">Status</th>
                            <th width="150" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($donors as $sub){ ?>
                            <tr>
                                <td><?php echo sprintf('%02d',++$start); ?></td>                                
                                <td><?php echo $sub->ref_id; ?></td>                                
                                <td><?php 
                                echo anchor(site_url(Backend_URL . 'donor/profile/' . $sub->id), $sub->name . ' &nbsp;<i class="fa fa-external-link"></i>' );
                                
                                ?></td>
                                <td class="text-right"><?php echo BDT($sub->amount); ?>&nbsp;&nbsp;</td>                                
                                <td><?php echo $sub->add_line1; ?></td>                                
                                <td><?php echo bdContactNumber($sub->contact); ?></td>                                
                                <td class="text-right text-green text-bold"><?php echo BDT($sub->TotalPaid); ?></td>                            
                                <td class="text-center"><?php echo $sub->Times; ?></td>                            
                                <td class="text-right"><?php echo labelStatus($sub->status); ?></td>
                                <td class="text-center">
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'donor/stmt/' . $sub->id), '<i class="fa fa-fw fa-bars"></i> Log &#2547; ', 'class="btn btn-xs btn-primary"');
                                    echo anchor(site_url(Backend_URL . 'donor/update/' . $sub->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-warning"');                                    
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>