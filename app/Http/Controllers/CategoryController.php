<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
            'slug' => "required|max:255|unique:categories,slug",
            'title' => "required",
            'description' => "required",
            'body' => "required",
            'image' => "nullable|image"
        ]);
        Category::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'image' => $request->image != null ? $request->image->store("category_images") : null,
            'slug' => Str::slug($request->slug)
        ]);
        return back()->with('success', 'Product Category has been added!');
    }

    public function update_index(Category $category){
        return view('category-update', [
            'category' => $category,
        ]);
    }

    public function update_store(Request $request, Category $category){
        $this->validate($request, [
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'slug' => [
                'required',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id),
            ],
            'title' => "required",
            'description' => "required",
            'body' => "required",
            'image' => "nullable|image"
        ]);

        if($request->image){
           if($category->image){
                if(Storage::disk('public_disk')->exists($category->image)){
                    Storage::disk('public_disk')->delete($category->image);
                }
           }
        }
        $category->update(array_filter([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'image' => $request->image != null ? $request->image->store("category_images") : null,
            'slug' => Str::slug($request->slug)
        ]));
        return back()->with('success', 'Product Category has been added!');
    }
}