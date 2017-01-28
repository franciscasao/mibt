<?php
  $birthday = new DateTime($employee["birthday"]);
?>
<div class="header">
  <h4 class="title">Employee Profile</h4>
  <p class="subtitle">Listed below are the details of the employee.</p>
</div>
<div class="content">
  <div class="row">
    <div class="col-xs-12 big-actions">
      <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('employee/edit/'.$employee['id']); ?>'"><i class="fa fa-edit"></i> Edit</button>
      <button class="btn btn-default" onclick="delete_employee('<?php echo $employee['id']; ?>')"><i class="fa fa-times"></i> Delete</button>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
      <img src="<?php echo base_url('assets/img/E.jpg'); ?>" width="100%">
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 details">
      <div>
        <span>ID Number</span>
        <span><?php echo "E".$employee["id"]; ?></span>
      </div>
      <div>
        <span>Name</span>
        <span><?php echo $employee["last_name"].', '.$employee["first_name"].' '.$employee["middle_name"]; ?></span>
      </div>
      <div>
        <span>Birthday</span>
        <span><?php echo $birthday->format('F d, Y'); ?></span>
      </div>
      <div>
        <span>Gender</span>
        <span><?php echo $employee["gender"]; ?></span>
      </div>
      <div>
        <span>Address</span>
        <span><?php echo $employee["address"]; ?></span>
      </div>
      <div>
        <span>Position</span>
        <span><?php echo $employee["title"]; ?></span>
      </div>
      <div>
        <span>Email</span>
        <span><?php echo $employee["email"]; ?></span>
      </div>
      <div>
        <span>Salary</span>
        <span>Php <?php echo number_format($employee["salary"], 2); ?></span>
      </div>
      <div>
        <span>Contact Number</span>
        <span>0<?php echo $employee["contact_no"] - 630000000000; ?></span>
      </div>
    </div>
  </div>
</div>
