<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $result = Design::create([
            'email' => $request->email,
            'message' => $request->message,
            'name' => $request->name,
            'image' => $request->image->store('designs', 'public_disk')
        ]);
        Http::post(config('app.design'), [
            'content' => "**Email:** $result->email\n**Name:** $result->name\n**Message:** $result->message\n**Image:** https://vitalneon/storage/$result->image"
        ]);
        return back()->with('success', 'File uploaded. we will send you the quote in few hours');
    }
}