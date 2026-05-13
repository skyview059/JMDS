<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Donation Log  <small>Control panel</small> 
        <?php echo anchor(site_url(Backend_URL . 'trans/entry'), 
                ' + Receive a Donation', 
                'class="btn btn-default"'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Trans</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                               
            <?php echo $this->load->view('filter'); ?>   
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Paid Date</th>
                            <th>Donor</th>
                            <th>Head</th>
                            <th class="text-right">Paid</th>                            
                            <th width="5"></th>
                            <th>Month</th>

                            <th>Collected By</th>
                            <th>Remark</th>
                            <th class="text-center" width="100">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($transs as $trans) {
                            $total += $trans->paid;
                            ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo bdDateFormat($trans->paid_date); ?></td>
                                <td>
                                    <a href="donor/stmt/<?php echo $trans->donor_id; ?>">
                                        <?php echo $trans->name; ?>
                                    </a>
                                </td>
                                <td><?php echo $trans->category; ?></td>
                                <td class="text-right"><?php echo BDT($trans->paid); ?></td>
                                <td></td>
                                <td><?php echo monthFormat($trans->month); ?></td>

                                <td><?php echo $trans->first_name . ' ' . $trans->last_name; ?></td>
                                <td><?php echo $trans->remark; ?></td>
                                <td class="text-center">
                                    <?php echo hideVoidBtn( $trans->timestamp, $trans->id ); ?>
                                </td>
                            </tr>
                        <?php } ?>
                            
                    </tbody>
                    <tr>
                        <th class="text-right" colspan="4">Total =</th>
                        <th class="text-right"><?php echo BDT($total); ?></th>
                        <th colspan="5"></th>
                    </tr>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Trans: <?php echo $total_rows ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>