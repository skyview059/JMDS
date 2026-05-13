<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Report  <small>Income Statement</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Report</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Monthly Income & Expense Report</h3>
            <p><b>Month of Report: <?php echo $label; ?></b></p>
            
            <form class="form-inline hide_on_print">
                <div class="form-group">                
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Year</span>
                                <select class="form-control" name="y">
                                    <option value="0">-- ALL--</option>
                                    <?php echo numericDropDown($min_year, $max_year, 1, $year); ?>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i> </span>                                                        
                            <select class="form-control" name="m">                
                                <?php echo getMonthDropDown($month); ?>
                            </select>                            
                            <span class="input-group-btn">                                
                                <button class="btn btn-primary" type="submit">Filter</button>
                                <a href="report/print_view" class="btn btn-default">Reset</a>
                            </span>
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
        <div class="box-body">

            <table class="table table-bordered table-condensed">
                <tr>
                    <th colspan="3" class="text-center">Income Heads</th>
                    <th width="5">&nbsp;</th>
                    <th colspan="3" class="text-center">Expense Heads</th>
                </tr>
                <tr>
                    <th width="40">S/L</th>
                    <th>Name of Head</th>
                    <th width="120" class="text-right">Income TK</th>
                    <th>&nbsp;</th>
                    <th width="40">S/L</th>
                    <th>Name of Head</th>
                    <th width="120" class="text-right">Expense TK</th>
                </tr>
                <tr>
                    <td colspan="3" class="no-padding">
                        <table class="table table-bordered table-striped table-condensed no-margin">                               
                                <?php
                                $total = 0;
                                foreach ($incomes as $income) {
                                    $total += (int) $income->paid;
                                    ?>
                                    <tr>
                                        <td width="40"><?php echo sprintf('%02d', $income->id); ?></td>
                                        <td><?php echo $income->name; ?></td>
                                        <td width="120" class='text-right'><?php echo BDT((int) $income->paid); ?></td>   
                                    </tr>
                                <?php } ?>
                                          
                            </table>
                    </td>
                    <td></td>
                    <td colspan="3" class="no-padding">
                        <table class="table table-bordered table-striped table-condensed no-margin">                            
                            <?php
                            $total_exp = 0;
                            foreach ($expenses as $expense) {
                                $total_exp += (int) $expense->paid;
                                ?>
                                <tr>
                                    <td width="40"><?php echo sprintf('%02d', $expense->id); ?></td>
                                    <td><?php echo $expense->name; ?></td>
                                    <td width="120" class='text-right'><?php echo BDT((int) $expense->paid); ?></td>  
                                </tr>
                            <?php } ?>     
                        </table>
                    </td>
                </tr>
                <tr>                    
                    <th colspan="2" class='text-right'>Total Income =</th>
                    <th class='text-right'><?php echo BDT($total); ?></th>
                    <th></th>                    
                    <th colspan="2" class='text-right'>Total Expense=</th>
                    <th class='text-right'><?php echo BDT($total_exp); ?></th>
                </tr> 
                <tr>                                        
                    <th class='text-center' colspan="7">Balance = <?php echo BDT($total - $total_exp); ?></th>                    
                </tr> 
            </table> 
        </div>
        <div class="box-footer with-border text-center hide_on_print">
            <span class="btn btn-primary" onclick="print('document');">
                <i class="fa fa-print"></i>
                Print
            </span>
        </div>
    </div>
</section>