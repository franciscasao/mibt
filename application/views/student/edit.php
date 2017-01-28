<div class="header">
  <h4 class="title">Edit Student</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("student/edit/S".$student['id']) ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>ID Number</label>
          <input type="text" class="form-control" placeholder="ex. S201610001" value="<?php echo 'M'.$student['id']; ?>" disabled>
          <input type="hidden" name="id" value="<?php echo 'M'.$student['id']; ?>">
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>First Name <small>(required)</small></label>
          <input type="text" class="form-control" name="fname" placeholder="ex. Juan" value="<?php echo set_value('fname', $student['first_name']); ?>" required>
          <?php echo form_error('fname'); ?>
        </div>        
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" class="form-control" name="mname" placeholder="ex. Nito" value="<?php echo set_value('mname', $student['middle_name']); ?>">
          <?php echo form_error('mname'); ?>
        </div>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Last Name <small>(required)</small></label>
          <input type="text" class="form-control" name="lname" placeholder="Dela Cruz" value="<?php echo set_value('lname', $student['last_name']); ?>" required>
          <?php echo form_error('lname'); ?>
        </div>
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Birthdate <small>(required)</small></label>
          <input type="text" class="form-control datepicker" name="birthday" placeholder="ex. yyyy-mm-dd" value="<?php echo set_value('birthday', $student['birthday']); ?>" required>
          <?php echo form_error('birthday'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Gender <small>(required)</small></label>
        <?php function tmp($g, $gender) { if($g == $gender) { return TRUE; } else { return FALSE; } } ?>
        <select class="form-control" name="gender" required>
          <option selected> test </option>
          <option value="male" <?php echo set_select('gender', 'male', tmp('Male', $student['gender'])); ?>>Male</option>
          <option value="female" <?php echo set_select('gender', 'female', tmp('Female', $student['gender'])); ?>>Female</option>
        </select>
        <?php echo form_error('gender'); ?>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Email <small>(optional)</small></label>
          <input type="email" class="form-control" name="email" placeholder="ex. fname@somewhere.com" value="<?php echo set_value('email', $student['email']); ?>">
          <?php echo form_error('email'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Course <small>(required)</small></label>
        <select class="form-control" name="course" required>
          <?php $tmp = FALSE; ?>
          <?php foreach ($course as $course_item): ?>
            <?php if($course_item['course_name'] == $student['course_name'] ) $tmp = TRUE; ?>
            <option value="<?php echo $course_item['id']; ?>" <?php echo  set_select('course', $course_item['id'], $tmp); ?> data-fee=<?php echo $course_item['tuition_fee'] ?>>
              <?php echo $course_item['course_name']; ?>
            </option>
            <?php $tmp = FALSE; ?>
          <?php endforeach ?>
        </select>
        <?php echo form_error('course'); ?>
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Type <small>(required)</small></label>
        <select class="form-control" name="type" required>
          <option value="regular" <?php echo set_select('type', 'regular', tmp('Regular', $student['type'])); ?>>Regular</option>
          <option value="scholar" <?php echo set_select('type', 'scholar', tmp('Scholar', $student['type'])); ?>>Scholar</option>
        </select>
        <?php echo form_error('type'); ?>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12">
        <div class="form-group">
          <label>Address <small>(required)</small></label>
          <input type="text" class="form-control" name="address" placeholder="ex. #32 Some St. Barangay Ginebra Doon City" value="<?php echo set_value('address', $student['address']); ?>" required>
          <?php echo form_error('address'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="header">
        <h4 class="title">In Case of Emergency Contact</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Name <small>(required)</small></label>
          <input type="text" class="form-control" name="emergency_name" value="<?php echo set_value('emergency_name', $student['emergency_contact_name']) ?>" placeholder="ex. Faith Elizabeth">
          <?php echo form_error('emergency_name'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Contact Number <small>(required)</small></label>
          <input type="number" class="form-control" name="emergency_number" value="<?php echo set_value('emergency_name', $student['emergency_contact_no']) ?>" placeholder="ex. 639123456789">
          <?php echo form_error('emergency_number'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Relation <small>(required)</small></label>
          <input type="text" class="form-control" name="emergency_relation" value="<?php echo set_value('emergency_name', $student['emergency_contact_relation']) ?>" placeholder="ex. Guardian">
          <?php echo form_error('emergency_relation'); ?>
        </div>
      </div>
    </div>
    <?php if ($this->session->userdata('authentication') == 'admin'): ?>
    <div class="row">
      <div class="header">
        <h4 class="title">Initial Payment</h4>
        <p class="subtitle">Payment of student upon enrolmnent.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Discount <small>(optional)</small></label>
          <input type="number" class="form-control" name="discount" value="<?php echo $student['discount_given']; ?>" placeholder="ex. 7,000.00">
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Initial Payment <small>(optional)</small></label>
          <input type="number" class="form-control" name="payment" value="<?php if(!empty($payment['amount'])) echo $payment['amount']; ?>" placeholder="ex. 7,000.00">
          <input type="hidden" name="payment_id" value="<?php if(!empty($payment['id'])) echo $payment['id']; ?>">
        </div>
      </div>
    </div>
    <?php endif ?>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">Update</button>
      </div>
    </div>
  </form>
</div>