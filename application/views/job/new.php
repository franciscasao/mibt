<div class="header">
  <h4 class="title">New Job Position</h4>
  <p class="subtitle">Please complete the form below.</p>
</div>
<div class="content">
  <?php echo form_open("job/new") ?>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Job Title <small>(required)</small></label>
          <input type="text" class="form-control" name="title" placeholder="ex. Design Engineer" value="<?php echo set_value('title'); ?>" required>
          <?php echo form_error('title'); ?>
        </div>        
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 form-group">
        <label>Heirarchy <small>(required)</small></label>
        <select class="form-control" name="rank" required>
          <?php foreach ($rank as $rank_item): ?>
            <option value="<?php echo $rank_item['rank']; ?>" <?php echo set_select('rank', $rank_item['rank']); ?>>
              <?php echo $rank_item['rank']; ?>
            </option>
          <?php endforeach ?>
          <?php $tmp = end($rank); ?>
          <option value="<?php echo $tmp['rank'] + 1; ?>" <?php echo set_select('rank', $tmp['rank'] + 1); ?>>
            <?php echo $tmp['rank'] + 1; ?>
          </option>
        </select>
        <?php echo form_error('rank'); ?>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label>Salary <small>(required)</small></label>
          <input type="number" class="form-control" name="salary" placeholder="ex. 7000" value="<?php echo set_value('salary'); ?>" required>
          <?php echo form_error('salary'); ?>
        </div>        
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <button class="btn btn-primary">Add Job</button>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>