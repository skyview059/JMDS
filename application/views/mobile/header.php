<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo getSettingItem('ComName');?> | FreelancerKlub.com </title>
        <!-- Tell the browser to be responsive to screen width -->  
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">        
        <base href="<?php echo base_url(); ?>"/>
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/admin/dist/css/style.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/lib/font-awesome/font-awesome.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/admin/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="assets/admin/dist/css/skins/_all-skins.min.css">


        <!-- jQuery 2.2.3 -->
        <script src="assets/lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="assets/lib/plugins/jQueryUI/jquery-ui.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="assets/lib/plugins/select2/select2.min.css">   
        <script type='text/javascript' src="assets/lib/plugins/select2/select2.min.js"></script>

        <link href="assets/lib/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
        
        <script src="assets/custom/script.js" type="text/javascript"></script>        
        <link href="assets/custom/ajax.css" rel="stylesheet" type="text/css">
        <link href="assets/custom/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/custom/print.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

        <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo site_url(); ?>" class="navbar-brand">
              <span class="logo-mini">DA</span>                  
              <span class="logo-lg"><?php echo getSettingItem('comName') ?></span>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="<?php echo site_url('driving'); ?>"><i class="fa fa-dashboard"></i> Driving Plan <span class="sr-only"><i class="fa fa-dashboard"></i></span></a>
              
            </li>
            <li><a href="<?php echo site_url('driving/history'); ?>">
                <i class="fa fa-history"></i> History
              </a>
            </li>            
          </ul>
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo getLoginUserData('name');?></span>
              </a>
              <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <img src="assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  <p> <?php echo getLoginUserData('name');?> 
                      <small><?php echo getLoginUserData('user_mail');?></small>
                  </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                  <div class="pull-left">
                      <a href="<?php echo site_url('profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                      <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
              </li>
              </ul>
              </li> 
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
