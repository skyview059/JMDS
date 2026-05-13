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
        <div class="col-md-5">
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
                            $sl = $income = $exp = 0;
                            foreach ($users as $user) {
                                $income += (int) $user->income;
                                $exp += (int) $user->expense;
                                ?>
                                <tr>
                                    <td><?php echo sprintf('%02d', ++$sl); ?></td>
                                    <td><?php echo "{$user->first_name} {$user->last_name}"; ?></td>
                                    <td class='text-right'><?php echo BDT((int) $user->income); ?></td>    
                                    <td class='text-right'><?php echo BDT((int) $user->expense); ?></td>    
                                    <td class='text-right'><?php echo BDT( (int)$user->income - (int)$user->expense); ?></td>    
                                </tr>
                            <?php } ?>

                            <tr>
                                <th></th>
                                <th class='text-right'>Total & Balance =</th>
                                <th class='text-right'><?php echo BDT($income); ?></th>
                                <th class='text-right'><?php echo BDT($exp); ?></th>
                                <th class='text-right'><?php echo BDT($income-$exp); ?></th>
                            </tr>           
                        </table>
                    </div>
                </div>
            </div>
        </div>    

        <div class="col-md-7">
            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">            
                        <div class="box-header with-border text-center">                                                       
                            <h3 class="box-title">Income Summery</h3>                    
                        </div>

                        <div class="box-body">                    
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <tr><th width="40">S/L</th>
                                        <th>Name of Head</th>
                                        <th width="120" class="text-right">Income Amount</th>
                                    </tr>
                                    <?php
                                    $total = 0;
                                    foreach ($incomes as $income) {
                                        $total += (int) $income->paid;
                                        ?>
                                        <tr>
                                            <td><?php echo sprintf('%02d', $income->id); ?></td>
                                            <td><?php echo $income->name; ?></td>
                                            <td class='text-right'><?php echo BDT((int) $income->paid); ?></td>   
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <th></th>
                                        <th class='text-right'>Total =</th>
                                        <th class='text-right'><?php echo BDT($total); ?></th>
                                    </tr>           
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">    

                    <div class="box box-primary">            
                        <div class="box-header with-border text-center">                                                       
                            <h3 class="box-title">Expense Summery</h3>                    
                        </div>


                        <div class="box-body">                    
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <tr><th width="40">S/L</th>
                                        <th>Name of Head</th>
                                        <th width="120" class="text-right">Expense Amount</th>
                                    </tr>
                                    <?php
                                    $total = 0;
                                    foreach ($expenses as $expense) {
                                        $total += (int) $expense->paid;
                                        ?>
                                        <tr>
                                            <td><?php echo sprintf('%02d', $expense->id); ?></td>
                                            <td><?php echo $expense->name; ?></td>
                                            <td class='text-right'><?php echo BDT((int) $expense->paid); ?></td>  
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <th></th>
                                        <th class='text-right'>Total =</th>
                                        <th class='text-right'><?php echo BDT($total); ?></th>
                                    </tr>           
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>
</section>