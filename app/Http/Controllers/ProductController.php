<?php

namespace App\Http\Controllers;

use App\Models\CategoryPrice;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('product', [
            'products' => Product::latest()->get(),
            'categories' => CategoryPrice::latest()->get(),
        ]);
    }
}