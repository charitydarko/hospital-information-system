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
            <!-- alert message --> 
            <?php if(session()->has('error')): ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php print_r(session('error')) ?>
              </div>
            <?php endif; ?>
            <?php if(session()->has('info')): ?>
              <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= session('info') ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="panel-body">
          <form action="/auth/confirm_login" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
              <label class="control-label" for="email">Email</label>
              <input type="text" placeholder="email" name="email" id="email" value="<?= old('email') ?>" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label" for="password">Password</label>
              <input type="password" placeholder="******" name="password" class="form-control" id="password">
              <div style="float: right;">Show Password <input type="checkbox" onclick="showPassword()"></div>
            </div>
            <div> 
              <button  type="submit" class="btn btn-success">Login</button> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function showPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.min.js" type="text/javascript"></script>
  <!-- bootstrap js -->
  <script src="<?php echo base_url(); ?>/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- bootstrap js -->
  <script src="<?php echo base_url(); ?>/js/login.js" type="text/javascript"></script>
</body>
</html>