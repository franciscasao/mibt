<div class="header">
  <h4 class="title">Student Enrollment</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("student/new") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>ID Number</label>
          <input type="text" class="form-control" placeholder="ex. S201610001" value="<?php echo "M".$max_id; ?>" disabled>
          <input type="hidden" name="id" value="<?php echo "M".$max_id; ?>">
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>First Name <small>(required)</small></label>
          <input type="text" class="form-control" name="fname" placeholder="ex. Juan" value="<?php echo set_value('fname'); ?>" required>
          <?php echo form_error('fname'); ?>
        </div>        
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" class="form-control" name="mname" placeholder="ex. Nito" value="<?php echo set_value('mname'); ?>">
          <?php echo form_error('mname'); ?>
        </div>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Last Name <small>(required)</small></label>
          <input type="text" class="form-control" name="lname" placeholder="Dela Cruz" value="<?php echo set_value('lname'); ?>" required>
          <?php echo form_error('lname'); ?>
        </div>
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Birthdate <small>(required)</small></label>
          <input type="text" class="form-control datepicker" name="birthday" placeholder="ex. yyyy-mm-dd" value="<?php echo set_value('birthday'); ?>" required>
          <?php echo form_error('birthday'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Gender <small>(required)</small></label>
        <select class="form-control" name="gender" required>
          <option value="male" <?php echo set_select('gender', 'male'); ?>>Male</option>
          <option value="female" <?php echo set_select('gender', 'female'); ?>>Female</option>
        </select>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Email <small>(optional)</small></label>
          <input type="email" class="form-control" name="email" placeholder="ex. fname@somewhere.com" value="<?php echo set_value('email'); ?>">
          <?php echo form_error('email'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Course <small>(required)</small></label>
        <select class="form-control" name="course" required>
          <?php foreach ($course as $course_item): ?>
            <option value="<?php echo $course_item['id']; ?>" <?php echo  set_select('course', $course_item['id']); ?> data-fee=<?php echo $course_item['tuition_fee'] ?>>
              <?php echo $course_item['course_name']; ?>
            </option>
          <?php endforeach ?>
        </select>
        <?php echo form_error('course'); ?>
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Type <small>(required)</small></label>
        <select class="form-control" name="type" required>
          <option value="regular" <?php echo set_select('type', 'regular'); ?>>Regular</option>
          <option value="scholar" <?php echo set_select('type', 'scholar'); ?>>Scholar</option>
        </select>
        <?php echo form_error('type'); ?>
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12">
        <div class="form-group">
          <label>Address <small>(required)</small></label>
          <input type="text" class="form-control" name="address" placeholder="ex. #32 Some St. Barangay Ginebra Doon City" value="<?php echo set_value('address'); ?>" required>
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
          <input type="text" class="form-control" name="emergency_name" placeholder="ex. Faith Elizabeth">
          <?php echo form_error('emergency_name'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Contact Number <small>(required)</small></label>
          <input type="number" class="form-control" name="emergency_number" placeholder="ex. 639123456789">
          <?php echo form_error('emergency_number'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Relation <small>(required)</small></label>
          <input type="text" class="form-control" name="emergency_relation" placeholder="ex. Guardian">
          <?php echo form_error('emergency_relation'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="header">
        <h4 class="title">Initial Payment</h4>
        <p class="subtitle">Payment of student upon enrolmnent.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Balance</label>
          <input type="number" class="form-control" name="balance" value="<?php echo $course[0]['tuition_fee'] ?>" disabled>
          <?php echo form_error('balance'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Discount <small>(optional)</small></label>
          <input type="number" class="form-control" name="discount" value="<?php echo set_value('discount'); ?>" placeholder="ex. 7,000.00">
          <?php echo form_error('discount'); ?>
        </div>
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Initial Payment <small>(optional)</small></label>
          <input type="number" class="form-control" name="payment" value="<?php echo set_value('payment'); ?>" placeholder="ex. 7,000.00">
          <?php echo form_error('payment'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">Enroll Student</button>
      </div>
    </div>
  </form>
</div>