<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        $product_info = $products->map(function ($data) {
            $data->created = $data->created_at->format('D d/m/Y H:i:s A');
            $data->image = config('app.url').'/storage/'.$data->image;
            return $data;
        });
        return response()->json([
            'status' => 201,
            'data' => $product_info
        ], 201);
    }

    public function show(Product $product){
        $product->created = $product->created_at->format('D d/m/Y H:i:s A');
        $product->image = config('app.url') . '/storage/' . $product->image;
        return $product;
    }
}