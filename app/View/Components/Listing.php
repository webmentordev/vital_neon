<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class Listing extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listing', [
            'products' => Product::latest()->where('featured', true)->orderBy('id', 'DESC')->limit(12)->get(),
            'discount' => DB::table('discounts')->latest()->first(),
            'categories' => Category::get()
        ]);
    }
}