<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

load_module_asset('users','css');
load_module_asset('users','js');

?>

<section class="content-header">
    <h1>User Details <small>of</small> <?php echo $first_name . ' ' . $last_name; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL; ?>"><i class="fa fa-dashboard"></i> Admin </a></li>        
        <li class="active">User list</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">               
            <?php echo Users_helper::makeTab($id,  'delete' ); ?>
            <div class="box box-primary no-border">
            
            
            <div style="padding: 15px;"> 
                <p class="alert alert-warning"><i class="fa fa-warning"></i> 
                    Deleting a user is not accepted due to user has many relational data.
                    You can only Freeze/Un-freeze a account.</p> 
            </div>

            <table class="table table-striped">	    	    	   
                <tr><td width="150">Full Name</td><td width="5">:</td><td><?php echo $first_name .' '. $last_name; ?></td></tr>
                <tr><td>Created Date</td><td>:</td><td><?php echo globalDateFormat($created); ?></td></tr>                                  
                <tr><td>Email</td><td>:</td><td><?php echo $email; ?></td></tr>	    
                <tr><td>Current Status</td><td>:</td><td id="currentStatus"><?php echo $status; ?></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>                    
                        <span onclick="setStatus('Inactive', <?php echo $id;  ?> );" class="btn btn-warning"> 
                            <i class="fa fa-random"></i> Freeze This Account
                        </span>

                        <span onclick="setStatus('Active', <?php echo $id;  ?> );" class="btn btn-success">                     
                            <i class="fa fa-random"></i> Unfreeze This Account
                        </span>
                    </td>
                </tr>
            </table>                                                                                                                                                              
            </div>                        
        </div>              
    </div>
</section>
<?php  load_module_asset('staff','js'); ?>