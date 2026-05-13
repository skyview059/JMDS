<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <base href="<?php echo base_url(); ?>"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/admin/dist/css/AdminLTE.min.css">

        <link href="assets/custom/ajax.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
            .login-box, .register-box {
                margin: 2% auto;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">

            <div class="login-logo no-margin">
                <?php echo getSettingItem('comName') ?>
            </div>

            <div class="login-box-body">
                <p>Driving School Management System v.1.0</p>
            </div> 
            <!-- /.login-logo -->
            <div class="login-box-body">


                <form id="credential" action="<?php echo base_url('auth/login'); ?>" method="post">
                    <div id="loginPart"> 
                        <p class="login-box-msg hidden">Sign in to start your session</p>      
                        <div id="respond"></div>
                        <div class="form-group has-feedback">
                            <select id="username" name="username" class="form-control">
                                <?php echo Helper::getLoginUsers(); ?>
                            </select>
                          <!--<input type="text" id="username" name="username" class="form-control" placeholder="username"/>-->
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <span id='username_error'></span>

                        <div class="form-group has-feedback">
                            <input type="password" id="password" name="password" autocomplete="false" class="form-control" placeholder="Password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-8 no-padding">
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox"> Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit" id="signin" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>

                        <a href="#" id="forgotPwd">I forgot my password</a><br>

                    </div>

                    <div id="recoveryPart" style="display: none;">

                        <p class="login-box-msg">Enter Your Email Address.</p>
                        <div id="respond_pwd"></div>

                        <div class="form-group has-feedback">
                            <input type="text" id="recovery_email" name="recovery_email" class="form-control" placeholder="Enter Email Address"/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>

                        <div class="col-xs-6 no-padding">
                            <button type="button" id="recovery" class="btn btn-primary btn-block btn-flat">Reset My Password</button>
                        </div>
                        <div class="col-xs-6"><span id="view_login" class="btn btn-default btn-block btn-flat">Login Box</span></div>


                        <div class="clearfix"></div>
                    </div>

                </form>

                <!-- /.social-auth-links -->




            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        <script src="assets/lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <!--<script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>-->
        <script src="assets/admin/login.js" type="text/javascript"></script>
    </body>
</html>


