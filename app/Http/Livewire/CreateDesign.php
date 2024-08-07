<?php

namespace App\Http\Livewire;

use App\Mail\RedirectOrderEmail;
use Carbon\Carbon;
use App\Models\Kit;
use App\Models\Cart;
use App\Models\Line;
use App\Models\PriceIncrement;
use App\Models\Shape;
use App\Models\Remote;
use Livewire\Component;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class CreateDesign extends Component
{
    use WithFileUploads;

    public $adaptors = [
        "USA/Canada/120V",
        "UK/IRELAND 230V",
        "EUROPE 230V",
        "AUSTRALIA/NA 230V",
        "JAPAN 100V"
    ],$alignments = [
        "items-center",
        "items-start",
        "items-end"
    ],$locations = [
        "In Door",
        "Out Door (water proof)"
    ],$colors = [
        "rgb(252, 96, 2)",
        "rgb(255, 255, 255)",
        "rgb(251, 236, 186)",
        "rgb(237, 244, 27)",
        "rgb(252, 203, 2)",
        "rgb(255, 1, 1)",
        "rgb(255, 151, 188)",
        "rgb(247, 53, 199)",
        "rgb(179, 60, 255)",
        "rgb(0, 54, 255)",
        "rgb(1, 221, 255)",
        "rgb(30, 255, 0)"
    ],$fonts = [
        "amejo",
        "artelyinks",
        "bayshore",
        "bendungan",
        "beon",
        "billistone",
        "carbono",
        "cliquelly",
        "colon-mono",
        "daisy-chain",
        "garnet-script",
        "gotham",
        "greyton",
        "gruenewald",
        "highway",
        "love-malia",
        "magnolia",
        "market",
        "mikagi",
        "monly",
        "msmadi",
        "nevada",
        "palm-canyon",
        "panatype",
        "point-soft",
        "rename",
        "retro-signature",
        "rosemary",
        "sahur-bosku",
        "saltines",
        "sandstone",
        "sci-fied",
        "setting-fires",
        "starstoles-free",
        "suddenlydemo-jrn5a",
        "suddenly-regular",
        "torusbiline-bold",
        "torusbold",
        "violia-free",
        "wiretype",
        "yarorg"
    ], $kits, $adaptor, 
    $color, 
    $font,
    $location, $address, $direction;

    public $shapes, 
    $shape, 
    $email, 
    $lines, 
    $total_price = 0,
    $alignment,
    $line_price = 0, $increment = 0,
    $Select, $chars,
    $line1, $line2, $line3, $kit_price, $phone, $leading = 50, $size = 42;

    public $line_count = 0,
    $dark_mode = false,
    $backgroundImage;


    protected $rules = [
        'line1' => 'required',
        'address' => 'required|max:255',
        'shape' => 'required',
        'total_price' => 'required|numeric',
        'phone' => 'required|numeric',
        'alignment' => 'required',
        'color' => 'required',
        'font' => "required",
        'location' => 'required',
        'Select' => 'required',
        'email' => 'required|email',
    ];

    public function mount(){
        $this->shapes = Shape::all();
        $this->lines = Line::all();
        $increment = PriceIncrement::where('is_active', true)->first();
        $this->font = $this->fonts[16];
        $this->color = $this->colors[0];
        $this->direction = false;
        $this->increment = $increment->percentage;
        
        $this->location = $this->locations[0];
        $this->adaptor = $this->adaptors[0];
        $this->alignment = $this->alignments[0];
        $this->line1 = "Text Here";
        // $this->priceCalculator();
        if(isset($_COOKIE['myimageurl'])){
            if($_COOKIE['myimageurl']){
                $this->backgroundImage = $_COOKIE['myimageurl'];
            }
        }
    }

    public function render(){
        SEOMeta::setTitle("Create Custom Neon Signs | VitalNeon");
        SEOMeta::setDescription("Create a one-of-a-kind neon sign with VitalNeon's easy-to-use custom design tool. Our intuitive platform allows you to choose from a variety of fonts, colors, and sizes to create a personalized neon sign that reflects your unique style and personality. Whether you're looking to create a custom sign for your business, event, or home, our team of experienced designers and artisans will bring your vision to life with the highest quality materials and advanced techniques. With VitalNeon's custom neon sign creator, you have the power to create a truly unique and unforgettable piece. Start designing now and elevate any space with VitalNeon.");
        SEOMeta::setCanonical("https://vitalneon.com/create-design");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Create Custom Neon Signs | VitalNeon");
        OpenGraph::setDescription("Create a one-of-a-kind neon sign with VitalNeon's easy-to-use custom design tool. Our intuitive platform allows you to choose from a variety of fonts, colors, and sizes to create a personalized neon sign that reflects your unique style and personality. Whether you're looking to create a custom sign for your business, event, or home, our team of experienced designers and artisans will bring your vision to life with the highest quality materials and advanced techniques. With VitalNeon's custom neon sign creator, you have the power to create a truly unique and unforgettable piece. Start designing now and elevate any space with VitalNeon."); 
        OpenGraph::setUrl("https://vitalneon.com/create-design");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/create-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/create-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Create Custom Neon Signs | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/create-2.png");
        TwitterCard::setDescription("Create a one-of-a-kind neon sign with VitalNeon's easy-to-use custom design tool. Our intuitive platform allows you to choose from a variety of fonts, colors, and sizes to create a personalized neon sign that reflects your unique style and personality. Whether you're looking to create a custom sign for your business, event, or home, our team of experienced designers and artisans will bring your vision to life with the highest quality materials and advanced techniques. With VitalNeon's custom neon sign creator, you have the power to create a truly unique and unforgettable piece. Start designing now and elevate any space with VitalNeon.");

        JsonLd::setTitle("Create Custom Neon Signs | VitalNeon");
        JsonLd::setDescription("Create a one-of-a-kind neon sign with VitalNeon's easy-to-use custom design tool. Our intuitive platform allows you to choose from a variety of fonts, colors, and sizes to create a personalized neon sign that reflects your unique style and personality. Whether you're looking to create a custom sign for your business, event, or home, our team of experienced designers and artisans will bring your vision to life with the highest quality materials and advanced techniques. With VitalNeon's custom neon sign creator, you have the power to create a truly unique and unforgettable piece. Start designing now and elevate any space with VitalNeon.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/create-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/create-1.png", ["height" => 400, "width" => 760]);

        return view('livewire.create-design');
    }

    public function updated(){
        if(isset($_COOKIE['myimageurl'])){
            if($_COOKIE['myimageurl']){
                $this->backgroundImage = $_COOKIE['myimageurl'];
            }
        }
    }

    public function checkUpdate(){
        $this->priceCalculator();
        $this->updatedline1();
        $this->updatedline2();
        $this->updatedline3();
    }

    public function updatedshape(){
        $this->checkUpdate();
    }
    public function updatedlocation(){
        $this->checkUpdate();
    }

    public function updatedSelect(){
        if($this->Select == "custom"){
            return redirect("https://wa.me/16476165799");
        }
        $lines = Line::where("name", $this->Select)->first();
        if($lines != null){
            $this->line_count = $lines->lines;
            $this->chars = $lines->chars;
            $this->line_price = $lines->price;
            if($this->line_count == 1){
                $this->line2 = "";
                $this->line3 = "";
            }else if($this->line_count == 2){
                $this->line3 = "";
            }
            $this->updatedline1();
            $this->updatedline2();
            $this->updatedline3();
            $this->priceCalculator();
        }else{
            $this->line_count = 0;
            $this->line_price = 0;
            $this->line1 = "";
            $this->priceCalculator();
        }
    }

    public function updatedline1(){
        if(strlen($this->line1) > $this->chars){
            session()->flash('lineCount1', 'Line must have only '. $this->chars. " characters");
        }elseif(strlen($this->line1) == 0){
            session()->flash('lineCount1', 'Line must have atleast 1 character');
        }
    }
    public function updatedline2(){
        if(strlen($this->line2) > $this->chars){
            session()->flash('lineCount2', 'Line must have only '. $this->chars. " character");
        }elseif(strlen($this->line2) == 0){
            session()->flash('lineCount2', 'Line must have atleast 1 character');
        }
    }
    public function updatedline3(){
        if(strlen($this->line3) > $this->chars){
            session()->flash('lineCount3', 'Line must have only '. $this->chars. " characters");
        }elseif(strlen($this->line3) == 0){
            session()->flash('lineCount3', 'Line must have atleast 1 character');
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


    public function priceCalculator(){
        $price_increments = PriceIncrement::where("is_active", true)->first();

        $total_price = $this->line_price;

        if($this->location == "Out Door (water proof)"){
            $sub_total = $total_price + ($total_price * ($price_increments->percentage/100));
            $this->total_price = ($total_price * (20/100)) + $sub_total;

        }else{
            $this->total_price = $total_price + ($total_price * ($price_increments->percentage/100)) ;
        }
    }

    public function checkout(){
        $this->validate();
        if($this->line_count == 1){
            $this->validate([
                'line1' => 'required|min:1|max:'.$this->chars,
            ]);
        }
        if($this->line_count == 2){
            $this->validate([
                'line1' => 'required|min:1|max:'.$this->chars,
                'line2' => 'required|min:1|max:'.$this->chars,
            ]);
        }
        if($this->line_count == 3){
            $this->validate([
                'line1' => 'required|min:1|max:'.$this->chars,
                'line2' => 'required|min:1|max:'.$this->chars,
                'line3' => 'required|min:1|max:'.$this->chars
            ]);
        }
        
        $checkout_id = $this->randomPassword();
            $order_id = $this->randomPassword();
            $stripe = new StripeClient(config('app.stripe'));
            $checkout = $stripe->checkout->sessions->create([
                'success_url' => config('app.url')."/success/".$checkout_id,
                'cancel_url' => config('app.url')."/cancel/".$checkout_id,
                'currency' => "USD",
                'billing_address_collection' => 'required',
                'expires_at' => Carbon::now()->addMinutes(60)->timestamp,
                'line_items' => [ 
                    [
                        'price_data' => [
                                "product" => config('app.product_id'),
                                "currency" => 'USD',
                                "unit_amount" =>  $this->total_price * 100,
                            ], 
                        'quantity' => 1 
                    ]
                ],
                'mode' => 'payment',
            ]);
            Cart::create([
                'text' => $this->line1.'|'.$this->line2.'|'.$this->line3,
                'jacket' => "None",
                'font' => "$this->font",
                'color' => "$this->color",
                'backboard' => $this->shape,
                'location' => $this->location,
                'adaptor' => "Free",
                'remote' => "Free",
                'align' => $this->alignment,
                'address' => $this->address,
                'email' => $this->email,
                'phone' => $this->phone,
                'kit' => "Free",
                'order_id' => $order_id,
                'price' => $this->total_price,
                'price_id' => $checkout['id'],
                'checkout_id' => $checkout_id
            ]);
            $content = "**Email:** $this->email\n"
            . "**PhoneNumber:** $this->phone\n"
            . "**CheckoutID:** $checkout_id\n"
            . "**TotalPrice:** $$this->total_price\n"
            . "**Characters:** $this->chars\n"
            . "**Lines:** $this->line_count\n"
            . "**LinePrice:** $$this->line_price\n"
            . "**Line 1:** $this->line1|$this->font|$this->color\n"
            . "**Line 2:** $this->line2|$this->font|$this->color\n"
            . "**Line 3:** $this->line3|$this->font|$this->color\n"
            . "**Backboard:** $this->shape\n"
            . "**Location:** $this->location\n"
            . "**Alignment:** $this->alignment\n"
            . "**PriceID:** {$checkout['id']}\n"
            . "**Address:** $this->address\n"
            . "**CheckoutURL:** {$checkout['url']}";
            
            Http::post(config('app.order-pending'), [
                'content' => $content
            ]);

            Mail::to(config('app.redirect_email'))->send(new RedirectOrderEmail($content));
            
            return redirect($checkout['url']);
    }
}