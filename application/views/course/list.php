<div class="header">
  <h4 class="title">Course List</h4>
  <p class="subtitle">Here's the list of courses updated real time.</p>
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
    <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('course/new') ?>'"><i class="fa fa-plus"></i> New Course</button>
  </div>      
  <table class="table" id="list">
    <thead>
      <th data-field="id" data-sortable="true">Course Code</th>
      <th data-field="course_name" data-sortable="true">Course Name</th>
      <th data-field="tuition_fee" data-sortable="true">Tuition Fee</th>
      <th data-field="actions" data-formatter="operateFormatter" data-events="operateCourses">Actions</th>
    </thead>
    <tbody>
      <?php foreach($course as $course_item): ?>
        <tr>
          <td><?php echo $course_item["id"]; ?></td>
          <td><?php echo $course_item["course_name"]; ?></td>
          <td><?php echo 'Php '.number_format($course_item["tuition_fee"], 2); ?></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>