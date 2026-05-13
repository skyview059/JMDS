<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
load_module_asset('users','css');
load_module_asset('users','js');
?>

<section class="content-header">
    <h1>User Details <small>of</small> <?php echo $first_name . ' ' . $last_name; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin </a></li>        
        <li class="active">User list</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-9">               
            <?php echo Users_helper::makeTab($id,  'profile' ); ?>

            <div class="box box-primary no-border">
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-2"><p>Full Name</p></div>
                        <div class="col-md-4"><p>: <?php echo $first_name . ' ' . $last_name; ?></p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p>Email Address</p></div>                 
                        <div class="col-md-4"><p>: <?php echo $email; ?></p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p>Contact</p></div>
                        <div class="col-md-4"><p>: <?php echo $contact; ?></p></div>
                    </div>

                     <div class="row">
                        <div class="col-md-2"><p>Registration Date</p></div>
                        <div class="col-md-4"><p>: <?php echo globalDateFormat($created); ?>


                            <em><a> [ counting <?php echo sinceCalculator($created); ?> ] </a></em></p>
                        </div>
                    </div>


                    <div class="row" style="padding-top: 20px">
                        <div class="col-md-2"><p>Address Line 1</p></div>                 
                        <div class="col-md-4"><p>: <?php echo $add_line1; ?></p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p>Address Line 2</p></div>                 
                        <div class="col-md-4"><p>: <?php echo $add_line2; ?></p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-2"><p>City</p></div>                 
                        <div class="col-md-4"><p>: <?php echo $city; ?></p></div>
                    </div>


                    <div class="row">
                        <div class="col-md-2"><p>State/Region</p></div>
                        <div class="col-md-4"><p>: <?php echo $state; ?></p></div>
                    </div>


                    <div class="row">
                        <div class="col-md-2"><p>Postcode</p></div>
                        <div class="col-md-4"><p>: <?php echo $postcode; ?></p></div>
                    </div> 


                    <div class="row">
                        <div class="col-md-2"><p>Country</p></div>
                        <div class="col-md-4"><p>: <?php echo $country_id; ?></p></div>
                    </div> 




                </div>
            </div>                        
        </div>


        <div class="col-md-3" style="padding-top: 28px;">        
            <div class="box box-default">
                <div class="box-body box-profile">


                  <img class="profile-user-img img-responsive img-circle" src="<?php echo Users_helper::getUserProfilePhoto( $profile_photo ); ?>" alt="Profile Picture">

                  <h3 class="profile-username text-center"><?php echo $first_name . ' ' . $last_name; ?></h3>
                  <p class="text-muted text-center"><?php echo $role_id; ?></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Age</b> <a class="pull-right"><?php echo ageCalculator($dob); ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Date of Birth</b> <a class="pull-right"><?php echo globalDateFormat($dob); ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Status</b> <a class="pull-right"><?php echo $status; ?> </a>
                    </li>
                    <li class="list-group-item">
                      <b>Last Access</b> <a class="pull-right"><?php echo $last_access; ?> </a>
                    </li>                
                  </ul>



                </div>

                <!-- /.box-body -->
              </div>                             
        </div>
        <div class="clearfix"></div>
    </div>
</section>