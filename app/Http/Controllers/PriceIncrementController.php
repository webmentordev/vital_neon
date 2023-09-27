<?php

namespace App\Http\Controllers;

use App\Models\PriceIncrement;
use Illuminate\Http\Request;

class PriceIncrementController extends Controller
{
    public function index(){
        return view('auth.price-percentage', [
            'prices' => PriceIncrement::latest()->get()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'percentage' => 'required|numeric|max:99|min:0'
        ]);
        PriceIncrement::where('is_active', true)->update(['is_active' => false]);
        PriceIncrement::create([
            'percentage' => $request->percentage
        ]);
        return back()->with('success', 'Product price increment % added!');
    }
}