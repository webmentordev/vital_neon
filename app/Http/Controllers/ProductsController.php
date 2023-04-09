<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Search;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        return view('products', [
            'products' => Product::latest()->get()
        ]);
    }

    public function search(Request $request){
        $result = Product::where('name', 'LIKE', '%'.$request->search.'%')->get();
        Search::create([
            'search' => $request->search
        ]);
        return view('products', [
            'products' => $result
        ]);
    }
};