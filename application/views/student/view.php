<?php
  $birthday = new DateTime($student["birthday"]);
  $date_recorded = new DateTime('2016-01-11');
?>
<div class="header">
  <h4 class="title">Student Profile</h4>
  <p class="subtitle">Listed below are the details of the student.</p>
</div>
<div class="content">
  <div class="row">
    <div class="col-xs-12 big-actions">
      <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('student/edit/').'M'.$student_id; ?>'"><i class="fa fa-edit"></i> Edit</button>
      <?php if($this->session->userdata('authentication') == 'admin'): ?>
        <button id="delete_student" class="btn btn-default" data-id="M<?php echo $student_id; ?>"><i class="fa fa-times"></i> Delete</button>
      <?php endif ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
      <img src="<?php echo base_url('assets/img/S.jpg'); ?>" width="100%">
    </div>
    <div class="col-xs-12 col-sm-8 col-md-9 details">
      <div>
        <span>ID Number</span>
        <span><?php echo "M".$student["id"]; ?></span>
      </div>
      <div>
        <span>Name</span>
        <span><?php echo $student["last_name"].', '.$student["first_name"].' '.$student["middle_name"]; ?></span>
      </div>
      <div>
        <span>Type</span>
        <span><?php echo $student["type"]; ?></span>
      </div>
      <div>
        <span>Birthday</span>
        <span><?php echo $birthday->format('F d, Y'); ?></span>
      </div>
      <div>
        <span>Gender</span>
        <span><?php echo $student["gender"]; ?></span>
      </div>
      <div>
        <span>Email</span>
        <span><?php echo $student["email"]; ?></span>
      </div>
      <div>
        <span>Address</span>
        <span><?php echo $student["address"]; ?></span>
      </div>
      <div>
        <span>Discount</span>
        <span><?php echo '≈'.round($student["discount_given"]/7000*100).'% | Php '.($student["discount_given"]); ?></span>
      </div>
      <div>
        <span>Balance</span>
        <span>Php <?php echo number_format($balance, 2) ?></span>
      </div>
    </div>
  </div>
</div>
<div class="header">
  <h4 class="title">Emergency Contact</h4>
</div>
<div class="content">
  <div class="row">
    <div class="col-xs-12">+<?php echo $student["emergency_contact_no"]; ?></div>
    <div class="col-xs-12" style="font-weight: bold;"><?php echo $student["emergency_contact_name"]; ?></div>
    <div class="col-xs-12"><?php echo $student["emergency_contact_relation"]; ?></div>
  </div>
</div>
<div class="header">
  <h4 class="title">Payments Made</h4>
</div>
<div class="fresh-table">
  <div class="toolbar">
    <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('payment/new/').'M'.$student_id; ?>'"><i class="fa fa-plus"></i> New Payment</button>
  </div>      
  <table class="table" id="payment">
    <thead>
      <th data-field="date_recorded" data-sortable="true">Date Recorded</th>
      <th data-field="amount" data-sortable="true">Amount</th>
      <th data-field="employee_id" data-sortable="true">Employee ID</th>
      <th data-field="actions" data-formatter="operateFormatterv2" data-events="operatePayments">Actions</th>
    </thead>
    <tbody>
      <?php foreach($payment as $payment_item): ?>
        <tr data-id="<?php echo $payment_item["id"]; ?>">
          <?php 
            $date_recorded = new DateTime($payment_item['date_recorded']);
          ?>
          <td><?php echo $date_recorded->format('M d, Y'); ?></td>
          <td>Php <?php echo number_format($payment_item["amount"], 2); ?></td>
          <td><a href="<?php echo base_url("employee/E".$payment_item["employee_id"]); ?>"><?php echo "E".$payment_item["employee_id"]; ?></a></td>
          <td></td>
        </tr>
      <?php endforeach; ?> 
    </tbody>
  </table>
</div>