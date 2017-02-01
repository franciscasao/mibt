              </div> <!-- End of .card -->
            </div> <!-- End of .col-xs-12 -->
          </div> <!-- End of .row -->
        </div> <!-- End of .container-fluid -->
      </div> <!-- End of .content -->
    </main>

    <!-- Delete Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delete_modal" aria-labelledby="deleteLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Are you sure you want to delete this student?</h4>
            <p class="subtitle">Note: All payment records made by this student will also be deleted.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" form="delete_form">Delete</button>
          </div>
        </div><!-- /.modal-content -->
        <?php echo form_open($tab.'/delete', 'class="hidden" id="delete_form"') ?>
          <input type="hidden" name="id">
        <?php echo form_close(); ?>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="choose_date">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Choose Date</h4>
            <p class="subtitle">Enter the date of the report you want to generate.</p>
          </div>
          <?php echo form_open('report/payment/daily'); ?>
          <div class="modal-body">
            <div class="form-group">
              <input type="text" name="report_date" class="form-control datepicker" placeholder="Date">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Download Report</button>
          </div>
          <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-table.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
    <script type="text/javascript">
      menu.addEventListener('click', function(e) {
        drawer.classList.toggle('open');
        e.stopPropagation();
      });

      $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        // orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
      });

      if($(window).width() < 768) {
        $('.sidebar').toggleClass('open');
      }

      var $delete_form = $("#delete_form");
      var $delete_modal = $("#delete_modal");
      var $modal_title = $("#delete_modal").find('.modal-title');
      var $subtitle = $("#delete_modal").find('.subtitle');

      var $table = $('#list'),
          $newBtn = $('#newBtn'),
          full_screen = false;
        
      var $payment = $('#payment'),
          $delete_student = $('#delete_student');

      var $new_job = $('#new_job'),
          $edit_job = $('#edit_job');

      var $employee = $('#employee');

      $(window).ready(function(){
        $employee.bootstrapTable({
          search: true,
          showToggle: true,
          pagination: true,
          striped: true,
          pageSize: 8,
          pageList: [8,10,25,50,100],

          formatShowingRows: function(pageFrom, pageTo, totalRows){
            //do nothing here, we don't want to show the text "showing x of y from..." 
          },
          formatRecordsPerPage: function(pageNumber){
            return pageNumber + " rows visible";
          },
          icons: {
            toggle: 'fa fa-th-list',
            detailOpen: 'fa fa-plus-circle',
            detailClose: 'fa fa-minus-circle'
          }
        });

        $payment.bootstrapTable({
          toolbar: ".toolbar",

          pagination: true,
          striped: true,
          pageSize: 8,
          pageList: [8,10,25,50,100],

          formatShowingRows: function(pageFrom, pageTo, totalRows){
            //do nothing here, we don't want to show the text "showing x of y from..." 
          },
          formatRecordsPerPage: function(pageNumber){
            return pageNumber + " rows visible";
          }
        });

        $table.bootstrapTable({
          toolbar: ".toolbar",
    
          search: true,
          showToggle: true,
          showColumns: true,
          pagination: true,
          striped: true,
          pageSize: 8,
          pageList: [8,10,25,50,100],
          
          formatShowingRows: function(pageFrom, pageTo, totalRows){
            //do nothing here, we don't want to show the text "showing x of y from..." 
          },
          formatRecordsPerPage: function(pageNumber){
            return pageNumber + " rows visible";
          },
          icons: {
            refresh: 'fa fa-refresh',
            toggle: 'fa fa-th-list',
            columns: 'fa fa-columns',
            detailOpen: 'fa fa-plus-circle',
            detailClose: 'fa fa-minus-circle'
          }
        });
        
        $(window).resize(function () {
          $table.bootstrapTable('resetView');
          $payment.bootstrapTable('resetView');
        });

        $delete_student.click(function () {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to delete this student?");
          $subtitle.text("Note: All payment records made by this student shall also be deleted.");
          $subtitle.removeClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('student/delete'); ?>");
          $delete_form.find('input').val($(this).data('id'));
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('select[name="course"]').change(function() {
          var option = $(this).val();
          fee = $('[value="'+option+'"]').data('fee');
          $('input[name="balance"]').val(fee);
        });

        $('input[name="payment"]').keyup(function() {
          $('input[name="balance"]').val(fee - $(this).val() - $('input[name="discount"]').val());
        });

        $('input[name="discount"]').keyup(function() {
          $('input[name="balance"]').val(fee - $(this).val() - $('input[name="payment"]').val());
        });

        $('select[name="position"]').change(function() {
          var option = $(this).val();
          sal = $('[value="'+option+'"]').data('salary');
          $('input[name="salary"]').val(sal);
        });

        $(function() {
          setTimeout(function() {
            $(".alert").alert('close')
          }, 10000);
        });
      });

      $delete_job = $("#delete_job");
      $delete_job.click(function() {
        $delete_modal.modal("show");
        $modal_title.text("Are you sure you want to archive this job?");
        $subtitle.removeClass('hidden');
        $subtitle.text("Note: All employees employed in this job position shall also be archived.");

        $delete_form.attr('action', "<?php echo base_url('job/delete'); ?>");
        $delete_form.find('input').val($(this).data('id'));
      });

      function delete_employee(id) {
        $delete_modal.modal("show");
        $modal_title.text("Are you sure you want to delete this employee?");
        $subtitle.addClass('hidden');

        $delete_form.attr('action', "<?php echo base_url('employee/delete'); ?>");
        $delete_form.find('input').val(id);
      }

      window.operateStudents = {
        'click .more': function (e, value, row, index) {
          window.location.href="<?php echo base_url("student/"); ?>"+row.id+"";
        },
        'click .edit': function (e, value, row, index) {
          window.location.href="<?php echo base_url("student/edit/"); ?>"+row.id+"";
        },
        'click .remove': function (e, value, row, index) {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to delete this student?");
          $subtitle.text("Note: All payment records made by this student shall also be deleted.");
          $subtitle.removeClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('student/delete'); ?>");
          $delete_form.find('input').val(row.id);
        }
      };

      window.operatePayments = {
        'click .edit': function (e, value, row, index) {
          window.location.href="<?php echo base_url("payment/edit/"); ?>"+row._data.id+"";
        },
        'click .remove': function (e, value, row, index) {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to delete this payment?");
          $subtitle.addClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('payment/delete'); ?>");
          $delete_form.find('input').val(row._data.id);
        }
      };

      window.operateEmployees = {
        'click .edit': function (e, value, row, index) {
          window.location.href="<?php echo base_url("employee/edit/"); ?>"+row.id+"";
        },
        'click .remove': function (e, value, row, index) {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to archive this employee?");
          $subtitle.addClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('employee/delete'); ?>");
          $delete_form.find('input').val(row.id);
        }
      };

      window.operateCourses = {
        'click .more': function (e, value, row, index) {
          window.location.href="<?php echo base_url("course/"); ?>"+row.id+"";
        },
        'click .edit': function (e, value, row, index) {
          window.location.href="<?php echo base_url("course/edit/"); ?>"+row.id+"";
        },
        'click .remove': function (e, value, row, index) {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to archive this course?");
          $subtitle.text("Note: All students enrolled in this course shall also be archived.");
          $subtitle.removeClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('course/delete'); ?>");
          $delete_form.find('input').val(row.id);
        }
      };

      window.operateExpenses = {
        'click .edit': function (e, value, row, index) {
          window.location.href="<?php echo base_url("expense/edit/"); ?>"+row._data.id+"";
        },
        'click .remove': function (e, value, row, index) {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to delete this expense?");
          $subtitle.addClass('hidden');
          $subtitle.removeClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('expense/delete'); ?>");
          $delete_form.find('input').val(row._data.id);
        }
      };

      window.operateJobs = {
        'click .more': function (e, value, row, index) {
          window.location.href="<?php echo base_url("job/"); ?>"+row._data.id+"";
        },
        'click .edit': function (e, value, row, index) {
          window.location.href="<?php echo base_url("job/edit/"); ?>"+row._data.id+"";
        },
        'click .remove': function (e, value, row, index) {
          $delete_modal.modal("show");
          $modal_title.text("Are you sure you want to archive this job?");
          $subtitle.text("Note: All employees employed in this job position shall also be archived.");
          $subtitle.removeClass('hidden');

          $delete_form.attr('action', "<?php echo base_url('job/delete'); ?>");
          $delete_form.find('input').val(row._data.id);
        }
      };
    
      function operateFormatter(value, row, index) {
        return [
          '<a class="table-action more" href="javascript:void(0)" data-toggle="tooltip" title="More Details" data-placement="top">',
            '<i class="fa fa-info-circle"></i>',
          '</a>',
            '<a class="table-action edit" href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-placement="top">',
              '<i class="fa fa-edit"></i>',
            '</a>',
          '<a class="table-action remove" href="javascript:void(0)" title="Remove" data-toggle="tooltip" data-placement="top">',
            '<i class="fa fa-remove"></i>',
          '</a>'
        ].join('');
      }

      function operateFormatterv2(value, row, index) {
        return [
          '<a class="table-action edit" href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-placement="top">',
            '<i class="fa fa-edit"></i>',
          '</a>',
          '<a class="table-action remove" href="javascript:void(0)" title="Remove" data-toggle="tooltip" data-placement="top">',
            '<i class="fa fa-remove"></i>',
          '</a>'
        ].join('');
      }

      function operateStudentEmployeeFormatter(value, row, index) {
        return [
          '<a class="table-action more" href="javascript:void(0)" data-toggle="tooltip" title="More Details" data-placement="top">',
            '<i class="fa fa-info-circle"></i>',
          '</a>',
            '<a class="table-action edit" href="javascript:void(0)" data-toggle="tooltip" title="Edit" data-placement="top">',
              '<i class="fa fa-edit"></i>',
            '</a>'
        ].join('');
      }
    </script>
  </body>
</html>