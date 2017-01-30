<div class="header">
  <h4 class="title">Payment Reports</h4>
  <p class="subtitle">Generate daily, weekly, monthly, and annual payment reports.</p>
</div>
<div class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="big-btn" data-toggle="modal" data-target="#choose_date">
        <div>Daily</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="big-btn" onclick="window.location.href='<?php echo base_url('report/payment'); ?>'">
        <div>Weekly</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="big-btn" onclick="window.location.href='<?php echo base_url('report/expense'); ?>'">
        <div>Monthly</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="big-btn" onclick="window.location.href='<?php echo base_url('report/student'); ?>'">
        <div>Annual</div>
      </div>
    </div>
  </div>
</div>