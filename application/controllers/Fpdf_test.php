<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Fpdf_test extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
      $this->load->library(array('session', 'form_validation'));

      $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

      // if(empty($this->session->userdata['id'])){
      //   $this->session->set_userdata(array('access' => 'no'));
      //   redirect(base_url());
      // }
    }

    public function index() { 
      $this->load->model('payment_model');
      $this->load->library('fpdf_lib');
      
      // Top Logos
      $this->fpdf->Image(base_url('assets/img/logo/200px.png'), (215-60)/2, 10, 30);
      $this->fpdf->Image(base_url('assets/img/tesdalogo.png'), (215)/2, 11, 30);

      // Title
      $this->fpdf->SetY(45);
      $this->fpdf->Title("Daily Payments Report");

      // Subtitle
      $this->fpdf->SetFont('Open Sans', '', 11);
      $this->fpdf->Cell(0, 5, date('F d, Y'), 0, 1, 'C', false);

      $header = array('ID Number', 'Name', 'Amount');
      $width = array(50, 80, 55);
      $data = $this->fpdf->LoadData(APPPATH.'third_party/fpdf/tutorial/countries.txt');
      $this->fpdf->Table($header, $data, $width);

      // Summary
      $this->fpdf->Cell(0, 5);
      $this->fpdf->Ln();
      $this->fpdf->Title("Summary");

      echo $this->fpdf->Output('hello_world.pdf','I');
    }
  }
?>