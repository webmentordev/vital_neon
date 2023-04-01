<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index(){
        return view('design');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|max:255',
            'message' => 'required',
            'name' => 'required|max:255',
            'image' => 'required|mimes:png,jpg,gif,pdf,jpeg,svg,webp|max:2048',
        ]);

        Design::create([
            'email' => $request->email,
            'message' => $request->message,
            'name' => $request->name,
            'image' => $request->image->store('designs', 'public_disk')
        ]);

        return back()->with('success', 'File uploaded. we will send you the quote in few hours');
    }
}
