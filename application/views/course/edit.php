<div class="header">
  <h4 class="title">Edit Course</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("course/edit/".$course['id']) ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Course Code <small>(required)</small></label>
          <input type="text" class="form-control" placeholder="ex. ICST210" value="<?php echo $course['id']; ?>" disabled>
          <input type="hidden" name="course_code" value="<?php echo $course['id']; ?>">
          <?php echo form_error('course_code'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Course Name <small>(required)</small></label>
          <input type="text" class="form-control" placeholder="ex. Recruitment Management" name="course_name" value="<?php echo set_value('course_name', $course['course_name']); ?>" required>
          <?php echo form_error('course_name'); ?>
        </div>        
      </div>
      <div class="clearfix visible-sm"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Tuition Fee <small>(required)</small></label>
          <input type="number" class="form-control" placeholder="ex. 7000" name="tuition_fee" value="<?php echo set_value('tuition_fee', $course['tuition_fee']); ?>" required>
          <?php echo form_error('tuition_fee'); ?>
        </div>        
      </div>
      <div class="clearfix visible-md"></div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </form>
</div>