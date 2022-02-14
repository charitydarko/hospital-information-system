<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- jquery ui css -->
	<link href="<?php echo base_url() ?>/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>

  <!-- Bootstrap --> 
  <link href="<?php echo base_url(); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

  <!-- Font Awesome 4.7.0 -->
  <link href="<?php echo base_url('/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>

  <!-- semantic css -->
  <link href="<?php echo base_url(); ?>/css/semantic.min.css" rel="stylesheet" type="text/css"/> 
  <!-- sliderAccess css -->
  <link href="<?php echo base_url(); ?>/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
  <!-- slider  -->
  <link href="<?php echo base_url(); ?>/css/select2.min.css" rel="stylesheet" type="text/css"/> 
  <!-- DataTables CSS -->
  <link href="<?php echo base_url('/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 


  <!-- pe-icon-7-stroke -->
  <link href="<?php echo base_url('/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
  <!-- themify icon css -->
  <link href="<?php echo base_url('/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
  <!-- Pace css -->
  <link href="<?php echo base_url('/css/flash.css') ?>" rel="stylesheet" type="text/css"/>
  <!-- google fonts -->
  <link href="<?php echo base_url('/css/fonts/opensans.css') ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('/css/fonts/alegreyasans.css') ?>" rel="stylesheet" type="text/css"/>
  <!-- Theme style -->
  <link href="<?php echo base_url('/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
  <!-- custom style -->
  <link href="<?php echo base_url('/css/style.css') ?>" rel="stylesheet" type="text/css"/>

  <!-- jQuery  -->
  <script src="<?php echo base_url('/js/jquery-3.5.1.min.js') ?>" type="text/javascript"></script>
  <title>Hospital Information System</title>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url('dashboard/home') ?>" class="logo"> <!-- Logo -->
        <span class="logo-mini">
          <img src="<?php echo base_url(); ?>/images/logo.png" alt="">
        </span>
        <span class="logo-lg">
          <img src="<?php echo base_url(); ?>/images/logo.png" alt="">
        </span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
            <span class="sr-only">Toggle navigation</span>
            <span class="pe-7s-keypad"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- settings -->
            <li class="dropdown dropdown-user">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
              <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>/dashboard/profile"><i class="pe-7s-users"></i>Profile</a></li>
                  <li><a href="<?php echo base_url(); ?>/dashboard/form"><i class="pe-7s-settings"></i>Edit Profile</a></li>
                  <li><a href="<?php echo base_url() ?>/dashboard/resetPassword"><i class="pe-7s-key"></i>Update Password</a></li>
                  <li><a href="<?php echo base_url() ?>/auth/logout"><i class="pe-7s-power"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel --> 
        <div class="user-panel text-center">
          <div class="image">
            <img src="<?php echo (!empty($picture) ? $picture : base_url()."/images/no-img.png"); ?>" class="img-circle" alt="User Image">
          </div>
          <div class="info">
            <p><?php echo $fullname ?></p>
            <a href="#">
              <i class="fa fa-circle text-success"></i>
              <?php   
                $userRoles = array( 
                  '1' => 'Admin',
                  '2' => 'Doctor',
                  '3' => 'Accountant',
                  '4' => 'Laboratorist',
                  '5' => 'Nurse',
                  '6' => 'Pharmacist',
                  '7' => 'Receptionist',
                  '8' => 'Representative', 
                  '9' => 'Cashier' 
                ); 
              ?>
            </a>
          </div>
        </div>

        <ul class="sidebar-menu">
          <li class="<?php $uri = current_url(true); echo ($uri->getSegment(1) == 'dashboard') ? "active" : null ?>">
            <a href="<?php echo base_url('dashboard/home') ?>"><i class="fa fa ti-home"></i> Dashboard</a>
          </li>
          <li class="treeview">
            <a href="#">
                <i class="fa fa-wheelchair"></i> <span>Patient</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url("patient/new") ?>">Add Patient</a></li>
              <li><a href="<?= base_url("patient") ?>">Patient List</a></li> 
              <li><a href="<?= base_url("patient/add_document") ?>">Add Document</a></li> 
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa ti-pencil-alt"></i> <span>Appointment</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Appointment</a></li>
              <li><a href="#">List Appointments</a></li> 
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa ti-calendar"></i> <span>Vitals</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Capture Vitals</a></li>
              <li><a href="#">View Vitals List</a></li> 
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa ti-book"></i> <span>Diagnosis</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Patient Diagnosis</a></li>
              <li><a href="#">Patient Diagnosis List</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i> <span>Pharmacy</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Prescription</a></li>
              <li><a href="#">Prescription List</a></li>
              <li><a href="#">Requests from Diagnosis</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i> <span>Laboratory</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Laboratory Test</a></li>
              <li><a href="#">Laboratory Test List</a></li>
              <li><a href="#">Requests from Diagnosis</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Billing</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Invoice</a></li>
              <li><a href="#">Invoice List</a></li>
              <li><a href="#">Add Payment</a></li>
              <li><a href="#">Payment List</a></li>
              <li><a href="#">Report</a></li>
            </ul>
          </li>
          <li class="treeview <?php $uri = current_url(true); echo ($uri->getSegment(1)  == 'human_resources') ? "active" : null ?>">
            <a href="#">
              <i class="fa fa-users"></i> <span>Human Resources</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url("humanresources/employee/form") ?>">Add Employee</a></li>
              <li><a href="#">Employee List</a></li>
              <li><a href="#">Report</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-hospital-o"></i> <span>Hospital Activities</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Operations Report</a></li>
              <li><a href="#">Operations Report List</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-bell"></i> <span>Noticeboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Notice</a></li>
              <li><a href="#">Notice List</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-comments-o"></i> <span>Messages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">New Message</a></li>
              <li><a href="#">Inbox</a></li>
              <li><a href="#">Sent</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa ti-email"></i> <span>Email</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Add Account</a></li>
              <li><a href="#">Account List</a></li>
              <li><a href="#">Add Invoice</a></li>
              <li><a href="#">Invoice List</a></li>
              <li><a href="#">Add Payment</a></li>
              <li><a href="#">Payment List</a></li>
              <li><a href="#">Report</a></li>
              <li><a href="#">Debit Report</a></li>
              <li><a href="#">Credit Report</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <div class="p-l-30 p-r-30">
          <div class="header-icon"><i class="pe-7s-world"></i></div>
          <div class="header-title">
              <h1><?php echo ($heading); ?></h1>
              <small><?php echo (!empty($title) ? esc($title) : null ) ?></small> 
          </div>
      </div>
      </section>

      <!-- Main content -->
      <div class="content"> 
        <div id="demoModeEnable"></div>
        <!-- alert message --> 
        <?php if (session()->getFlashdata('message') != null) {  ?>
          <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo session()->getFlashdata('message'); ?>
          </div> 
          <?php } ?>
          
          <?php if (session()->getFlashdata('exception') != null) {  ?>
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo session()->getFlashdata('exception'); ?>
            </div>
          <?php } ?>

        <?php if(isset($validation)){ ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= \Config\Services::validation()->listErrors(); ?>
              </div>
        <?php } ?>
        
        <!-- content -->
        <?php echo (!empty($content)?$content:null) ?>

      </div> <!-- /.content -->
		</div> <!-- /.content-wrapper -->
    <footer class="main-footer">
      2022©Copyright Ultisoft Technologies
    </footer>
  </div>

  <!-- jquery-ui js -->
	<script src="<?php echo base_url();?>/js/jquery-ui.min.js" type="text/javascript"></script> 
	<!-- bootstrap js -->
	<script src="<?php echo base_url();?>/js/bootstrap.min.js" type="text/javascript"></script>  
	<!-- pace js -->
	<script src="<?php echo base_url();?>/js/pace.min.js" type="text/javascript"></script>  
	<!-- SlimScroll -->
	<script src="<?php echo base_url();?>/js/jquery.slimscroll.min.js" type="text/javascript"></script>  

	<!-- bootstrap timepicker -->
	<script src="<?php echo base_url();?>/js/jquery-ui-sliderAccess.js" type="text/javascript"></script> 
	<script src="<?php echo base_url();?>/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> 
	<!-- select2 js -->
	<script src="<?php echo base_url();?>/js/select2.min.js" type="text/javascript"></script>

	<!-- ChartJs JavaScript -->
	<script src="<?php echo base_url();?>/js/Chart.min.js" type="text/javascript"></script>

	<!-- semantic js -->
	<script src="<?php echo base_url();?>/js/semantic.min.js" type="text/javascript"></script>
	<!-- DataTables JavaScript -->
	<script src="<?php echo base_url();?>/datatables/js/dataTables.min.js"></script>
	<!-- tinymce texteditor -->
	<script src="<?php echo base_url();?>/tinymce/tinymce.min.js" type="text/javascript"></script> 
	<!-- Table Head Fixer -->
	<script src="<?php echo base_url();?>/js/tableHeadFixer.js" type="text/javascript"></script> 

	<!-- Admin Script -->
	<script src="<?php echo base_url();?>/js/frame.js" type="text/javascript"></script> 

	<!-- Custom Theme JavaScript -->
	<script src="<?php echo base_url();?>/js/custom.js?v=1" type="text/javascript"></script>
</body>
</html>