<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap --> 
  <link href="<?php echo base_url(); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <!-- THEME RTL -->
  <link href="<?php echo base_url(); ?>/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>  
  <!-- 7 stroke css -->
  <link href="<?php echo base_url(); ?>/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
  <!-- style css -->
  <link href="<?php echo base_url(); ?>/css/custom.css" rel="stylesheet" type="text/css"/>
  <title>Hospital Information System</title>
</head>
<body>
  <div class="login-wrapper">
    <div class="container-center">
      <div class="panel panel-bd">
        <div class="panel-heading">
          <div class="view-header">
            <div class="header-icon">
              <i class="pe-7s-unlock"></i>
            </div>
            <div class="header-title">
              <h3>Ultisoft Hospital</h3>
              <small><strong>Please Login</strong></small>
            </div>
          </div>
          <div>
            <br><br>
            <?php if($isPost){ ?>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif;?>
            <?php } ?>
          </div>
        </div>
        <div class="panel-body">
          <form action="<?php echo base_url(); ?>/auth/login" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
              <label class="control-label" for="email">Email</label>
              <input type="text" placeholder="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label" for="password">Password</label>
              <input type="password" placeholder="******" name="password" id="password" class="form-control">
            </div>
            <div> 
              <button  type="submit" class="btn btn-success">Register</button> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.min.js" type="text/javascript"></script>
  <!-- bootstrap js -->
  <script src="<?php echo base_url(); ?>/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- bootstrap js -->
  <script src="<?php echo base_url(); ?>/js/login.js" type="text/javascript"></script>
</body>
</html>