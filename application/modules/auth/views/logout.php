<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log Out</title>
  <base href="<?php echo base_url(); ?>"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
</head>
<body class="hold-transition login-page">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1><?php echo getSettingItem( 'comName' ) ?></h1>                
                <img class="img-responsive img-thumbnail text-center" src="assets/theme/images/logout.jpg" alt="Image"/>
                <p><br/>You are successfully log-out.</p>
                <p><a href="login" class="btn btn-primary">Click here to Log-in again</a></p>
            </div>
        </div>        
    </div>    
</body>
</html>


