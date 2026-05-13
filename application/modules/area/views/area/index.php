<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Area  <small>Control panel</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Area</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-4 col-xs-12">            
            <div class="box box-primary">                
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </h3>
                </div>

                <div class="box-body">
                    <div style="padding:0 15px;">
                        <?php echo form_open(Backend_URL . 'area/create_action', array('class' => 'form-horizontal', 'method' => 'post')); ?>
                        <div class="form-group">
                            <label for="en_name">En Name</label>
                            <input type="text" class="form-control" name="en_name" id="en_name" placeholder="En Name" />
                        </div>
                        <div class="form-group">
                            <label for="bn_name">Bn Name</label>
                            <input type="text" class="form-control" name="bn_name" id="bn_name" placeholder="Bn Name" />
                        </div>
                        <button type="submit" class="btn btn-primary">Save New</button> 
                        <button type="reset" class="btn btn-default">Reset</button>                         
                        <?php echo form_close(); ?>

                    </div>                    
                </div>    
            </div>
        </div>

        <div class="col-md-8 col-xs-12">

            <div class="box box-primary">            
                <div class="box-header with-border">                                   
                    <div class="col-md-5 col-md-offset-7 text-right">
                        <form action="<?php echo site_url(Backend_URL . 'area'); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php if ($q <> '') { ?>
                                        <a href="<?php echo site_url(Backend_URL . 'area'); ?>" class="btn btn-default">Reset</a>
                                    <?php } ?>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box-body">
                    <?php echo $this->session->flashdata('message'); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="40">S/L</th>
                                    <th>Name(English)</th>
                                    <th>Name(Bangla)</th>
                                    <th class="text-right" width="90">Subscriber</th>
                                    <th class="text-right" width="100">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php  foreach ($areas as $area) {
                                    
                                    $total += $area->Qty;
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $area->en_name ?></td>
                                        <td><?php echo $area->bn_name ?></td>
                                        <td class="text-right"><?php echo $area->Qty; ?></td>
                                        <td class="text-right" >
                                            <?php
                                            echo anchor(
                                                    site_url(Backend_URL . 'area/update/' . $area->id), 
                                                    '<i class="fa fa-fw fa-edit"></i>', 
                                                    'class="btn btn-xs btn-primary" title="Edit"'
                                                    );
                                            if($area->Qty == 0){
                                                echo anchor(site_url(Backend_URL . 'area/delete/' . $area->id), 
                                                        '<i class="fa fa-fw fa-trash"></i>',
                                                        'onclick="return confirm(\'Confirm Delete\')" class="btn btn-xs btn-danger" title="Delete"'
                                                        );
                                            } else {
                                                echo '<span class="btn btn-xs btn-danger" disabled title="Delete Not Allow">';
                                                echo '<i class="fa fa-fw fa-lock"></i></span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tr>
                                <td class="text-right text-bold" colspan="3">Total = </td>
                                <td class="text-right text-bold"><?php echo $total; ?> </td>
                                <td></td>                                
                            </tr>
                        </table>
                    </div>


                    <div class="row">                
                        <div class="col-md-6">
                            <span class="btn btn-primary">Total: <?php echo $total_rows ?></span>

                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>                
                    </div>
                </div>
            </div>
        </div>   
    </div>
</section>