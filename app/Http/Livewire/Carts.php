<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Http;

class Carts extends Component
{
    public $total_price = 0;
    public $f_name, $l_name, $address, $number, $email;

    protected $rules = [
        "f_name" => 'required',
        "l_name" => 'required',
        "address" => 'required',
        "number" => 'required|numeric',
        "email" => 'required|email'
    ];

    public function mount(){
        $carts = session()->get('cart');
        if($carts != null){
            foreach($carts as $cart){
                $this->total_price+= $cart['price'];
            }
        }
    }
    public function render()
    {
        return view('livewire.carts', [
            'carts' => session()->get('cart')
        ]);
    }

    public function updated(){
        $this->price_check();
    }

    public function emptyCart(){
        session(['cart' => []]);
        $this->total_price = 0;
        $this->emit('cartCheck');
    }

    public function removeItem($slug){
        $carts = session()->get('cart');
        if (array_key_exists($slug, $carts)) {
            unset($carts[$slug]);
            session(['cart' => $carts]);
            $this->price_check();
            session()->flash('success', 'Product has been removed!');
            $this->emit('cartCheck');
        }
    }

    public function price_check(){
        $carts = session()->get('cart');
        $this->total_price = 0;
        if($carts != null && count($carts)){
            foreach($carts as $cart){
                $this->total_price+= $cart['price'];
            }
        }
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 20; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function checkout(){
        $this->validate();
        $carts = session()->get('cart');
        $checkout_array = [];
        if(count($carts) > 0){
            $checkout = $this->randomPassword();
            $address = Address::create([
                'name' => $this->f_name." ".$this->l_name,
                'address' => $this->address,
                'number' => $this->number,
                'email' => $this->email,
                'checkout_id' => $checkout
            ]);

            foreach($carts as $cart){
                $stripe = new StripeClient(config('app.stripe'));
                $order = Order::create([
                    "quantity" => $cart['quantity'],
                    "price" => $cart['price'],
                    "slug" => $cart['slug'],
                    "name" => $cart['name'],
                    "details" => $cart['details'],
                    "address_id" => $address->id,
                    "checkout_id" => $checkout
                ]);
                array_push($checkout_array, [ 'price_data' => [
                    "product" => $cart['product_id'],
                    "currency" => 'USD',
                    "unit_amount" =>  $cart['price'] * 100,
                ], 'quantity' => $order->quantity ]);
            }

            $checkout = $stripe->checkout->sessions->create([
                'success_url' => config('app.url').'/success-order/'.$checkout,
                'cancel_url' => config('app.url').'/cancel-order/'.$checkout,
                'currency' => "USD",
                'billing_address_collection' => 'required',
                'expires_at' => Carbon::now()->addMinutes(60)->timestamp,
                'line_items' => $checkout_array,
                'mode' => 'payment'
            ]);
            $content = "**Email:** $this->email\n"
            . "**Name:** $this->f_name"." $this->l_name\n"
            . "**Email:** $this->email\n"
            . "**Address:** $this->address\n"
            . "**Details:** {$checkout['url']}";
            
            Http::post(config('app.product-pending'), [
                'content' => $content
            ]);
            session(['cart' => []]);
            $this->emit('cartCheck');
            return redirect($checkout['url']);
        }
    }
}