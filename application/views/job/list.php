<div class="header">
  <h4 class="title">Job List</h4>
  <p class="subtitle">Here's the list of jobs available.</p>
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
    <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('job/new'); ?>'"><i class="fa fa-plus"></i> New Job Position</button>
  </div>     
  <table class="table" id="list">
    <thead>
      <th data-field="job_name" data-sortable="true">Job Title</th>
      <th data-field="rank" data-sortable="true">Rank</th>
      <th data-field="salary" data-sortable="true">Salary</th>
      <th data-field="count" data-sortable="true">Employees</th>
      <th data-field="actions" data-formatter="operateFormatter" data-events="operateJobs">Actions</th>
    </thead>
    <tbody>
      <?php foreach($job as $job_item): ?>
        <tr data-id="<?php echo $job_item["id"]; ?>">
          <td><?php echo $job_item["title"]; ?></td>
          <td><?php echo $job_item["rank"]; ?></td>
          <td>Php <?php echo number_format($job_item["salary"], 2); ?></td>
          <td><?php echo $job_item["count"]; ?></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>