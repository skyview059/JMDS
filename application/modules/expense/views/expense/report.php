<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Income & Expense Summery by Month </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Expense</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                               
            <?php echo $this->load->view('report_filter'); ?>   
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>Expenses Report by Month</h3>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Month</th>
                            <th class="text-right">Expenses</th>                          
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($expenses as $expense) { $total_dr += $expense->dr; ?>
                            <tr>
                                <td><?php echo ++$dr_sl; ?></td>
                                <td><?php echo $expense->n_month; ?></td>
                                <td class="text-right"><?php echo BDT($expense->dr); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="2"> Total =</th>
                            <th class="text-right"><?php echo BDT($total_dr); ?></th>                            
                        </tr>
                    </tfoot>
                </table>
            </div>
                </div>
                <div class="col-md-6">
                    <h3>Income Report by Month</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Month</th>
                            <th class="text-right">Income</th>                          
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($incomes as $income) { $total_cr += $income->cr; ?>
                            <tr>
                                <td><?php echo ++$cr_sl; ?></td>
                                <td><?php echo $income->n_month; ?></td>
                                <td class="text-right"><?php echo BDT($income->cr); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="2"> Total =</th>
                            <th class="text-right"><?php echo BDT($total_cr); ?></th>                            
                        </tr>
                    </tfoot>
                </table>
            </div>
                </div>
            </div>
            
            
        </div>
    </div>
</section>