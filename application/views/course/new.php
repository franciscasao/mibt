<div class="header">
  <h4 class="title">New Course</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<?php if (!empty($this->session->userdata('error'))): ?>
  <div class="alert alert-danger fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error!</strong> <?php echo $this->session->userdata('error'); ?>
  </div>
  <!-- <?php $this->session->unset_userdata('error'); ?> -->
<?php endif ?>
<div class="content">
  <?php echo form_open("course/new") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Course Code <small>(required)</small></label>
          <input type="text" class="form-control" name="course_code" placeholder="ex. ICST210" value="<?php echo set_value('course_code'); ?>" required>
          <?php echo form_error('course_code'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Course Name <small>(required)</small></label>
          <input type="text" class="form-control" name="course_name" value="<?php echo set_value('course_name'); ?>" placeholder="ex. Recruitment Management" required>
          <?php echo form_error('course_name'); ?>
        </div>        
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Tuition Fee <small>(required)</small></label>
          <input type="number" class="form-control" name="tuition_fee" value="<?php echo set_value('tuition_fee'); ?>" placeholder="ex. 7000" required>
          <?php echo form_error('tuition_fee'); ?>
        </div>        
      </div>
      <div class="clearfix visible-md"></div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button type="submit" class="btn btn-primary">Add Course</button>
      </div>
    </div>
  </form>
</div>