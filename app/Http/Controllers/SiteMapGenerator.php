<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteMapGenerator extends Controller
{
    public function index() {
        $products = Product::all();
        $categories = Category::all();
        return response()->view('sitemap', [
            'products' => $products,
            'categories' => $categories
        ])->header('Content-Type', 'text/xml');
    }
}
