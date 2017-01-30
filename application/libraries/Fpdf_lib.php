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

  public function Footer()
  {
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