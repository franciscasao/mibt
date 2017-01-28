<div class="header">
  <h4 class="title">New Payment</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("payment/new") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Date Recorded <small>(required)</small></label>
          <input type="text" class="form-control datepicker" name="date_recorded" placeholder="ex. mm/dd/yyyy" value="<?php echo set_value('date_recorded', date('Y-m-d')); ?>" required>
          <?php echo form_error('date_recorded'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Amount <small>(required)</small></label>
          <input type="number" class="form-control" name="payment" placeholder="ex. 7000" value="<?php echo set_value('payment'); ?>" required>
          <?php echo form_error('payment'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Student ID <small>(required)</small></label>
          <input type="text" class="form-control" name="id" placeholder="ex. S201610001" value="<?php if(!empty($student_id)) echo $student_id; else echo set_value('id'); ?>" required>
          <?php echo form_error('id'); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">New Payment</button>
      </div>
    </div>
  </form>
</div>