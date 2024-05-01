<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderConfirm;
use App\Models\LightBoxOrder;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function cancel($cart){
        $cart = Cart::where('checkout_id', $cart)->first();
        if($cart){
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
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function success($cart){
        $cart = Cart::where('checkout_id', $cart)->first();
        if($cart){
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
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function cancelOrder($checkout){
        $order = Order::where('checkout_id', $checkout)->get();
        if($order[0]->status == 'pending'){
            Order::where('checkout_id', $checkout)->update(['status' => 'canceled']);
            Http::post(config('app.order-cancel'), [
                'content' => "**OrderID**: $checkout has been cancelled."
            ]);
            return view('cancel');
        }else{
            abort(500, 'Internal Server Error!');
        }
    }

    public function successOrder($checkout){
        $order = Order::where('checkout_id', $checkout)->get();
        if($order[0]->status == 'pending'){
            Order::where('checkout_id', $checkout)->update(['status' => 'success']);
            $totalPrice = 0;
            foreach ($order as $item) {
                $totalPrice += $item->price;
            }
            Http::post(config('app.order-complete'), [
                'content' => "**OrderID**: $checkout has been Completed & Paid."
            ]);
            Mail::to($order[0]->address->email)->send(new OrderConfirm([$checkout, $totalPrice]));
            return view('success', [
                'order_id' => $checkout
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

    public function orderUpdate(Request $request, $checkout_id){
        Order::where('checkout_id', $checkout_id)->update(['shipping' => $request->shipping]);
        return back()->with('success', 'Order shipping status changed!');
    }



    public function lamp_order_cancel(LightBoxOrder $lightbox){
        if($lightbox->status == 'pending'){
            $lightbox->status = 'canceled';
            $lightbox->save();
            Http::post(config('app.order-cancel'), [
                'content' => "Lamp - **OrderID**: $lightbox->checkout_id has been cancelled."
            ]);
            return view('cancel');
        }else{
            abort(500, 'Internal Server Error!');
        }
    }
    public function lamp_order_success(LightBoxOrder $lightbox){
        if($lightbox->status == 'pending'){
            $lightbox->status = 'paid';
            $lightbox->is_paid = true;
            $lightbox->save();
            Http::post(config('app.order-complete'), [
                'content' => "Lamp - **OrderID**: $lightbox->checkout_id has been Completed & Paid."
            ]);
            return view('success', [
                'order_id' => $lightbox->checkout_id
            ]);
        }else{
            abort(500, 'Internal Server Error!');
        }
    }
}