<?php

namespace App\Http\Livewire;

use App\Mail\RedirectOrderEmail;
use Carbon\Carbon;
use App\Models\Kit;
use App\Models\Cart;
use App\Models\Line;
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
    ],$jackets = [
        "colored",
        "white"
    ],$locations = [
        "In Door",
        "Out Door"
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
    $color,$color2, $color3, 
    $font, $font2, $font3,
    $location,
    $kit, $address, $direction;

    public $shapes, 
    $shape, 
    $email, 
    $remotes, 
    $remote, 
    $lines, 
    $total_price,
    $alignment,
    $line_price,
    $Select, $chars,
    $line1, $line2, $line3, $kit_price, $phone,
    $jacket, $leading = 50, $size = 42;

    public $line_count = 1,
    $dark_mode = false,
    $backgroundImage;


    protected $rules = [
        'line1' => 'required',
        'address' => 'required|max:255',
        'shape' => 'required',
        'remote' => 'required',
        'total_price' => 'required|numeric',
        'phone' => 'required|numeric',
        'alignment' => 'required',
        'color' => 'required',
        'font' => "required",
        'adaptor' => 'required',
        'location' => 'required',
        'kit' => 'required',
        'email' => 'required|email',
    ];

    public function mount(){
        $this->shapes = Shape::all();
        $this->remotes = Remote::all();
        $this->lines = Line::all();
        $this->kits = Kit::all();
        $this->chars = $this->lines[0]->chars;
        $this->font = $this->fonts[16];
        $this->color = $this->colors[0];
        $this->direction = false;

        $this->font2 = $this->fonts[0];
        $this->color2 = $this->colors[0];

        $this->font3 = $this->fonts[0];
        $this->color3 = $this->colors[0];

        $this->location = $this->locations[0];
        $this->adaptor = $this->adaptors[0];
        $this->alignment = $this->alignments[0];
        $this->jacket = $this->jackets[0];
        $this->remote = $this->remotes[0]->type;
        $this->shape = $this->shapes[0]->shape;
        $this->line_price = $this->lines[0]->price;
        $this->line1 = "Text Here";
        $this->kit = $this->kits[0]->name;
        $this->kit_price = $this->kits[0]->price;
        $this->priceCalculator();
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
    public function updatedremote(){
        $this->checkUpdate();
    }
    public function updatedkit(){
        $this->checkUpdate();
    }
    public function updatedjacket(){
        $this->checkUpdate();
    }

    public function updatedSelect(){
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
            abort(500, "Internal Server Error");
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

    public function arraycheck(){
        if(in_array($this->font, $this->fonts) && in_array($this->jacket, $this->jackets) && in_array($this->color, $this->colors) && in_array($this->adaptor, $this->adaptors) && in_array($this->location, $this->locations) && in_array($this->alignment, $this->alignments)){
            return true;
        }else{
            return false;
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
        $shape_price = Shape::where("shape", $this->shape)->first();
        $remote_price = Remote::where("type", $this->remote)->first();
        $kit_price = Kit::where("name", $this->kit)->first();

        if($kit_price == null){
            abort(500, "Internal Server Error");
        }
        
        $jacket_price = 0;
        if($this->jacket == "colored"){
            $jacket_price = 20;
        }elseif($this->jacket == "white"){
            $jacket_price = 15;
        }else{
            abort(500, "Internal Server Error");
        }
        $total_price = $shape_price->price + $remote_price->price + $jacket_price + $this->line_price + $kit_price->price;
        if($this->location == "Out Door"){
            $this->total_price = $total_price + ($total_price * (15/100));
        }else{
            $this->total_price = $total_price;
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
        if(Remote::where('type', $this->remote)->first() == null){
            abort(500, 'Internal Server Error');
        }
        if(Shape::where('shape', $this->shape)->first() == null){
            abort(500, 'Internal Server Error');
        }
        if(Kit::where('name', $this->kit)->first() == null){
            abort(500, 'Internal Server Error');
        }
        if($this->arraycheck()){
            $checkout_id = $this->randomPassword();
            $order_id = $this->randomPassword();
            $stripe = new StripeClient(config('app.stripe'));
            $result = $stripe->prices->create([
                'unit_amount' => $this->total_price * 100,
                'currency' => 'USD',
                'product' => config('app.product_id'),
                // 'product' => 'prod_OLp0u520c5AcgG',
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
            Cart::create([
                'text' => $this->line1.'|'.$this->line2.'|'.$this->line3,
                'jacket' => $this->jacket,
                'font' => "$this->font|$this->font2|$this->font3",
                'color' => "$this->color|$this->color2|$this->color3",
                'backboard' => $this->shape,
                'location' => $this->location,
                'adaptor' => $this->adaptor,
                'remote' => $this->remote,
                'align' => $this->alignment,
                'address' => $this->address,
                'email' => $this->email,
                'phone' => $this->phone,
                'kit' => $this->kit,
                'order_id' => $order_id,
                'price' => $this->total_price,
                'price_id' => $result['id'],
                'checkout_id' => $checkout_id
            ]);
            $content = "**Email:** $this->email\n**PhoneNumber:** $this->phone\n**CheckoutID:** $checkout_id\n**TotalPrice: $**$this->total_price\n**Jacket:** $this->jacket\n**Line 1:** $this->line1|$this->font|$this->color\n**Line 2:** $this->line2|$this->font2|$this->color3\n**Line 3:** $this->line3|$this->font3|$this->color3\n**Backboard:** $this->shape\n**Kit:** $this->kit\n**Location:** $this->location\n**Adaptor:** $this->adaptor\n**Remote:** $this->remote\n**Alignment:** $this->alignment\n**PriceID:** {$result['id']}\n**Address:** $this->address\n**CheckoutURL:**{$checkout['url']}";

            Http::post(config('app.order-pending'), [
                'content' => $content
            ]);
            Mail::to(config('app.redirect_email'))->send(new RedirectOrderEmail($content));
            return redirect($checkout['url']);
        }else{
            abort(500, "Internal Server Error");
        }
    }
}