<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('product-category', [
            'categories' => Category::latest()->get(),
        ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => "required|max:255|unique:categories,name",
        ]);
        Category::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name))
        ]);
        return back()->with('success', 'Product Category has been added!');
    }
}
