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
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    
                    <h3 class="box-title">Donation Collection Report</h3>                                                                                                 
                    
                </div>
                <div class="box-body" id="collection_report">
                    <?php echo $collections; ?>
                </div>
                
            </div>
        </div>
        
        
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Month Wise Bill Status</h3>
                </div>
                <div class="box-body">
                    <?php //echo $due_bills; ?>
                </div>                
            </div>
        </div>
    </div>
</section> 

<?php load_module_asset('dashboard','js'); ?>