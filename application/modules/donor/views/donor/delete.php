<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users', 'css'); ?>
<section class="content-header">
    <h1>Donor  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>donor">Donor</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo donorTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <table class="table table-striped">
            <tr><td width="150">Ref Id</td><td width="5">:</td><td><?php echo $ref_id; ?></td></tr>
            <tr><td>Area</td><td>:</td><td><?php echo $area_id; ?></td></tr>
            <tr><td>Name</td><td>:</td><td><?php echo $name; ?></td></tr>
            <tr><td>Contact</td><td>:</td><td><?php echo $contact; ?></td></tr>
            <tr><td>Add Line1</td><td>:</td><td><?php echo $add_line1; ?></td></tr>
            <tr><td>Add Line2</td><td>:</td><td><?php echo $add_line2; ?></td></tr>
            <tr><td>Registration Date</td><td>:</td><td><?php echo $reg_date; ?></td></tr>
            <tr><td>Remark</td><td>:</td><td><?php echo $remark; ?></td></tr>
            <tr><td>Status</td><td>:</td><td><?php echo $status; ?></td></tr>
        </table>
        <div class="box-header">
            <?php
            if( $has_trans ){
                echo "<span class=\"btn btn-success\">This donner has {$has_trans} transection(s). Delete Option Locked.</span>";
            } else {
                echo anchor(
                    site_url(Backend_URL . 'donor/delete_action/' . $id), 
                    '<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 
                    'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'
                );
            }
            
            ?>
        </div>
    </div>
</section>