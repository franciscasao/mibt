<div class="header">
  <h4 class="title">Employees List</h4>
  <p class="subtitle">Here's the list of employees updated real time.</p>
</div>
<?php if (!empty($this->session->userdata('message'))): ?>
  <div class="alert alert-info fade in message">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success! </strong><?php echo $this->session->userdata('message'); ?>
  </div>
  <?php $this->session->unset_userdata('message'); ?>
<?php endif ?>
<div class="fresh-table">
  <div class="fixed-table-toolbar">
    <div class="bars pull-left">
      <div class="toolbar">
        <button class="btn btn-default" onclick="window.location.href='<?php echo base_url('employee/new'); ?>'"><i class="fa fa-plus"></i> New Employee</button>
      </div>
    </div>
    <div class="pull-right search">
      <input class="form-control" type="text" placeholder="Search">
    </div>
  </div>
</div>
 
<div class="row cards">
<?php $count = 0; ?>
<?php foreach ($employee as $employee_item): ?>
  <?php $count++; ?>
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 card">
    <div class="img-header" style="background-image: url('<?php echo base_url('assets/img/emp-'.strtolower($employee_item['gender']).'.png'); ?>')">
    </div>
    <div class="card-body">
      <h2 class="title"><?php echo $employee_item['first_name'].' '.$employee_item['last_name']; ?></h2>
      <h6 class="subtitle"><?php echo $employee_item['email'] ?></h6>
      <hr>
      <div class="position">
        <div class="title"><?php echo $employee_item['title'] ?></div>
      </div>
      <div class="actions" data-id="E<?php echo $employee_item['id'] ?>">
        <a class="card-action view" href="<?php echo base_url('employee/E'.$employee_item['id']); ?>" data-toggle="tooltip" data-placement="top" title="View">
          <i class="fa fa-eye"></i>
          <span>View</span>
        </a>
        <a class="card-action edit" href="<?php echo base_url('employee/edit/E'.$employee_item['id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit">
          <i class="fa fa-edit"></i>
          <span>Edit</span>
        </a>
        <a href="javascript:delete_employee('<?php echo 'E'.$employee_item['id'] ?>')" class="card-action remove" data-toggle="tooltip" data-placement="top" title="Remove">
          <i class="fa fa-remove"></i>
          <span>Delete</span>
        </a>
      </div>
    </div>
  </div>
  <?php if ($count % 4 == 0): ?> 
    <div class="clearfix visible-lg"></div>
  <?php endif ?>
  <?php if ($count % 3 == 0): ?> 
    <div class="clearfix visible-md"></div>
  <?php endif ?>
  <?php if($count % 2 == 0): ?>
    <div class="clearfix visible-sm"></div>
  <?php endif ?>
<?php endforeach ?>