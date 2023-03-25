<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;

class LineController extends Controller
{
    public function index(){
        return view('line', [
            'lines' => Line::latest()->get()
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => "required|max:255|unique:lines,name",
            'price' => "required|numeric|min:1",
            'lines' => "required|numeric|min:1|max:3",
            'chars' => "required|numeric",
        ]);

        Line::create([
            'name' => $request->name,
            'price' => $request->price,
            'lines' => $request->lines,
            'chars' => $request->chars,
        ]);
        return back()->with('success', 'Line Info added!');
    }
}