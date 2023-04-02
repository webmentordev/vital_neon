<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $this->validate($request, [
            'name' => "required|max:255|unique:products,name",
            'price' => "required|numeric|min:1",
            'image' => "required|image|mimes:png,jpg,jpeg,webp",
            'body' => "required",
        ]);
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image->store('products', 'public_disk'),
            'body' => $request->body,
        ]);
        return back()->with('success', 'Product has been added!');
    }
}