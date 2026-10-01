<?php

namespace App\Classes;

use Classes\tfpdf\tFPDF;

require 'tfpdf/tfpdf.php';

class PDF extends tFPDF
{
    public $string;

// Page header
    function Header(): void
    {
        // Logo;
//        $this->Image('fpdf/logo.jpg',10,6,70);
//        // Arial bold 15
//        $this->AddFont('DejaVu','','DejaVuSans-Bold.ttf',true);
//        $this->SetFont('DejaVu','',20);
//        $this->Cell(80);
//        $this->Cell(0,20,'Load order' . " " . $this->string,1,0,'C');
//        // Line break
//        $this->Ln(20);
//        $this->SetXY(10, 60);
    }

// Page footer
    function Footer()
    {
//        // Position at 1.5 cm from bottom
//        $this->SetY(-15);
//        // Arial italic 8
//        $this->SetFont('Arial','I',8);
//        // Page number
//        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}