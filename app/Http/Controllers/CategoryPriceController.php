<?php

namespace App\Http\Controllers;

use App\Models\CategoryPrice;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryPriceController extends Controller
{
    public function index(){
        return view('category', [
            'categories' => CategoryPrice::get(),
            'products' => Product::get()
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => "required|max:255",
            'product' => "required|numeric",
            'price' => "required|numeric|min:1",
        ]);
        CategoryPrice::create([
            'name' => $request->name,
            'product_id' => $request->product,
            'price' => $request->price + 45
        ]);
        return back()->with('success', 'Category has been added!');
    }
}