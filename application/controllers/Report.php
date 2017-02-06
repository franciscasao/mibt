<?php

  class Report extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->model('payment_model');
      $this->load->model('expense_model');
      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation', 'fpdf_lib'));

      if(empty($this->session->userdata['id'])){
        $this->session->set_userdata(array('access' => 'no'));
        redirect(base_url());
      }

      if($this->session->userdata('authentication') == 'employee'){
        $this->session->set_userdata(array('error' => "Access denied!"));
        redirect(base_url('student'));
      }

      $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    public function index() {
      $data['tab'] = 'report';
      $data['title'] = 'Reports';

      $this->load->view('templates/header', $data);
      $this->load->view('reports/index', $data);
      $this->load->view('templates/footer', $data);
    }

    public function financial() {
      $data['tab'] = 'report';
      $data['title'] = 'Reports | Financial';

      $this->load->view('templates/header', $data);
      $this->load->view('reports/financial', $data);
      $this->load->view('templates/footer', $data);
    }

    public function financial_report() {
      $date = new DateTime();

      $this->fpdf->TopLogos();

      // Title
      $this->fpdf->SetY(45);
      $this->fpdf->Title("Financial Report");

      $this->fpdf->SetFont('Open Sans', '', 11);
      $this->fpdf->Cell(0, 5, $date->format('F d, Y'), 0, 1, 'C', false);

      $this->fpdf->Subtitle('Payments');

      $header = array('', 'Student ID', 'Name', 'Amount');
      $width = array(10, 40, 85, 55);

      $tmp = $this->payment_model->get_report_data();
      $data = array();
      $count = 1;
      $payment_total = 0;
      foreach($tmp as $row) {
        $row['id'] = 'M'.$row['id'];
        $payment_total = $payment_total + $row['amount'];
        $row['amount'] = 'Php '.number_format($row['amount'], 2);
        array_unshift($row, $count);
        array_push($data, array_values($row));
        $count++;
      }

      $this->fpdf->Table($header, $data, $width);
      $this->fpdf->Cell(135, 8, 'Total', 0, 0);
      $this->fpdf->Cell(55, 8, 'Php '.number_format($payment_total, 2), 0, 1);

      $this->fpdf->Ln();
      $this->fpdf->Subtitle('Expenses');

      $header = array('', 'Employee ID', 'Details', 'Recipt No.', 'Amount');
      $width = array(10, 30, 65, 50, 35);

      $tmp = $this->expense_model->get_report_data();
      $data = array();
      $count = 1;
      $expense_total = 0;
      foreach($tmp as $row) {
        $expense_total = $expense_total + $row['amount'];
        $row['id'] = 'E'.$row['id'];
        $row['amount'] = 'Php '.number_format($row['amount'], 2);
        $row['details'] = ucwords($row['details']);
        array_unshift($row, $count);
        array_push($data, array_values($row));
        $count++;
      }

      $this->fpdf->Table($header, $data, $width);
      $this->fpdf->Cell(155, 8, 'Total', 0, 0);
      $this->fpdf->Cell(35, 8, 'Php '.number_format($expense_total, 2), 0, 1);

      $this->fpdf->Ln();
      $this->fpdf->Subtitle('Total');

      $header = array('Total Payments', 'Total Expense', 'Income for the day');
      $width = array(65, 60, 60);
      $data = array();
      $tmp = array(
        'Php '. number_format($payment_total, 2),
        'Php '. number_format($expense_total, 2),
        'Php '. number_format(($payment_total-$expense_total), 2),
      );
      array_push($data, array_values($tmp));

      $this->fpdf->Table($header, $data, $width);

      // echo $this->fpdf->Output('hello_world.pdf','I');
    }
  }

?>