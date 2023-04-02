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
            'price' => "required|numeric|min:1",
        ]);
        CategoryPrice::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return back()->with('success', 'Category has been added!');
    }
}