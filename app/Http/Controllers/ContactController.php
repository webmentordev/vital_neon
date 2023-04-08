<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('contacts', [
            'contacts' => Support::latest()->get()
        ]);
    }
}
