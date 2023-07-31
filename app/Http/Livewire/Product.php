<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Remote;
use Livewire\Component;
use Stripe\StripeClient;
use App\Models\CategoryPrice;
use App\Models\Kit;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use App\Models\Product as ModelsProduct;
use App\Models\Shape;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class Product extends Component
{
    public $product, $remote, $kits, $kit, $kit_price, $shapes, $phone, $categories, $location, $adaptor, $category, $email;
    public $adaptors = [
        "USA/Canada/120V",
        "UK/IRELAND 230V",
        "EUROPE 230V",
        "AUSTRALIA/NA 230V",
        "JAPAN 100V"
    ], $remotes, $total_price = 0, $category_price;

    protected $rules = [
        'remote' => 'required',
        'adaptor' => 'required',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'kit' => 'required',
    ];

    public function mount($slug){
        $result = ModelsProduct::where('slug', $slug)->with('categories')->get();
        if(count($result)){
            $this->remotes = Remote::all();
            $this->kits = Kit::all();
            $this->remote = $this->remotes[0]->type;
            $this->categories = $result[0]->categories;
            $this->adaptor = $this->adaptors[0];
            $this->kit = $this->kits[0]->name;
            $this->category_price = $result[0]->categories[0]->price;
            $this->product = $result;
            $this->priceCalculator();

            SEOMeta::setTitle($result[0]->name);
            SEOMeta::setDescription($result[0]->description);
            SEOMeta::setCanonical("https://vitalneon.com/".$result[0]->slug);
            SEOMeta::setRobots("index, follow");
            SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
            SEOMeta::addMeta("application-name", "VitalNeon");

            OpenGraph::setTitle($result[0]->name);
            OpenGraph::setDescription($result[0]->description); 
            OpenGraph::setUrl("https://vitalneon.com/".$result[0]->slug);
            OpenGraph::addProperty("type", "website");
            OpenGraph::addProperty("locale", "eu");
            OpenGraph::addImage("https://vitalneon.com/storage/".$result[0]->image);
            OpenGraph::addImage("https://vitalneon.com/storage/".$result[0]->image, ["height" => 400, "width" => 760]);

            TwitterCard::setTitle($result[0]->name);
            TwitterCard::setSite("@vitalneon");
            TwitterCard::setImage("https://vitalneon.com/storage/".$result[0]->image);
            TwitterCard::setDescription($result[0]->description);

            JsonLd::setTitle($result[0]->name);
            JsonLd::setDescription($result[0]->description);
            JsonLd::addImage("https://vitalneon.com/storage/".$result[0]->image);
            JsonLd::setType("WebSite");
            JsonLd::addImage("https://vitalneon.com/storage/".$result[0]->image, ["height" => 400, "width" => 760]);
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

    public function updatedcategory(){
        if($this->category == "custom"){
            return redirect("https://wa.me/16476165799");
        }
    }
    
    public function priceCalculator(){
        $result = Remote::where('type', $this->remote)->first();
        $kit_price = Kit::where("name", $this->kit)->first();
        if($kit_price == null){
            abort(500, "Internal Server Error");
        }
        if($result != null){
            $this->total_price = $this->category_price + $result->price + $kit_price->price;
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
                'success_url' => config('app.url')."/success-order/".$checkout_id,
                'cancel_url' => config('app.url')."/cancel-order/".$checkout_id,
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
                'adaptor' => $this->adaptor,
                'remote' => $this->remote,
                'email' => $this->email,
                'order_id' => $order_id,
                'kit' => $this->kit,
                'price' => $this->total_price,
                'price_id' => $result['id'],
                'checkout_id' => $checkout_id,
                'stripe_product' => $this->product[0]->stripe_id,
                'checkout_url' => $checkout['url'],
                'phone' => $this->phone
            ]);
            Http::post(config('app.product-pending'), [
                'content' => "**ProductName**: {$this->product[0]->name}\n**ProductID**: {$this->product[0]->id}\n**Phone**: $this->phone\n**Kit**: $this->kit\n**Price**: $$this->total_price\n**Email**: $this->email\n**Adaptor**: $this->adaptor\n**Remote**: $this->remote\n**OrderID**: $order_id\n**PriceID**: {$result['id']}\n**StripeID**: {$this->product[0]->stripe_id}\n**StripeURL**: {$checkout['url']}\n"
            ]);
            return redirect($checkout['url']);

        }else{
            abort(500, 'Internal Error');
        }
    }
}