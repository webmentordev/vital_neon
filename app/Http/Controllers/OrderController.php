<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function cancelOrder($id){
        $order = Order::where('checkout_id', $id)->first();
        if($order != null && $order->status == 'pending'){
            $order->status = 'canceled';
            $order->save();
            Http::post(config('app.product-cancel'), [
                'content' => "**OrderID**: $id worth of $$order->price has been cancelled. "
            ]);
            return view('cancel');
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function successOrder($id){
        $order = Order::where('checkout_id', $id)->first();
        if($order != null && $order->status == 'pending'){
            $order->status = 'success';
            $order->save();
            Http::post(config('app.product-complete'), [
                'content' => "**OrderID**: $id worth of $$order->price has been Completed & Paid. "
            ]);
            return view('success', [
                'order_id' => $order->order_id
            ]);
        }else{
            abort(500, 'Internal Server Error!');
        }
    }
}