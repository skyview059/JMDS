<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>
        Dashboard
        <small>Quick Report</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="box">
                <div class="box-body table-responsive" id="">                   
                    <table class="table table-bordered text-bold table-striped table-condensed">
                        <tbody>
                            <tr>
                                <th>Label</th>
                                <th class="text-right">Today</th>
                                <th class="text-right">Last 7 Days</th>
                                <th class="text-right">Current Month</th>
                                <th class="text-right">Current Year</th>
                                <th class="text-right">Lifetime</th>
                            </tr>
                            <tr class="bg-success">
                                <td>Donations</td>
                                <td class="text-right"><?php echo BDT($today); ?></td>
                                <td class="text-right"><?php echo BDT($this_week); ?></td>
                                <td class="text-right"><?php echo BDT($this_month); ?></td>
                                <td class="text-right"><?php echo BDT($this_year); ?></td>
                                <td class="text-right"><?php echo BDT($till_now); ?></td>
                            </tr>
                            <tr class="bg-warning">
                                <td>Expenses</td>
                                <td class="text-right"><?php echo BDT($today_exp); ?></td>
                                <td class="text-right"><?php echo BDT($this_week_exp); ?></td>
                                <td class="text-right"><?php echo BDT($this_month_exp); ?></td>
                                <td class="text-right"><?php echo BDT($this_year_exp); ?></td>
                                <td class="text-right"><?php echo BDT($till_now_exp); ?></td>
                            </tr>
                            <tr>
                                <td>Balance</td>
                                <td class="text-right"><?php echo BDT($today - $today_exp); ?></td>
                                <td class="text-right"><?php echo BDT($this_week - $this_week_exp); ?></td>
                                <td class="text-right"><?php echo BDT($this_month - $this_month_exp); ?></td>
                                <td class="text-right"><?php echo BDT($this_year - $this_year_exp); ?></td>
                                <td class="text-right"><?php echo BDT($till_now - $till_now_exp); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">    
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">

                        <div class="col-md-6">
                            <h3 class="box-title">Bill Collection Report</h3>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i> Date: </span>
                                <input type="text" readonly="readonly"
                                       class="form-control js_datepicker" 
                                       name="date" value="<?php echo $date; ?>"/>
                                <span class="input-group-btn">
                                    <span id="load_report" class="btn btn-primary"><i class="fa fa-refresh"></i></span>
                                </span>
                            </div>                                                                                    
                        </div>

                    </div>                    
                </div>
                <div class="box-body" id="collection_report">
                    <?php echo $collections; ?>
                    <div class="box-footer text-right">
                        <a class="btn btn-primary btn-xs" href="trans">
                            View All 
                            <i class="fa fa-long-arrow-right"></i> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section> 

<?php load_module_asset('dashboard', 'js'); ?>