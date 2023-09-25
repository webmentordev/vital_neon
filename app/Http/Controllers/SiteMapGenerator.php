<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteMapGenerator extends Controller
{
    public function index() {
        return response()->view('sitemap', [
            'products' => Product::all(),
            'categories' => Category::all(),
            'blogs' => Blog::all()
        ])->header('Content-Type', 'text/xml');
    }
}
