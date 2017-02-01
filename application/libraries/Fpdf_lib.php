<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/fpdf/fpdf-1.8.php';

class PDF extends FPDF {
  // Load data
  public function LoadData($file) {
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
      $data[] = explode(';',trim($line));
    return $data;
  }

  public function TopLogos() {
    $this->Image(base_url('assets/img/logo/200px.png'), (215-60)/2, 10, 30);
    $this->Image(base_url('assets/img/tesdalogo.png'), (215)/2, 11, 30);
  }

  public function Title($txt) {    
    $this->SetFont('Open Sans', 'B', 18);
    $this->Cell(0, 8, strtoupper($txt), 0, 1, 'C', false);
  }

  public function Table($header, $data, $width) {
    $this->SetFont('Open Sans','B');

    $this->Ln();
    for($i=0; $i < count($header); $i++)
      $this->Cell($width[$i], 8, $header[$i], 0, 0, 'L', false);
    $this->Ln();

    $this->Cell(array_sum($width), 0, '', 'T', 1);

    $this->SetFillColor(245, 245, 245);
    $this->SetTextColor(0);
    $this->SetFont('');
    
    $fill = false;
    foreach($data as $row) {
      for($i=0; $i < count($header); $i++)
        $this->Cell($width[$i], 8, $row[$i], 0, 0, 'L', $fill);
      $this->Ln();
      $fill = !$fill;
    }

    $this->Cell(array_sum($width), 0, '', 'T', 1);
  }

  public function Footer() {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',8);
    $this->SetDrawColor(1, 146, 220);
    $this->Line(10, 263, 215-10, 263);
    $this->SetLineWidth(2);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
  }
}

class Fpdf_lib {
    
  public function __construct() {
    $pdf = new PDF('P', 'mm', 'Letter');

    $pdf->AddFont('Open Sans', '', 'OpenSans-Regular.php');
    $pdf->AddFont('Open Sans', 'B', 'OpenSans-Bold.php');

    $pdf->SetLeftMargin(15);
    $pdf->SetRightMargin(15);

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $CI =& get_instance();
    $CI->fpdf = $pdf;
  }
}