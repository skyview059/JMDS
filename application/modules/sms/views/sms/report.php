<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>SMS <small>Sent Log</small></h1>
    <div id="respond"></div>
    <ol class="breadcrumb">
        <li><a href="<?= site_url(Backend_URL); ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">SMS</li>
    </ol>
</section>
<script type="text/javascript" src="assets/lib/plugins/Highcharts/highcharts.src.min.js"></script>
<script type="text/javascript" src="assets/lib/plugins/Highcharts/jquery.highchartTable.js"></script>
<section class="content">       
    <div class="box">            
        <div class="box-header with-border"> 

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
                        <th>Month</th>
                        <th>Sent</th>
                    </tr>
                </thead>
                <tbody>      
                    <?php foreach ($months as $m){ ?>
                        <tr>
                            <td><?= $m->month; ?>(<?= $m->amount; ?>)</td>
                            <td><?= $m->amount; ?></td>                            
                        </tr>
                    <?php } ?>                                                            
                </tbody>
            </table>   
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function () {
        $('table.highchart').highchartTable();
    });
</script>
<style type="text/css">
    .highchart-container {width: 98%;} 
</style>