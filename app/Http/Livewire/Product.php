<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kit;
use App\Models\Order;
use App\Models\Remote;
use Livewire\Component;
use Stripe\StripeClient;
use App\Mail\RedirectOrderEmail;
use App\Models\PriceIncrement;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Product as ModelsProduct;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class Product extends Component
{
    public $product, $remote, $kits, $kit, $kit_price, $shapes, $categories, $adaptor, $category;
    public $adaptors = [
        "USA/Canada",
        "UK/IRELAND",
        "EUROPE",
        "AUSTRALIA/NA",
        "JAPAN"
    ], $remotes, $total_price = 0, $increment = 0, $category_price;

    protected $rules = [
        'remote' => 'required',
        'remote' => 'required',
        'adaptor' => 'required',
        'kit' => 'required',
        'category' => 'required'
    ];

    public $colors = [
        "Same As Image",
        "Warm White",
        "Cool White",
        "Lemon Yellow",
        "Gold Yellow",
        "Orange",
        "Dark Blue",
        "Ice Blue",
        "Green",
        "Hot Pink",
        "Red",
        "Purple",
        "Real",
        "RGB",
    ], $color_selected;

    public function mount($slug){
        $result = ModelsProduct::where('slug', $slug)->with('categories')->get();
        if(count($result)){
            $this->remotes = Remote::all();
            $this->kits = Kit::all();
            $increment = PriceIncrement::where('is_active', true)->first();
            $this->remote = $this->remotes[0]->type;
            $this->categories = $result[0]->categories;
            $this->adaptor = $this->adaptors[0];
            $this->kit = $this->kits[0]->name;
            $this->category_price = 0;
            $this->product = $result;
            $this->increment = $increment->percentage;
            $this->color_selected = $this->colors[0];
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
            OpenGraph::addImage("https://vitalneon.com/storage/".$result[0]->image, ["height" => 630, "width" => 630]);

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
        $total = PriceIncrement::where("is_active", true)->first();
        if($kit_price == null){
            abort(500, "Internal Server Error");
        }
        if($result != null){
            $sub_total = $this->category_price + $result->price + $kit_price->price;
            $total_price = $sub_total + ($sub_total * ($total->percentage/100));
            if($this->color_selected == "RGB"){
                $this->total_price = $total_price + 50;
            }else{
                $this->total_price = $total_price;
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
            'details' => $this->kit."—".$this->category."—".$this->remote."—".$this->adaptor."—".$this->color_selected
        ];
        session()->put('cart', $cartItems);
        session()->flash('success', 'Added to the cart!');
        $this->emit('cartCheck');
        $this->emit('addToCart');
    }
}