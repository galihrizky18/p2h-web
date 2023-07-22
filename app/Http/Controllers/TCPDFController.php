<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class TCPDFController extends Controller
{

    public function view(){
        return view('pdf.v_reportPdf');
    }

    public function reportFormAdmin(){
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        

        $html = view('pdf.v_reportPdf');
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->SetMargins(10, 1, 10);
        // megnhapus header dan footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);


        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output();
        exit;



    }
}
