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
    <div class="flex-container">
      <div class="box logo-container text-center">
        <img src="assets/img/final_logo.png">
      </div>
      <div class="box login-form">
        <h3 class="text-center" style="transition: 0.3s all ease;">Log in to your account.</h3>

        <?php if(!empty($error)): ?>
        <div class="alert alert-danger fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong><?php echo $error; ?></strong>
        </div>
        <?php endif; ?>

        <?php echo form_open('/', array('style' => 'transition: 0.3s all ease;')); ?>
          <div class="form-group">
            <label>Employee ID</label>
            <input type="text" name="emp_id" placeholder="ex. E201610001" class="form-control" value="<?php echo set_value('emp_id'); ?>" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
          </div>
          <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Keep me logged in</label>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Log In</button>
            <p>Forgot password? Click <a role="button" data-toggle="modal" data-target=".modal">here.</a></p>
          </div>
        </form>

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
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="ex. jdelacruz@somewhere.com">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Recover Password</button>
          </div>
          </form>
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