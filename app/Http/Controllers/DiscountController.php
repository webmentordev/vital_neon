<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index(){
        $discounts = DB::table('discounts')->latest()->get();
        return view('discount', [
            'discounts' => $discounts
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'discount' => 'required|numeric|max:99|min:0'
        ]);
        DB::table('discounts')->insert([
            'discount' => $request->discount
        ]);
        return back()->with('success', 'Price discount has been added!');
    }

    public function delete($id){
        DB::table('discounts')->where('id', $id)->delete();
        return back()->with('success', 'Price discount deleted!');
    }
}