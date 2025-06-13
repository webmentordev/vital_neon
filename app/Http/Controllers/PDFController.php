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
            ->timeout(60)
            ->waitUntilNetworkIdle()
            ->setOption('args', ['--no-sandbox', 
                    '--disable-web-security',
                    '--disable-extensions',
                    '--disable-gpu'])
            ->windowSize(1600, 1130)
            ->select('#template')
            ->save($imagePath);

        $pdf = new TCPDF('L', 'px', [1600, 1130]);
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false);

        $pdf->AddPage();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Rect(0, 0, 1600, 1130, 'F');
        $pdf->Image($imagePath, 0, 0, 1600, 1130, '', $url, '', true, 150, '', false, false, 0, true, false, true);

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