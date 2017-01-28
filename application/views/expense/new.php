<div class="header">
  <h4 class="title">New Expense</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("expense/new") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Date Recorded</label>
          <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Amount <small>(required)</small></label>
          <input type="number" class="form-control" name="amount" placeholder="ex. 7000" value="<?php echo set_value('amount'); ?>" required>
          <?php echo form_error('amount'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Reciept No. <small>(required)</small></label>
          <input type="text" class="form-control" name="receipt_no" placeholder="ex. R1234567" value="<?php echo set_value('receipt_no'); ?>" required>
          <?php echo form_error('receipt_no'); ?>
        </div>        
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Details <small>(required)</small></label>
          <input type="text" class="form-control" name="details" placeholder="ex. Electric Bill" value="<?php echo set_value('details'); ?>" required>
          <?php echo form_error('details'); ?>
        </div>        
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">Add Expense</button>
      </div>
    </div>
  </form>
</div>