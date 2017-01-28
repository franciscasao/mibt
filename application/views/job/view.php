<div class="header">
  <h4 class="title">Job Details</h4>
  <p class="subtitle">Specific details regarding the job.</p>
</div>
<div class="content">
  <div class="row">
    <div class="col-xs-12 big-actions">
      <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('job/edit/'.$job['id']); ?>'"><i class="fa fa-edit"></i> Edit</button>
      <button id="delete_job" data-id="<?php echo $job['id']; ?>" class="btn btn-default"><i class="fa fa-times"></i> Delete</button>
    </div>
    <div class="col-xs-12 details">
      <div>
        <span>Job Title</span>
        <span><?php echo $job["title"]; ?></span>
      </div>
      <div>
        <span>Salary</span>
        <span><?php echo $job["salary"]; ?></span>
      </div>
      <div>
        <span>Rank</span>
        <span><?php echo $job["rank"]; ?></span>
      </div>
    </div>
  </div>
</div>
<div class="header">
  <h4 class="title">Employee List</h4>
  <p class="subtitle">Employees employed on this job.</p>
</div>
<div class="fresh-table">
  <table class="table" id="employee">
    <thead>
      <th data-field="id" data-sortable="true">Employee ID</th>
      <th data-field="name" data-sortable="true">Name</th>
      <th data-field="date_employed" data-sortable="true">Date Employed</th>
      <th data-field="actions" data-formatter="operateFormatterv2" data-events="operateEmployees">Actions</th>
    </thead>
    <tbody>
      <?php foreach($employee as $employee_item): ?>
        <tr>
          <td>E<?php echo $employee_item["id"]; ?></td>
          <td><?php echo $employee_item["first_name"].' '.$employee_item["last_name"]; ?></td>
          <td><?php echo $employee_item["date_employed"]; ?></td>
          <td></td>
        </tr>
      <?php endforeach; ?> 
    </tbody>
  </table>
</div>