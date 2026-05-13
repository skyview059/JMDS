<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Template  <small>Control panel</small> 
        <?php echo anchor(site_url(Backend_URL . 'sms/template/create'), ' + Add New', 'class="btn btn-default hidden"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>sms">Sms</a></li>
        <li class="active">Template</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <h3 class="box-title">Pre-written SMS Format</h3>
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Body</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($templates as $template) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>                                
                                <td><p><b><?php echo $template->title; ?></b><br/>
                                    <?php echo nl2br($template->body); ?></p>
                                    
                                    <p>
                                        <span class="btn btn-xs btn-danger">SMS Length: <?php echo mb_strlen($template->body); ?></span>
                                
                                        <?php                                    
                                            echo anchor(
                                                site_url(Backend_URL . 'sms/template/update/' . $template->id), 
                                                '<i class="fa fa-fw fa-edit"></i> Edit', 
                                                'class="btn btn-xs btn-warning"'
                                            );                                    
                                        ?>
                                    </p>
                                </td>                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Sms: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>