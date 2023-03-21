<?php

namespace App\Http\Controllers;

use App\Models\Remote;
use Illuminate\Http\Request;

class RemoteController extends Controller
{
    public function index(){
        return view('remote', [
            'remotes' => Remote::latest()->get()
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'type' => "required|max:255|unique:remotes,type",
            'price' => "required|numeric|min:1",
        ]);
        Remote::create([
            'type' => $request->type,
            'price' => $request->price
        ]);
        return back()->with('success', 'Remote has been added!');
    }
}