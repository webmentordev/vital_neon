<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Remote;
use Livewire\Component;
use Stripe\StripeClient;
use App\Models\CategoryPrice;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use App\Models\Product as ModelsProduct;

class Product extends Component
{
    public $product, $remote, $categories, $location, $adaptor, $category, $email;
    public $adaptors = [
        "USA/Canada/120V",
        "UK/IRELAND 230V",
        "EUROPE 230V",
        "AUSTRALIA/NA 230V",
        "JAPAN 100V"
    ],$locations = [
        "In Door",
        "Out Door"
    ], $remotes, $total_price = 0, $category_price;

    protected $rules = [
        'remote' => 'required',
        'adaptor' => 'required',
        'location' => 'required',
        'email' => 'required|email',
    ];

    public function mount($slug){
        $result = ModelsProduct::where('slug', $slug)->with('categories')->get();
        if(count($result)){
            $this->remotes = Remote::all();
            $this->remote = $this->remotes[0]->type;
            $this->categories = $result[0]->categories;
            $this->location = $this->locations[0];
            $this->adaptor = $this->adaptors[0];
            $this->category_price = $result[0]->categories[0]->price;
            $this->product = $result;
            $this->priceCalculator();
        }else{
            abort(404, 'Not Found');
        }
    }

    public function updated(){
        foreach($this->categories as $category){
            if($this->category == $category->name){
                $this->category_price = $category->price;
            }
        }
        $this->priceCalculator();
    }

    public function render()
    {
        return view('livewire.product');
    }

    public function priceCalculator(){
        $result = Remote::where('type', $this->remote)->first();
        if($result != null){
            $total_price = $this->category_price + $result->price;
            if(in_array($this->location, $this->locations)){
                if($this->location == "Out Door"){
                    $this->total_price = $total_price + ($total_price * (15/100));
                }else{
                    $this->total_price = $total_price;
                }
            }else{
                abort(500, 'Internal Error');
            }
        }else{
            abort(500, 'Internal Error');
        }
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function checkout(){
        $this->validate();
        $this->priceCalculator();
        if($this->total_price > 0){
            $checkout_id = $this->randomPassword();
            $order_id = $this->randomPassword();
            $stripe = new StripeClient(config('app.stripe'));
            $result = $stripe->prices->create([
                'unit_amount' => $this->total_price * 100,
                'currency' => 'USD',
                'product' => $this->product[0]->stripe_id,
            ]);
            $checkout = $stripe->checkout->sessions->create([
                'success_url' => config('app.url')."/success/".$checkout_id,
                'cancel_url' => config('app.url')."/cancel/".$checkout_id,
                'currency' => "USD",
                'billing_address_collection' => 'required',
                'expires_at' => Carbon::now()->addMinutes(60)->timestamp,
                'line_items' => [
                    [
                        'price' => $result['id'],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
            ]);
            Order::create([
                'product_id' => $this->product[0]->id,
                'location' => $this->location,
                'adaptor' => $this->adaptor,
                'remote' => $this->remote,
                'email' => $this->email,
                'order_id' => $order_id,
                'price' => $this->total_price,
                'price_id' => $result['id'],
                'checkout_id' => $checkout_id,
                'stripe_product' => $this->product[0]->stripe_id,
                'checkout_url' => $checkout['url']
            ]);
            Http::post(config('app.product-pending'), [
                'content' => "**ProductName**: {$this->product[0]->name}\n**ProductID**: {$this->product[0]->id}\n**Price**: $this->total_price\n**Email**: $this->email\n**Location**: $this->location\n**Adaptor**: $this->adaptor\n**Remote**: $this->remote\n**OrderID**: $order_id\n**PriceID**: {$result['id']}\n**StripeID**: {$this->product[0]->stripe_id}\n**StripeURL**: {$checkout['url']}\n"
            ]);
            return redirect($checkout['url']);

        }else{
            abort(500, 'Internal Error');
        }
    }
}