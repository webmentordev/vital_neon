<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Stripe\StripeClient;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        return view('product', [
            'products' => Product::latest()->orWhere('name', 'LIKE', '%'.$request->search.'%')->with('categories')->paginate(20),
            'categories' => Category::latest()->get()
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
            'description' => "required",
            'category' => "required|numeric",
        ]);

        $imageLink = $request->image->storeAs('products', strtolower(str_replace(' ', '-', $request->slug)).".".$request->image->getClientOriginalExtension(), 'public_disk');

        $result = $stripe->products->create([
            'name' => $request->name,
            'images' => [
                config('app.url').'/storage/'.$imageLink
            ]
        ]);

        Product::create([
            'name' => $request->name,
            'stripe_id' => $result['id'],
            'slug' => strtolower(str_replace(' ', '-', $request->slug)),
            'image' => $imageLink,
            'body' => $request->body,
            'description' => $request->description,
            'category_id' => $request->category
        ]);
        return back()->with('success', 'Product has been added!');
    }



    public function update(Product $product){
        return view('update-product', [
            'product' => $product,
            'categories' => Category::latest()->get()
        ]);
    }

    public function update_product(Product $product){
        return view('update-product', [
            'product' => $product,
            'categories' => Category::latest()->get()
        ]);
    }
}