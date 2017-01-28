<div class="header">
  <h4 class="title">Payments List</h4>
  <p class="subtitle">Here's the list of payments made per month.</p>
</div>
<?php if (!empty($this->session->userdata('message'))): ?>
  <div class="alert alert-info fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong><?php echo $this->session->userdata('message'); ?></strong>
  </div>
  <?php $this->session->unset_userdata('message'); ?>
<?php endif ?>
<div class="fresh-table">
  <div class="toolbar">
    <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('payment/new') ?>'"><i class="fa fa-plus"></i> New Payment</button>
    <?php if (!empty($month)): ?>
    <div class="columns pull-left">
      <div class="keep-open btn-group">
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(!empty($month)) echo $month[$month_selected - 1]['month_name']; ?> <b class="caret"></b></button>
        <ul cladss="dropdown-menu" aria-labelledby="">
          <?php foreach ($month as $month_item): ?>
            <li <?php if($month_selected == $month_item['month']) echo 'class="active"' ?>>
              <a href="<?php echo base_url('payment/'.$month_item['month'].'/'.$year_selected); ?>">
                <?php echo $month_item['month_name']; ?>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="keep-open btn-group">
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $year_selected; ?> <b class="caret"></b></button>
        <ul class="dropdown-menu" aria-labelledby="">
          <?php foreach ($year as $year_item): ?>
            <li <?php if($year_selected == $year_item['year']) echo 'class="active"' ?>>
              <a href="<?php echo base_url('payment/'.$year_item['max_month'].'/'.$year_item['year']); ?>">
                <?php echo $year_item['year']; ?>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
    <?php endif ?>
  </div>   
  <table class="table" id="list">
    <thead>
      <th data-field="date_recorded" data-sortable="true">Date Recorded</th>
      <th data-field="student_id" data-sortable="true">Student ID</th>
      <th data-field="student_name" data-sortable="true">Student Name</th>
      <th data-field="amount" data-sortable="true">Amount</th>
      <th data-field="employee_id" data-sortable="true">Employee ID</th>
      <th data-field="actions" data-formatter="operateFormatterv2" data-events="operatePayments">Actions</th>
    </thead>
    <tbody>
      <?php foreach($payment as $payment_item): ?>
        <tr data-id="<?php echo $payment_item["id"]; ?>">
          <td><?php echo $payment_item["date_recorded"]; ?></td>
          <td><a href="<?php echo base_url('student/S'.$payment_item["student_id"]); ?>"><?php echo 'M'.$payment_item["student_id"]; ?></a></td>
          <td><?php echo $payment_item['first_name'].' '.$payment_item['last_name']; ?></td>
          <td><?php echo "Php ".$payment_item["amount"]; ?></td>
          <td><a href="<?php echo base_url('employee/E'.$payment_item["employee_id"]); ?>"><?php echo 'E'.$payment_item["employee_id"]; ?></a></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>