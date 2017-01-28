<div class="header">
  <h4 class="title">Update Employee</h4>
  <p class="subtitle">Please complete the form below.</p>
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
  <?php echo form_open("employee/edit/E".$employee['id']."") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>ID Number</label>
          <input type="text" class="form-control" placeholder="ex. E201610001" value="<?php echo "E".$employee['id']; ?>" disabled>
          <input type="hidden" name="id" value="<?php echo "E".$employee['id']; ?>">
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>First Name <small>(required)</small></label>
          <input type="text" class="form-control" name="fname" placeholder="ex. Juan" value="<?php echo set_value('fname', $employee['first_name']); ?>" required>
          <?php echo form_error('fname'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" class="form-control" name="mname" placeholder="ex. Nito" value="<?php echo set_value('mname', $employee['middle_name']); ?>">
          <?php echo form_error('mname'); ?>
        </div>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Last Name <small>(required)</small></label>
          <input type="text" class="form-control" name="lname" placeholder="Dela Cruz" value="<?php echo set_value('lname', $employee['last_name']); ?>" required>
          <?php echo form_error('lname'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Birthdate <small>(required)</small></label>
          <input type="text" class="form-control datepicker" name="birthday" placeholder="ex. yyyy-mm-dd" value="<?php echo set_value('birthday', $employee['birthday']); ?>" required>
          <?php echo form_error('birthday'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Contact Number <small>(optional)</small></label>
          <input type="number" class="form-control" name="contact_no" placeholder="ex. 639288973570" value="<?php echo set_value('contact_no', $employee['contact_no']); ?>" required>
          <?php echo form_error('contact_no'); ?>
        </div>        
      </div> 
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Email <small>(required)</small></label>
          <input type="email" class="form-control" name="email" placeholder="ex. fname@somewhere.com" value="<?php echo set_value('email', $employee['email']); ?>" required>
          <?php echo form_error('email'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Gender <small>(required)</small></label>
        <?php function tmp($g, $gender) { if($g == $gender) return TRUE; else return FALSE; } ?>
        <select class="form-control" name="gender" required>
          <option value="male" <?php echo set_select('gender', 'male', tmp('Male', $employee['gender'])); ?>>Male</option>
          <option value="female" <?php echo set_select('gender', 'female', tmp('Female', $employee['gender'])); ?>>Female</option>
        </select>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Position <small>(required)</small></label>
        <select class="form-control" name="position" required>
          <?php foreach ($job as $job_item): ?>
            <option value="<?php echo $job_item['id']; ?>" <?php echo set_select('position', $job_item['id'], tmp($job_item['id'], $employee['job_id'])); ?> data-salary="<?php echo $job_item['salary']; ?>">
              <?php echo $job_item['title']; ?>
            </option>
          <?php endforeach ?>
        </select>
        <?php echo form_error('position'); ?>
      </div>      
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Salary <small>(required)</small></label>
          <input type="number" class="form-control" name="salary" placeholder="10000" value="<?php echo set_value('salary', $employee['salary']); ?>" required>
          <?php echo form_error('salary'); ?>
        </div>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12">
        <div class="form-group">
          <label>Complete Address <small>(required)</small></label>
          <input type="text" class="form-control" name="address" placeholder="ex. 843 Clove Terrace" value="<?php echo set_value('address', $employee['address']); ?>" required>
          <?php echo form_error('address'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">Update</button>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>