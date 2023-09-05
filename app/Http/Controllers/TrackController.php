<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index(){
        return view('track-order', [
            'order' => null
        ]);
    }
    public function search(Request $request){
        $result = Order::where('checkout_id', $request->order)->first();
        if($result){
            if($result->status != 'canceled'){
                return view('track-order', [
                    'order' => $result
                ]);
            }else{
                return view('track-order', [
                    'order' => null
                ]);
            }
        }else{
            return back();
        }
    }
}