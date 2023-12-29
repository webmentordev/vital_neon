<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function index(){
        return view('send-email');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|max:255',
            'subject' => 'required|max:255',
            'content' => 'required',
        ]);

        Mail::to($request->email)->send(new SendEmail($request));

        return back()->with('success', 'Email has been sent!');
    }


    public function preview(){
        return view('email-preview');
    }

    public function show(Request $request){
        $this->validate($request, [
            'subject' => 'required|max:255',
            'content' => 'required',
        ]);
        return new SendEmail($request);
    }
}