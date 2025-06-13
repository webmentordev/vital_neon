<?php

namespace App\Jobs;

use TCPDF;
use App\Models\Product;
use App\Models\Category;
use App\Models\Proposal;
use Stripe\StripeClient;
use App\Models\CategoryPrice;
use Illuminate\Bus\Queueable;
use Spatie\Browsershot\Browsershot;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ProposalCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Proposal $proposal)
    {
        //
    }

    public function handle(): void
    {
        $proposal = $this->proposal;
        try{
            $PDFImages = [];
            $productsArray = [];

            $proposal->status = "processing";
            $proposal->save();

            $payload = json_decode($proposal->payload, true);

            $pdf = new TCPDF('L', 'px', [1600, 1130]);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(false);

            $pdf_image_directory = public_path('mockup-images');
            if (!file_exists($pdf_image_directory)) {
                mkdir($pdf_image_directory, 0775, true);
            }
            $image_directory = storage_path('app/public');
            if (!file_exists($image_directory)) {
                mkdir($image_directory, 0775, true);
            }

            foreach($payload as $single_payload) {
                $html = view("templates.pdf", [
                    "data" => $single_payload,
                    "proposal" => $proposal
                ])->render();
                $time = time();
                $pdfImage = $time .'-'. rand(99,99999) .".png";
                $pdfPath = $pdf_image_directory . '/' . $pdfImage;
                Browsershot::html($html)
                ->timeout(60)
                ->waitUntilNetworkIdle()
                ->setOption('args', ['--no-sandbox', 
                        '--disable-web-security',
                        '--disable-extensions',
                        '--disable-gpu'])
                ->windowSize(1600, 1130)
                ->select('#template')
                ->save($pdfPath);
                $PDFImages[] = $pdfPath;


                $image = view("templates.image", [
                    "data" => $single_payload
                ])->render();
                $imageFile = $time .'-'. rand(999,9999999) .".png";
                $savedURL = '/products/' . $imageFile;
                $imagePath = $image_directory . $savedURL;
                Browsershot::html($image)
                ->timeout(60)
                ->waitUntilNetworkIdle()
                ->setOption('args', ['--no-sandbox', 
                        '--disable-web-security',
                        '--disable-extensions',
                        '--disable-gpu'])
                ->windowSize(1150, 990)
                ->select('#template')
                ->save($imagePath);

                $productUrl = $this->createProduct($proposal, $single_payload, $savedURL);
                $productsArray[] = $productUrl;
                
                $pdf->AddPage();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Rect(0, 0, 1600, 1130, 'F');
                $pdf->Image($pdfPath, 0, 0, 1600, 1130, '', $productUrl, '', true, 150, '', false, false, 0, true, false, true);
            }

            $pdfDirectory = public_path('mockup-pdf');
            if (!file_exists($pdfDirectory)) {
                mkdir($pdfDirectory, 0775, true);
            }

            $finalPdfPath = $pdfDirectory . '/proposal-' . $time . '.pdf';
            $pdf->Output($finalPdfPath, 'F');
            $finalPDFURL = config('app.url') . '/mockup-pdf/proposal-' . $time . '.pdf';

            $proposal->pdf = $finalPDFURL;
            $proposal->products = json_encode($productsArray);
            $proposal->status = "ready";
            $proposal->save();
            foreach ($PDFImages as $singlePDFImage) {
                if (file_exists($singlePDFImage)) {
                    unlink($singlePDFImage);
                }
            }
        }catch(\Exception $e){
            $proposal->status = "processing";
            $proposal->save();
            Log::error("Processing failed: ". $e->getMessage());
        }
    }

    public function createProduct($proposal, $payload, $imageurl){
        $stripe = new StripeClient(config('app.stripe'));

        $imageLink = $imageurl;
        $name = "Custom Neon Sign For ". $proposal->name;
        $slug = strtolower(str_replace(" ","-", $name)).'-'.rand(999,99999999);

        $result = $stripe->products->create([
            'name' => $name,
            'images' => [
                config('app.url').'/storage/'.$imageLink
            ]
        ]);

        $category = Category::where("name", "Custom")->first();

        if(!$category){
            $category = Category::create([
                'name' => "Custom",
                'slug' => 'custom',
                'is_active' => false
            ]);
        }
        $product = Product::create([
            'name' => $name,
            'stripe_id' => $result['id'],
            'slug' => $slug,
            'image' => $imageLink,
            'for_customer' => true,
            'body' => "Please make sure spellings are correct and mention that dimensions are accurate. The product includes 2 years warranty with UL Listed Components. Delivery is expected within 15 to 17 working days. A test proof of color can be provided upon request. Please note that VitalNeon allows up to 5% color and dimension tolerance, which is an acceptable difference between the digital proof and the actual product.",
            'description' => "Please make sure spellings are correct and mention that dimensions are accurate. The product includes 2 years warranty with UL Listed Components. Delivery is expected within 15 to 17 working days. A test proof of color can be provided upon request. Please note that VitalNeon allows up to 5% color and dimension tolerance, which is an acceptable difference between the digital proof and the actual product.",
            'category_id' => $category->id
        ]);
        foreach($payload['sizes'] as $size){
            CategoryPrice::create([
                'name' => $size->dimensions,
                'product_id' => $product->id,
                'price' => $size['price']
            ]);
        }
        return config('app.url').'/product/'. $slug;
    }
}