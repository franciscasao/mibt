<?php

  class Payment extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('payment_model');
      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation', 'fpdf_lib'));

      $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

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

      $data['tab'] = 'payment';
      $data['title'] = 'Payment | List';
      
      if(empty($month) || empty($year)) {
        $year = $this->payment_model->get_year(TRUE);
        $year = $year[0]['year'];

        $month = $this->payment_model->get_month($year, TRUE);
        $month = $month[0]['month'];
      }

      $data['payment'] = $this->payment_model->get_payment($month, $year);
      $data['year'] = $this->payment_model->get_year();
      $data['month'] = $this->payment_model->get_month($year);
      $data['year_selected'] = $year;
      $data['month_selected'] = $month;

      $this->load->view('templates/header', $data);
      $this->load->view('payment/list', $data);
      $this->load->view('templates/footer', $data);
    }

    public function edit_payment($id) {
      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => 'Access denied!'));
        redirect(base_url('student'));
      }
      
      $data['tab'] = 'payment';
      $data['title'] = 'Expense | Edit';

      $data['payment'] = $this->payment_model->get_payment_by_id($id);

      $this->load->view('templates/header', $data);
      $this->load->view('payment/edit', $data);
      $this->load->view('templates/footer', $data);
    }

    public function new_payment($id = NULL) {
      $data['tab'] = 'payment';
      $data['title'] = 'Expense | New';
      $data['student_id'] = $id;

      $this->form_validation->set_rules('date_recorded', 'date recorded', 'required');
      $this->form_validation->set_rules('payment', 'amount', 'required');
      $this->form_validation->set_rules('id', 'Student ID', 'required');

      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('payment/new', $data);
        $this->load->view('templates/footer', $data);
      } else {
        if($this->payment_model->insert_payment())
          $this->session->set_userdata(array('message' => "A payment by a student has been successfully added."));
        else
          $this->session->set_userdata(array('message' => "There was error with adding the payment. Please refer this to the administrator."));

        redirect(base_url('payment'), 'location');
      }
    }

    public function delete() {
      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => 'Access denied!'));
        redirect(base_url('student'));
      }
      
      if($this->payment_model->delete())
        $this->session->set_userdata(array('message' => "You have successfully deleted the payment."));
      else
        $this->session->set_userdata(array('message' => "There was an error in deleting the payment. Kindly refer this to the administrator."));

      redirect(base_url('payment'));
    }

    public function daily_report() {
      $date = $this->input->post('report_date');
      $date = new DateTime($date);

      $this->fpdf->TopLogos();

      // Title
      $this->fpdf->SetY(45);
      $this->fpdf->Title("Daily Payments Report");

      // Subtitle
      $this->fpdf->SetFont('Open Sans', '', 11);
      $this->fpdf->Cell(0, 5, $date->format('F d, Y'), 0, 1, 'C', false);

      $header = array('ID Number', 'Name', 'Amount');
      $width = array(50, 80, 55);
      $key = array('student_id', 'last_name', 'amount');

      $tmp = $this->payment_model->get_report_data($date->format('Y'), $date->format('m'), $date->format('d'));
      $data = array();
      foreach($tmp as $row) {
        $row['id'] = 'M'.$row['id'];
        $row['amount'] = 'Php '.number_format($row['amount']);
        array_push($data, array_values($row));
      }

      $this->fpdf->Table($header, $data, $width, $key);

      // Summary
      $this->fpdf->Cell(0, 5);
      $this->fpdf->Ln();
      $this->fpdf->Title("Summary");

      echo $this->fpdf->Output('hello_world.pdf','I');
    }
  }

?>