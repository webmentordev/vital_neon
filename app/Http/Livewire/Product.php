<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kit;
use App\Models\Order;
use App\Models\Remote;
use App\Models\Address;
use Livewire\Component;
use Stripe\StripeClient;
use App\Mail\OrderPlaced;
use App\Models\PriceIncrement;
use App\Mail\RedirectOrderEmail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Product as ModelsProduct;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class Product extends Component
{
    public $product, $categories, $category, $email;
    public $setting = "purchase";
    public $total_price = 0, $increment = 0, $category_price;

    public $colors = [
        "#FBF1B6",
        "#ffffff",
        "#FBF64F",
        "#FDD630",
        "#F98802",
        "#0202DC",
        "#90DCFD",
        "#07E54F",
        "#FB30E5",
        "#F3031C",
        "#A302DE",
        "#80F9D6"
    ], $color_selected;

    protected $rules = [
        'category' => 'required',
        'color_selected' => 'required',
        'email' => 'required|email|max:255'
    ];

    public function mount($slug){
        $result = ModelsProduct::where('slug', $slug)->with(['categories', 'category'])->get();
        if(count($result)){
            $increment = PriceIncrement::where('is_active', true)->first();
            $this->categories = $result[0]->categories;
            $this->category_price = 0;
            $this->product = $result;
            $this->increment = $increment->percentage;
            $this->priceCalculator();

            SEOMeta::setTitle($result[0]->name);
            SEOMeta::setDescription($result[0]->description);
            SEOMeta::setCanonical("https://vitalneon.com/product/".$result[0]->slug);
            SEOMeta::setRobots("index, follow");
            SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
            SEOMeta::addMeta("application-name", "VitalNeon");

            OpenGraph::setTitle($result[0]->name);
            OpenGraph::setDescription($result[0]->description); 
            OpenGraph::setUrl("https://vitalneon.com/product/".$result[0]->slug);
            OpenGraph::addProperty("type", "website");
            OpenGraph::addProperty("locale", "eu");
            OpenGraph::addImage("https://vitalneon.com/storage/".$result[0]->image, ["height" => 630, "width" => 630]);
            OpenGraph::addProperty('product:price:amount', $result[0]->categories[0]->price);
            OpenGraph::addProperty('product:price:currency', 'USD');

            TwitterCard::setTitle($result[0]->name);
            TwitterCard::setSite("@vitalneon");
            TwitterCard::setImage("https://vitalneon.com/storage/".$result[0]->image);
            TwitterCard::setDescription($result[0]->description);

            JsonLd::setTitle($result[0]->name);
            JsonLd::setDescription($result[0]->description);
            JsonLd::setType("WebSite");
            JsonLd::addImage("https://vitalneon.com/storage/".$result[0]->image, ["height" => 630, "width" => 630]);
        }else{
            abort(404, 'Not Found');
        }
    }

    public function render()
    {
        return view('livewire.product');
    }

    public function updatedcategory(){
        foreach($this->categories as $category){
            if($this->category == $category->name){
                $this->category_price = $category->price;
            }
        }
        if($this->category == "custom"){
            return redirect("https://wa.me/16476165799");
        }
        $this->priceCalculator();
    }

    public function priceCalculator(){
        $total = PriceIncrement::where("is_active", true)->first();
        $sub_total = $this->category_price;
        $total_price = $sub_total + ($sub_total * ($total->percentage/100));
        $this->total_price = $total_price;
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

    public function addToCart($slug){
        $this->validate();
        $this->priceCalculator();
        $cartItems = session()->get('cart');
        $cartItems[$slug] = [
            'quantity' => 1,
            'price' => $this->total_price,
            'product_id' => $this->product[0]->stripe_id,
            'slug' => $slug,
            'name' => $this->product[0]->name,
            'color' => $this->color_selected,
            'image' => config('app.url').'/storage/'.$this->product[0]->image,
            'details' => "Color: ".$this->color_selected
        ];
        session()->put('cart', $cartItems);
        session()->flash('success', 'Added to the cart!');
        $this->emit('cartCheck');
        $this->emit('addToCart');
    }

    public function randomCheckout() {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 20; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }


    public function clickPay(){
        $this->validate();
        $checkout = $this->randomCheckout();
        $this->priceCalculator();
        $address = Address::create([
            'name' => "Check Stripe",
            'address' => "Check Stripe",
            'number' => 312331231231231,
            'email' => $this->email,
            'checkout_id' => $checkout
        ]);

        $stripe = new StripeClient(config('app.stripe'));
        
        Order::create([
            'quantity' => 1,
            'price' => $this->total_price,
            'slug' => $this->product[0]->slug,
            'name' => $this->product[0]->name,
            'color' => $this->color_selected,
            'details' => "Color: ".$this->color_selected,
            "checkout_id" => $checkout,
            "address_id" => $address->id
        ]);

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => config('app.url').'/success-order/'.$checkout,
            'cancel_url' => config('app.url').'/cancel-order/'.$checkout,
            'currency' => "USD",
            'billing_address_collection' => 'required',
            'expires_at' => Carbon::now()->addMinutes(360)->timestamp,
            'line_items' => [
                    [ 
                        'price_data' => [
                        "product" => $this->product[0]->stripe_id,
                        "currency" => 'USD',
                        "unit_amount" =>  $this->total_price * 100,
                    ], 
                'quantity' => 1 
                ],
            ],
            'mode' => 'payment'
        ]);
        $content = "Direct order placed:**Details:** {$checkout['url']}";
        
        Http::post(config('app.product-pending'), [
            'content' => $content
        ]);
        Mail::to($this->email)->send(new OrderPlaced($checkout['url']));
        return redirect($checkout['url']);
    }
}