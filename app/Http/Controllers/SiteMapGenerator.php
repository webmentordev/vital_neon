<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\LightBox;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteMapGenerator extends Controller
{
    public function index() {
        return response()->view('sitemap', [
            'products' => Product::where('is_active', true)->where('for_customer', false)->get(),
            'lightboxes' => LightBox::where('is_active', true)->get(),
            'categories' => Category::all(),
            'blogs' => Blog::all(),
        ])->header('Content-Type', 'text/xml');
    }
}