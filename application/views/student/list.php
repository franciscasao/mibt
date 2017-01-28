<div class="header">
  <h4 class="title">Students List</h4>
  <p class="subtitle">Here's the list of students updated real time.</p>
</div>
<?php if (!empty($this->session->userdata('message'))): ?>
  <div class="alert alert-info fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong><?php echo $this->session->userdata('message'); ?></strong>
  </div>
  <?php $this->session->unset_userdata('message'); ?>
<?php endif ?>
<?php if (!empty($this->session->userdata('error'))): ?>
  <div class="alert alert-danger fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong><?php echo $this->session->userdata('error'); ?></strong>
  </div>
  <?php $this->session->unset_userdata('error'); ?>
<?php endif ?>
<div class="fresh-table">
  <div class="toolbar">
    <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('student/new'); ?>'"><i class="fa fa-plus"></i> New Student</button>
  </div>     
  <table class="table" id="list">
    <thead>
      <th data-field="id" data-sortable="true">ID Number</th>
      <th data-field="fname" data-sortable="true">First Name</th>
      <th data-field="lname" data-sortable="true">Last Name</th>
      <th data-field="type" data-sortable="true">Type</th>
      <th data-field="course_name" data-sortable="true">Course</th>
      <th data-field="actions" data-formatter="operateStudentEmployeeFormatter" data-events="operateStudents">Actions</th>
    </thead>
    <tbody>
      <?php foreach($student as $student_item): ?>
        <tr>
          <td><?php echo 'M'.$student_item["id"]; ?></td>
          <td><?php echo $student_item["first_name"]; ?></td>
          <td><?php echo $student_item["last_name"]; ?></td>
          <td><?php echo $student_item["type"]; ?></td>
          <td><?php echo $student_item["course_name"]; ?></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>