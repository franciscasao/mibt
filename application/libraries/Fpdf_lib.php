<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  FPDF
* 
* Author: Jd Fiscus
*       jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://www.fpdf.org/
* 
* Location: http://github.com/iamfiscus/Codeigniter-FPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to generate a PDF with the FPDF library
* 
*/
require_once APPPATH.'third_party/fpdf/fpdf-1.8.php';

class PDF extends FPDF {
  // Load data
  function LoadData($file) {
      // Read file lines
      $lines = file($file);
      $data = array();
      foreach($lines as $line)
          $data[] = explode(';',trim($line));
      return $data;
  }

  // Colored table
  function Table($header, $data) {
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row) {
      $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
      $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
      $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
      $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
      $this->Ln();
      $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
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

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $CI =& get_instance();
    $CI->fpdf = $pdf;
  }
}