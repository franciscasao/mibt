<div class="header">
  <h4 class="title">Edit Expense</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("expense/edit/".$expense['id']) ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Date Recorded</label>
          <input type="hidden" class="form-control" name="id" value="<?php echo $expense['id']; ?>">
          <input type="text" class="form-control datepicker" data-date-orientation="bottom auto" name="date_recorded" value="<?php echo set_value('date_recorded', date('Y-m-d')); ?>">
          <?php echo form_error('date_recorded'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Amount <small>(required)</small></label>
          <input type="number" class="form-control" name="amount" placeholder="ex. 7000" value="<?php echo set_value('amount', $expense['amount']); ?>" required>
          <?php echo form_error('amount'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Reciept No. <small>(required)</small></label>
          <input type="text" class="form-control" name="receipt_no" placeholder="ex. R1234567" value="<?php echo set_value('receipt_no', $expense['receipt_no']); ?>" required>
          <?php echo form_error('receipt_no'); ?>
        </div>        
      </div>
      <div class="clearfix visible-md"></div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Details <small>(required)</small></label>
          <input type="text" class="form-control" name="details" placeholder="ex. Electric Bill" value="<?php echo ucwords(set_value('details', $expense['details'])); ?>" required>
          <?php echo form_error('details'); ?>
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