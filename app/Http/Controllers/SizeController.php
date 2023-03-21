<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(){
        return view('size', [
            'sizes' => Size::latest()->get()
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'size' => "required|max:255|unique:sizes,size",
            'width' => "required|numeric|min:1",
            'height' => "required|numeric|min:1",
            'price' => "required|numeric|min:1",
        ]);
        Size::create([
            'size' => $request->size,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price
        ]);
        return back()->with('success', 'Size has been added!');
    }
}
