<div class="header">
  <h4 class="title"><?php echo $course['id'].' | '.$course['course_name']; ?></h4>
  <p class="subtitle">Here's the list of students enrolled in this course.</p>
  <p class="subtitle">Total Students: <?php echo $count; ?></p>
</div>
<div class="fresh-table">
  <div class="toolbar">
    <!-- <button id="newBtn" class="btn btn-default"><i class="fa fa-plus"></i> New Course</button> -->
  </div>      
  <table class="table" id="list">
    <thead>
      <th data-field="id" data-sortable="true">ID Number</th>
      <th data-field="course_name" data-sortable="true">Name</th>
      <th data-field="actions" data-formatter="operateFormatter" data-events="operateStudents">Actions</th>
    </thead>
    <tbody>
      <?php foreach($student as $student_item): ?>
        <tr>
          <td><?php echo 'M'.$student_item["id"]; ?></td>
          <td><?php echo $student_item["first_name"].' '.$student_item["last_name"]; ?></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>