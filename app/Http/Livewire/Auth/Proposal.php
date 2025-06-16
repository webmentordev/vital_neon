<?php

namespace App\Http\Livewire\Auth;

use Exception;
use App\Models\Product;
use Livewire\Component;
use Stripe\StripeClient;
use App\Mail\ProposalReady;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\CategoryPrice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Proposal as ProposalModel;

class Proposal extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.auth.proposal', [
            'proposals'=> ProposalModel::latest()->paginate(100),
        ])->layout('layouts.livewire');
    }

    public function sendEmail(ProposalModel $proposal) {
        Mail::to($proposal->email)->queue(new ProposalReady($proposal->name, $proposal));
        $proposal->is_sent = true;
        $proposal->save();
        return session()->flash('success','Email has been sent!');
    }

    public function delete(ProposalModel $proposal){
        try{
            $products = collect(json_decode($proposal->products));
            $products_slugs = $products->map(function ($product) {
                return Str::afterLast($product, '/');
            });
            foreach($products_slugs as $slug){
                $product = Product::where('slug', $slug)->first();
                $stripe = new StripeClient(config('app.stripe'));
                if($product->image && Storage::disk('public_disk')->exists($product->image)) {
                    Storage::disk('public_disk')->delete($product->image);
                }
                $stripe->products->delete($product->stripe_id, []);
                $product->delete();
            }
            if($proposal->pdf) {
                $pdfPath = public_path($proposal->pdf);
                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
            }
            $proposal->delete();
            return session()->flash('success','Product has been deleted!');
        }catch(Exception $e){
            Log::error("Product deletion failed: ", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'code' => $e->getCode()
            ]);
            return session()->flash('failed','Deletion failed! please contact the developer.');
        }
    }
}