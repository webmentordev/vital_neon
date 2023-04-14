<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function category($category){
        $result = Category::where('name', $category)->with('products')->first();
        if($result != null){
            return view('products', [
                'products' => $result->products
            ]);
        }else{
            abort(404, 'Not Found!');
        }
    }
};