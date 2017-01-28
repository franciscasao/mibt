<div class="header">
  <h4 class="title">Edit Payment</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("payment/edit_student") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Date Recorded <small>(required)</small></label>
          <input type="text" class="form-control datepicker" name="date_recorded" placeholder="ex. mm/dd/yyyy" value="<?php echo $payment['date_recorded']; ?>" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Amount <small>(required)</small></label>
          <input type="number" class="form-control" name="amount" placeholder="ex. 7000" value="<?php echo $payment['amount']; ?>" required>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Student ID <small>(required)</small></label>
          <input type="text" class="form-control" name="student_id" placeholder="ex. S201610001" value="<?php echo "S".$payment['student_id']; ?>" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Employee ID <small>(required)</small></label>
          <input type="text" class="form-control" name="employee_id" placeholder="ex. S201610001" value="<?php echo "E".$payment['employee_id']; ?>" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">Update</button>
      </div>
    </div>
  </form>
</div>