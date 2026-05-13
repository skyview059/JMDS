<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Donation Head  <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'trans/head/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>trans">Trans</a></li>
        <li class="active">Category</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url(Backend_URL . 'trans/head'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url(Backend_URL . 'trans/head'); ?>" class="btn btn-default">Reset</a>
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
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th class="text-center" width="200">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($heads as $head) { ?>
                        <tr>
                            <td><?php echo ++$start ?></td>
                            <td><?php echo $head->name; ?></td>
                            <td><?php echo $head->status; ?></td>
                            <td class="text-center">
                                <?php                                    
                                    echo anchor(
                                        site_url(Backend_URL . 'trans/head/update/' . $head->id),
                                        '<i class="fa fa-fw fa-edit"></i> Edit', 
                                        'class="btn btn-xs btn-warning"'
                                    );
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Trans: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>