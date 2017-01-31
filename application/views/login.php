<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>MCHL Institute of Business and Technology</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">    
    <!-- Creative Time Fresh Bootstrap Table Template -->
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/login.css" rel="stylesheet">
  </head>

  <body>
    <div class="content">
      <div class="login-header text-center">
        <img src="assets/img/logo/200px.png">
        <h1>MCHL Institute of Business and Technology</h1>
        <?php if(!empty($error)): ?>
          <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> <?php echo $error; ?>
          </div>
        <?php endif; ?>
        <div>Sign in to get started.</div>
        <?php echo form_open('/', array('style' => 'transition: 0.3s all ease;')); ?>
          <input type="text" name="emp_id" placeholder="Employee ID" class="form-control" value="<?php echo set_value('emp_id'); ?>" required>
          <input type="password" name="password" placeholder="Password" class="form-control" required>
          <button type="submit" class="btn btn-primary btn-borderless">Sign In</button>
        <?php echo form_close(); ?>
        <a role="button" data-toggle="modal" data-target=".modal">Forgot Password?</a>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Forgot Password</h4>
            <p class="subtitle">Enter your email to recover your password.</p>
          </div>
          <?php echo form_open('forgot_password'); ?>
          <div class="modal-body">
            <!-- <div class="form-group"> -->
              <input type="email" name="email" class="form-control" placeholder="Email">
            <!-- </div> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Recover Password</button>
          </div>
          <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>