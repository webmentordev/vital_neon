<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function cancel($id){
        $order = Cart::where('checkout_id', $id)->first();
        if($order != null && $order->status == 'pending'){
            $order->status = 'canceled';
            $order->save();
            return view('cancel');
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function success($id){
        $order = Cart::where('checkout_id', $id)->first();
        if($order != null && $order->status == 'pending'){
            $order->status = 'success';
            $order->save();
            return view('success', [
                'order_id' => $order->order_id
            ]);
        }else{
            abort(500, 'Internal Server Error!');
        }
    }
}
