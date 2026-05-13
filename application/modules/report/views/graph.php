<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="assets/lib/plugins/Highcharts/highcharts.src.min.js"></script>
<script type="text/javascript" src="assets/lib/plugins/Highcharts/jquery.highchartTable.js"></script>

<script type="text/javascript"> $(function () { $('table.highchart').highchartTable(); }); </script>
<style> .highchart-container {width: 98%;} </style>

<section class="content">                    
    <div class="box box-primary">            
        <div class="box-header with-border">
            
            
            <div class="box-header no-border">
                <center> 
                    <h3 class="no-margin"><?php echo getSettingItem('ComName');?></h3>                
                    <p class="no-margin"><?php echo getSettingItem('Address');?></p>
                    <p class="no-margin">Graph Chart</p>
                </center>
                
                
            </div>
            <div class="hide_on_print">
                    
                <form method="get">
                    <div class="col-md-4 col-md-offset-3 form-group">
                        <div class="input-group">                      
                            <span class="input-group-addon"><i class="fa fa-calendar"></i> Year </span>
                            <select class="form-control" name="year">
                                <?php echo numericDropDown(2019, date('Y'), 1, $year);?>
                            </select>
                            <span class="input-group-addon">Month </span>
                            <select class="form-control" name="month">
                                <?php echo selectOptions($month, array(                                                                        
                                    0 => 'All Month',
                                    1 => 'January',
                                    2 => 'February',
                                    3 => 'March',
                                    4 => 'April',
                                    5 => 'May',
                                    6 => 'June',
                                    7 => 'July',
                                    8 => 'August',
                                    9 => 'September',
                                    10 => 'October',
                                    11 => 'November',
                                    12 => 'December',
                                ));?>
                            </select>
                        </div>                        
                    </div>

                    <div class="col-md-3 col-sm-3  form-group">
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-bar-chart-o"></i> Filter
                        </button>                        
                    </div>
                </form>

            </div>
            
            
            
        </div>

        
        
        
        
        
        <div class="box-body">                                   
            <div class="highchart-container"></div>
            <div style="clear:both;"></div>
            <table class="highchart" 
                   data-graph-container=".highchart-container" 
                   data-graph-type="column"
                   style="display:none">
                <thead>
                    <tr>
                        <th>Daily Statement</th>
                        <th>Income(Cr)</th>
                        <th>Expense(Dr)</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach($days as $day ){ ?>                                        
                    <tr>
                        <td><?php echo $day['Date']; ?></td>                        
                        <td><?php echo $day['Cr']; ?></td>
                        <td><?php echo $day['Dr']; ?></td>
                    </tr>
                    <?php } ?>                    
                </tbody>
            </table>                                                               

        </div>
    </div>
    
     
</section>