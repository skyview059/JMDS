<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Head  <small>Control panel</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>expense">Expense</a></li>
        <li class="active">Head</li>
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
                        <?php echo form_open(Backend_URL . 'expense/head/create_action', array('class' => 'form-horizontal', 'method' => 'post')); ?>
                        <input type="hidden" name="status" value="Active"/>                 
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                        </div>
                        
                        <div class="form-group ">
                            <label for="type">Type :</label> &nbsp;&nbsp;
                            <?php echo htmlRadio('type', 'Head', array('Head' => 'Head', 'SubHead' => 'SubHead')); ?>
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
                        <form action="<?php echo site_url(Backend_URL . 'expense/head'); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php if ($q <> '') { ?>
                                        <a href="<?php echo site_url(Backend_URL . 'expense/head'); ?>" class="btn btn-default">Reset</a>
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
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th width="60" class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($heads as $head) { ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $head->type; ?></td>
                                        <td><?php echo $head->name; ?></td>
                                        <td><?php echo $head->status; ?></td>
                                        <td class="text-center">
                                            <?php
                                            echo anchor(site_url(Backend_URL . 'expense/head/update/' . $head->id), 
                                                    '<i class="fa fa-fw fa-edit"></i>', 
                                                    'class="btn btn-xs btn-warning" title="Edit"');                                            
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="row">                
                        <div class="col-md-6">
                            <span class="btn btn-primary">Total Expense: <?php echo $total_rows ?></span>

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