<div class="header">
  <h4 class="title">User Profile</h4>
  <p class="subtitle">View or update your profile.</p>
</div>
<?php if (!empty($this->session->userdata('message'))): ?>
  <div class="alert alert-info fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success! </strong><?php echo $this->session->userdata('message'); ?>
  </div>
  <?php $this->session->unset_userdata('message'); ?>
<?php endif ?>
<?php if (!empty($this->session->userdata('error'))): ?>
  <div class="alert alert-danger fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error! </strong><?php echo $this->session->userdata('error'); ?>
  </div>
  <?php $this->session->unset_userdata('error'); ?>
<?php endif ?>
<div class="content">
  <?php echo form_open("user") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>First Name <small>(required)</small></label>
          <input type="text" class="form-control" name="fname" placeholder="ex. Juan" value="<?php echo set_value('fname', $user['first_name']); ?>" required>
          <?php echo form_error('fname'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" class="form-control" name="mname" placeholder="ex. Nito" value="<?php echo set_value('mname', $user['middle_name']); ?>">
          <?php echo form_error('mname'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Last Name <small>(required)</small></label>
          <input type="text" class="form-control" name="lname" placeholder="Dela Cruz" value="<?php echo set_value('lname', $user['last_name']); ?>" required>
          <?php echo form_error('lname'); ?>
        </div>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Birthdate <small>(required)</small></label>
          <input type="text" class="form-control datepicker" name="birthday" placeholder="ex. yyyy-mm-dd" value="<?php echo set_value('birthday', $user['birthday']); ?>" required>
          <?php echo form_error('birthday'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Email <small>(required)</small></label>
          <input type="email" class="form-control" name="email" placeholder="Dela Cruz" value="<?php echo set_value('email', $user['email']); ?>" required>
          <?php echo form_error('email'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Contact No. <small>(required)</small></label>
          <input type="text" class="form-control" name="contact_no" placeholder="ex. +639288973570" value="<?php echo set_value('contact_no', '+'.$user['contact_no']); ?>" required>
          <?php echo form_error('contact_no'); ?>
        </div>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12">
        <div class="form-group">
          <label>Complete Address <small>(required)</small></label>
          <input type="text" class="form-control" name="address" placeholder="Dela Cruz" value="<?php echo set_value('address', $user['address']); ?>" required>
          <?php echo form_error('address'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <input type="submit" class="btn btn-primary" name="update_info" value="Update User">
      </div>
    </div>
  <?php echo form_close(); ?>
</div>
<div class="header">
  <h4 class="title">Change Password</h4>
  <p class="subtitle">Complete the form below to change your password.</p>
</div>
<div class="content">
  <?php echo form_open("user") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Current Password <small>(required)</small></label>
          <input type="password" class="form-control" name="password" placeholder="Current Password" required>
          <?php echo form_error('password'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>New Password <small>(required)</small></label>
          <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
          <?php echo form_error('new_password'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Confirm New Password <small>(required)</small></label>
          <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
          <?php echo form_error('confirm_password'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <input type="submit" class="btn btn-primary" name="change_pass" value="Change Password">
      </div>
    </div>
  <?php echo form_close() ?>
</div>