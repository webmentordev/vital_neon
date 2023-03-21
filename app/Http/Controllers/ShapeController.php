<?php

namespace App\Http\Controllers;

use App\Models\Shape;
use Illuminate\Http\Request;

class ShapeController extends Controller
{
    public function index(){
        return view('shape', [
            'shapes' => Shape::latest()->get()
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'shape' => "required|max:255|unique:shapes,shape",
            'price' => "required|numeric|min:1",
            'description' => "required|max:360",
        ]);
        Shape::create([
            'shape' => $request->shape,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return back()->with('success', 'Shape has been added!');
    }
}