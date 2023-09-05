<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderConfirm;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function cancel($cart){
        $cart = Cart::where('checkout_id', $cart)->first();
        if($cart->status == 'pending'){
            $cart->status = 'canceled';
            $cart->save();
            Http::post(config('app.product-cancel'), [
                'content' => "Custom Design **OrderID**: $cart->order_id worth of $$cart->price has been cancelled."
            ]);
            return view('cancel');
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function success($cart){
        $cart = Cart::where('checkout_id', $cart)->first();
        if($cart->status == 'pending'){
            $cart->status = 'success';
            $cart->paid = 1;
            $cart->save();
            Http::post(config('app.product-complete'), [
                'content' => "Custom Design **OrderID**: $cart->order_id worth of $$cart->price has been paid."
            ]);
            Mail::to($cart->email)->send(new OrderConfirm([$cart->order_id, $cart->price]));
            return view('success', [
                'order_id' => $cart->order_id
            ]);
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function cancelOrder(Order $order){
        if($order->status == 'pending'){
            $order->status = 'canceled';
            $order->save();
            Http::post(config('app.order-cancel'), [
                'content' => "**OrderID**: $order->checkout_id has been cancelled."
            ]);
            return view('cancel');
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function successOrder(Order $order){
        if($order->status == 'pending'){
            $order->status = 'success';
            $order->save();
            Http::post(config('app.order-complete'), [
                'content' => "**OrderID**: $order->checkout_id has been Completed & Paid."
            ]);
            Mail::to($order->email)->send(new OrderConfirm([$order->checkout_id, $order->price]));
            return view('success', [
                'order_id' => $order->checkout_id
            ]);
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function orders(){
        SEOMeta::setTitle("Orders Listing");
        return view('orders-data', [
            'orders' => Order::latest()->paginate(50)
        ]);
    }
}