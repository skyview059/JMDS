<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Donor  <small>Bill Statement</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Donor</li>
    </ol>
</section>

<section class="content">
    
    <?php echo donorTabs($id, 'stmt'); ?>
    <div class="box no-border">            

        <div class="box-header text-center with-border">
            <h1 class="no-margin"><?php echo $name; ?></h1>
            <p class="text-bold"><?php echo $address . ', ' . $contact; ?></p>
        </div>
        <div class="box-body">            
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th width="80"> Date</th>                            
                            <th width="90">Month</th>
                            <th width="200">Head</th>
                            <th width="110" class="text-right">Donate</th>
                            <th>Collected By</th>
                            <th>Remark</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $t_paid = 0;

                        foreach ($stmts as $stmt) {
                            $t_paid += $stmt->paid;
                            ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo bdDateFormat($stmt->paid_date);  ?></td> 
                                <td><?php echo monthFormat($stmt->month);  ?></td>     
                                <td><?php echo $stmt->head_name;  ?></td>     
                                <td class="text-right text-bold"><?php echo BDT($stmt->paid); ?></td>             
                                <td><?php echo $stmt->first_name .' '. $stmt->last_name; ?></td>                                
                                <td><?php echo $stmt->remark; ?></td>
                                                   
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <th class="text-right" colspan="4">Total = </th>
                        <th class="text-right"><?php echo BDT($t_paid); ?></th> 
                        <th  colspan="3"></th>
                    </tr>
                </table>
            </div>

        </div>
    </div>


</section>