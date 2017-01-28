<?php

  class Expense extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('expense_model');
      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation'));

      if(empty($this->session->userdata['id'])){
        $this->session->set_userdata(array('access' => 'no'));
        redirect(base_url());
      }
    }

    public function index($month = NULL, $year = NULL) {
      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => 'Access denied!'));
        redirect(base_url('student'));
      }

      $data['tab'] = 'expense';
      $data['title'] = 'Expense | List';

      if(empty($month) || empty($year)) {
        $year = $this->expense_model->get_year(TRUE);
        $year = $year['year_number'];
        $month = $this->expense_model->get_month($year, TRUE);
        $month = $month['month_number'];
      }

      $data['expense'] = $this->expense_model->get_expense($month, $year);

      $data['year_selected'] = $year;
      $data['month_selected'] = $month;

      $data['year'] = $this->expense_model->get_year();
      $data['month'] = $this->expense_model->get_month($year);

      $this->load->view('templates/header', $data);
      $this->load->view('expense/list', $data);
      $this->load->view('templates/footer', $data);
    }

    public function new_expense() {
      $data['tab'] = 'expense';
      $data['title'] = 'Expense | New';

      $this->form_validation->set_rules('amount', 'amount', 'required');
      $this->form_validation->set_rules('receipt_no', 'receipt number', 'required');
      $this->form_validation->set_rules('details', 'details', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('expense/new', $data);
        $this->load->view('templates/footer', $data);
      } else {
        // echo $this->expense_model->insert_expense();
        if($this->expense_model->insert_expense()) 
          $this->session->set_userdata(array('message' => "A new expense has been successfully added!"));
        else
          $this->session->set_userdata(array('message' => "There was an error in adding the new expense. Kindly refer this to the administrator."));

        redirect(base_url('expense'), 'location');
      }
    }

    public function edit($id) {
      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => 'Access denied!'));
        redirect(base_url('student'));
      }

      $data['tab'] = 'expense';
      $data['title'] = 'Expense | Edit';
      $data['expense'] = $this->expense_model->get_expense_by_id($id);

      $this->form_validation->set_rules('date_recorded', 'date recorded', 'required');
      $this->form_validation->set_rules('amount', 'amount', 'required');
      $this->form_validation->set_rules('receipt_no', 'receipt number', 'required');
      $this->form_validation->set_rules('details', 'details', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('expense/edit', $data);
        $this->load->view('templates/footer', $data);
      } else {
        // echo $this->expense_model->update();
        if($this->expense_model->update())
          $this->session->set_userdata(array('message' => "The expense has been successfully updated!"));
        else
          $this->session->set_userdata(array('message' => "There was an error in updating the expense. Kindly refer this to the administrator."));

        redirect(base_url('expense'), 'location');
      }
    }

    public function delete() {
      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => 'Access denied!'));
        redirect(base_url('student'));
      }

      if($this->expense_model->delete())
        $this->session->set_userdata(array('message' => "The expense has been successfully deleted!"));
      else
        $this->session->set_userdata(array('message' => "There was an error in deleting the expense. Kindly refer this to the administrator."));

      redirect(base_url('expense'), 'location');
    }
  }

?>