<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Stripe\StripeClient;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('product', [
            'products' => Product::latest()->with('categories')->get(),
        ]);
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $filename = $request->file('upload')->storeAs('body_images', str_replace(' ', '-', $request->file('upload')->getClientOriginalName()), 'public_disk');
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/'.$filename); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function create(Request $request){
        $stripe = new StripeClient(config('app.stripe'));
        $this->validate($request, [
            'name' => "required|max:255|unique:products,name",
            'image' => "required|image|mimes:png,jpg,jpeg,webp",
            'slug' => "required|max:255",
            'body' => "required",
        ]);

        $result = $stripe->products->create([
            'name' => $request->name,
        ]);

        Product::create([
            'name' => $result->name,
            'stripe_id' => $result['id'],
            'slug' => strtolower(str_replace(' ', '-', $request->slug)),
            'image' => $request->image->store('products', 'public_disk'),
            'body' => $request->body
        ]);
        return back()->with('success', 'Product has been added!');
    }
}