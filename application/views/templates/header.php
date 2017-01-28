<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>">

    <title><?php echo ucwords($title); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome core CSS -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">    
    <!-- Creative Time Fresh Bootstrap Table Template -->
    <link href="<?php echo base_url('assets/css/fresh-bootstrap-table.css'); ?>" rel="stylesheet">
    <!-- Bootstrap Datepicker -->
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'); ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
  </head>

  <body>
    <div id="drawer" class="sidebar open">
      <div class="head">
        <img src="<?php echo base_url('assets/img/logo/200px.png'); ?>" class="logo">
        <h5>MCHL Institute of Business and Technolgy</h5>
        <p class="subtitle">
          <?php if ($this->session->userdata('authentication') == 'admin'): ?>
            Administrator
          <?php endif ?>
          <?php if ($this->session->userdata('authentication') == 'employee'): ?>
            Employee
          <?php endif ?>
          Dashboard
        </p>
      </div>
      <div class="tabs">
        <ul class="nav nav-sidebar">
          <li <?php if($tab == "student"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('student'); ?>"><i class="fa fa-graduation-cap"></i> Students</a></li>
          <?php if ($this->session->userdata('authentication') == 'admin'): ?>
            <li <?php if($tab == "course"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('course'); ?>"><i class="fa fa-book"></i> Courses</a></li>
            <li <?php if($tab == "payment"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('payment'); ?>"><i class="fa fa-money"></i> Payments</a></li>
          <?php endif ?>
          <?php if ($this->session->userdata('authentication') == 'employee'): ?>
            <li <?php if($tab == "payment"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('payment/new'); ?>"><i class="fa fa-money"></i> Payments</a></li>
            <li <?php if($tab == "expense"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('expense/new'); ?>"><i class="fa fa-align-left"></i> Expenses</a></li>
          <?php endif ?>
          <?php if ($this->session->userdata('authentication') == 'admin'): ?>
            <li <?php if($tab == "expense"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('expense'); ?>"><i class="fa fa-align-left"></i> Expenses</a></li>
            <li <?php if($tab == "employee"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('employee'); ?>"><i class="fa fa-users"></i> Employees</a></li>
            <li <?php if($tab == "job"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('job'); ?>"><i class="fa fa-briefcase"></i> Jobs</a></li>
            <li <?php if($tab == "report"){ echo 'class="active"'; } ?>><a href="<?php echo base_url('report'); ?>"><i class="fa fa-file-pdf-o"></i> Reports</a></li>
          <?php endif ?>
          <!-- <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li> -->
        </ul>
      </div>
    </div>

    <main>
      <div class="top-nav">
        <button type="button" class="toggle-menu" id="menu">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?php echo $this->session->userdata('name'); ?>
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="<?php echo base_url('user') ?>"><i class="fa fa-user"></i> User Profile</a></li>
            <li><a href="<?php echo base_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
            <!-- <li role="separator" class="divider"></li> -->
          </ul>
        </div>
        <!-- <h5><?php echo $this->session->userdata('name'); ?> <span class="caret"></span></h5> -->
      </div>
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">