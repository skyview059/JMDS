<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Report  <small>Income Statement</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Report</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">            
                <div class="box-header with-border text-center">                                                       
                    <h3 class="box-title">Income & Expense Summery</h3>                    
                </div>                

                <div class="box-body">                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <tr><th width="40">S/L</th>
                                <th>Operator Name</th>
                                <th width="90" class="text-right">Income</th>
                                <th width="90" class="text-right">Expense</th>
                                <th width="90" class="text-right">Balance</th>
                            </tr>
                            <?php
                            $sl = $cr_tk = $dr_tk = 0;
                            foreach ($users as $user) {
                                $cr_tk += (int) $user->cr_tk;
                                $dr_tk += (int) $user->dr_tk;
                                ?>
                                <tr>
                                    <td><?php echo sprintf('%02d', ++$sl); ?></td>
                                    <td><?php echo $user->full_name; ?></td>
                                    <td class='text-right'><?php echo BDT((int) $user->dr_tk); ?></td>    
                                    <td class='text-right'><?php echo BDT((int) $user->cr_tk); ?></td>    
                                    <td class='text-right'><?php echo BDT((int)$user->dr_tk - (int)$user->cr_tk); ?></td>    
                                </tr>
                            <?php } ?>

                            <tr>
                                <th></th>
                                <th class='text-right'>Total & Balance =</th>
                                <th class='text-right'><?php echo BDT($dr_tk); ?></th>
                                <th class='text-right'><?php echo BDT($cr_tk); ?></th>
                                <th class='text-right'><?php echo BDT($cr_tk-$dr_tk); ?></th>
                            </tr>           
                        </table>
                    </div>
                </div>
            </div>
        </div>    

        <div class="col-md-6">
            <div class="box box-primary">            
                <div class="box-header with-border text-center">                                                       
                    <h3 class="box-title">Head Wise Summery</h3>                    
                </div>

                <div class="box-body">                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <tr><th width="40">S/L</th>
                                <th>Name of Head</th>
                                <th width="120" class="text-right">Expense TK</th>
                                <th width="120" class="text-right">Income TK</th>
                                <th width="120" class="text-right">Balance TK</th>
                            </tr>
                            <?php
                            $total = 0;
                            foreach ($heads as $head) {
                                $dr_tk += (int) $head->dr_tk;
                                $cr_tk += (int) $head->cr_tk;
                                ?>
                                <tr>
                                    <td><?php echo sprintf('%02d', $head->id); ?></td>
                                    <td><?php echo $head->name; ?></td>
                                    <td class='text-right'><?php echo BDT((int) $head->dr_tk); ?></td>   
                                    <td class='text-right'><?php echo BDT((int) $head->cr_tk); ?></td>   
                                    <td class='text-right'><?php echo BDT( $head->cr_tk - $head->dr_tk); ?></td>   
                                </tr>
                            <?php } ?>

                            <tr>
                                <th></th>
                                <th class='text-right'>Total =</th>
                                <th class='text-right'><?php echo BDT($dr_tk); ?></th>
                                <th class='text-right'><?php echo BDT($cr_tk); ?></th>
                                <th class='text-right'><?php echo BDT($cr_tk-$dr_tk); ?></th>
                            </tr>           
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</section>