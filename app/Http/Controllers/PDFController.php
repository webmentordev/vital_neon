<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use TCPDF;

class PDFController extends Controller
{
    public function index(){
        return view("templates.pdf");
    }

    public function store(){
        $url = "https://youtube.com";
        $directory = public_path('mockup-images');
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        $html = view("templates.pdf")->render();
        $time = time();
        $imageName = $time . ".png";
        $imagePath = $directory . '/' . $imageName;

        Browsershot::html($html)
        ->setOption('args', ['--no-sandbox'])
        ->select('#template')
        ->save($imagePath);

        $pdf = new TCPDF();
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false);

        $pdf->AddPage('L');
        $pdf->SetFillColor(255, 255, col3: 255);
        $pdf->Rect(0, 0, 320, 250, 'F');
        $pdf->Image($imagePath, 0, 0, 320, 250, '', $url, '', false, 300, '', false, false, 0, true, false, true);

        $pdfDirectory = public_path('mockup-pdf');
        if (!file_exists($pdfDirectory)) {
            mkdir($pdfDirectory, 0775, true);
        }

        $finalPdfPath = $pdfDirectory . '/proposal-' . $time . '.pdf';
        $pdf->Output($finalPdfPath, 'F');
        $finalPDFURL = config('app.url') . '/mockup-pdf/proposal-' . $time . '.pdf';

        unlink($imagePath);

        return response()->json([
            "url" => $finalPDFURL
        ], 200);
    }
}