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

    public function generate_report() {
      $duration = $this->input->post('duration');

      if($duration == 'daily')
        echo $this->daily_report();
      else if($duration == 'monthly')
        echo $this->monthly_report();
      else if($duration == 'annually')
        echo $this->annual_report();
    }

    public function daily_report() {
      $date = new DateTime();
      $date->setDate($this->input->post('year'), $this->input->post('month'), $this->input->post('day'));

      $this->fpdf->TopLogos();
      $this->fpdf->SetY(45);
      $this->fpdf->Title("Financial Report | ".$date->format('F d, Y'));

      $this->fpdf->SetFont('Open Sans', '', 11);
      $this->fpdf->Cell(0, 5, 'As of '.date('F d, Y h:i A'), 0, 1, 'C', false);

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

      $header = array('', 'Employee Name', 'Details', 'Recipt No.', 'Amount');
      $width = array(10, 50, 55, 45, 30);

      $tmp = $this->expense_model->get_report_data();
      $data = array();
      $count = 1;
      $expense_total = 0;
      foreach($tmp as $row) {
        $expense_total = $expense_total + $row['amount'];
        $row['amount'] = 'Php '.number_format($row['amount'], 2);
        $row['details'] = ucwords($row['details']);
        array_unshift($row, $count);
        array_push($data, array_values($row));
        $count++;
      }

      $this->fpdf->Table($header, $data, $width);
      $this->fpdf->Cell(160, 8, 'Total', 0, 0);
      $this->fpdf->Cell(30, 8, 'Php '.number_format($expense_total, 2), 0, 1);

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

      return $this->fpdf->Output($date->format('F d, Y').' Financial Report.pdf', 'D');
    }

    public function monthly_report() {
      $date = new DateTime();
      $date->setDate($this->input->post('year'), $this->input->post('month')+1, $this->input->post('day'));

      $this->fpdf->TopLogos();
      $this->fpdf->SetY(45);
      $this->fpdf->Title("Financial Report | ".$date->format('F Y'));

      $this->fpdf->SetFont('Open Sans', '', 11);
      $this->fpdf->Cell(0, 5, 'As of '.date('F d, Y h:i A'), 0, 1, 'C', false);

      $this->fpdf->Subtitle('Payments');

      $header = array('', 'Date', 'Student ID', 'Name', 'Amount');
      $width = array(10, 30, 40, 65, 35);

      $tmp = $this->payment_model->get_report_data();
      $data = array();
      $count = 1;
      $payment_total = 0;
      foreach($tmp as $row) {
        $row['id'] = 'M'.$row['id'];
        $payment_total = $payment_total + $row['amount'];
        $row['amount'] = 'Php '.number_format($row['amount'], 2);

        $tmp = new DateTime($row['date_recorded']);
        array_unshift($row, $tmp->format('d-M-Y'));
        array_pop($row);

        array_unshift($row, $count); // Add a count at the beginning of row
        array_push($data, array_values($row));
        $count++;
      }

      $this->fpdf->Table($header, $data, $width);
      $this->fpdf->Cell(145, 8, 'Total', 0, 0);
      $this->fpdf->Cell(35, 8, 'Php '.number_format($payment_total, 2), 0, 1);

      $this->fpdf->Ln();
      $this->fpdf->Subtitle('Expenses');

      $header = array('', 'Date', 'Name', 'Details', 'Amount');
      $width = array(10, 30, 50, 65, 30);

      $tmp = $this->expense_model->get_report_data();
      $data = array();
      $count = 1;
      $expense_total = 0;
      foreach($tmp as $row) {
        $expense_total = $expense_total + $row['amount'];
        $row['amount'] = 'Php '.number_format($row['amount'], 2);
        $row['details'] = ucwords($row['details']);
        unset($row['receipt_no']);

        $tmp = new DateTime($row['date_recorded']);
        array_unshift($row, $tmp->format('d-M-Y'));
        array_pop($row);

        array_unshift($row, $count);
        array_push($data, array_values($row));
        $count++;
      }

      $this->fpdf->Table($header, $data, $width);
      $this->fpdf->Cell(155, 8, 'Total', 0, 0);
      $this->fpdf->Cell(30, 8, 'Php '.number_format($expense_total, 2), 0, 1);

      $this->fpdf->Ln();
      $this->fpdf->Subtitle('Total');

      $header = array('Total Payments', 'Total Expense', 'Income for the month');
      $width = array(65, 60, 60);
      $data = array();
      $tmp = array(
        'Php '. number_format($payment_total, 2),
        'Php '. number_format($expense_total, 2),
        'Php '. number_format(($payment_total-$expense_total), 2),
      );
      array_push($data, array_values($tmp));

      $this->fpdf->Table($header, $data, $width);

      return $this->fpdf->Output($date->format('F Y').' Financial Report.pdf', 'D');
    }

    public function annual_report() {
      $year = $this->input->post('year');

      $this->fpdf->TopLogos();
      $this->fpdf->SetY(45);
      $this->fpdf->Title("Financial Report | ".$year);

      $this->fpdf->SetFont('Open Sans', '', 11);
      $this->fpdf->Cell(0, 5, 'As of '.date('F d, Y h:i A'), 0, 1, 'C', false);

      $this->fpdf->Subtitle('Payments');

      $header = array('Month', 'Total Number', 'Total Amount');
      $width = array(50, 50, 85);

      $tmp = $this->payment_model->get_annual_data();
      $data = array();
      $total = 0;
      foreach($tmp as $row) {
        $total = $total + $row['sum'];
        $row['sum'] = 'Php '.number_format($row['sum'], 2);

        $date = new DateTime('1997-'.$row['month'].'-21');
        $row['month'] = $date->format('F');

        array_push($data, array_values($row));
      }

      $this->fpdf->Table($header, $data, $width);

      $this->fpdf->Cell(100, 8, 'Total', 0, 0);
      $this->fpdf->Cell(85, 8, 'Php '.number_format($total, 2), 0, 1);

      $this->fpdf->Ln();
      $this->fpdf->Subtitle('Expenses');

      $header = array('Month', 'Total Number', 'Total Amount');
      $width = array(50, 50, 85);

      $tmp = $this->expense_model->get_annual_data();
      $data = array();
      $expense_total = 0;
      foreach($tmp as $row) {
        $expense_total = $expense_total + $row['sum'];
        $row['sum'] = 'Php '.number_format($row['sum'], 2);

        $date = new DateTime('1997-'.$row['month'].'-21');
        $row['month'] = $date->format('F');

        array_push($data, array_values($row));
      }

      $this->fpdf->Table($header, $data, $width);

      $this->fpdf->Cell(100, 8, 'Total', 0, 0);
      $this->fpdf->Cell(85, 8, 'Php '.number_format($expense_total, 2), 0, 1);

      $this->fpdf->Ln();
      $this->fpdf->Subtitle('Total');

      $header = array('Total Payments', 'Total Expense', 'Income for the year');
      $width = array(65, 60, 60);
      $data = array();
      $tmp = array(
        'Php '. number_format($total, 2),
        'Php '. number_format($expense_total, 2),
        'Php '. number_format(($total-$expense_total), 2),
      );
      array_push($data, array_values($tmp));

      $this->fpdf->Table($header, $data, $width);

      return $this->fpdf->Output($year.' Financial Report.pdf', 'D');
    }
  }

?>