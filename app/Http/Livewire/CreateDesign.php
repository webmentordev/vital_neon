<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Line;
use App\Models\Shape;
use App\Models\Remote;
use Livewire\Component;
use Stripe\StripeClient;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

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
        "text-center",
        "text-start",
        "text-end"
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
        "logo",
        "allura",
        "dancing",
        "montecarlo",
        "aamonoline",
        "allison",
        "always",
        "ananda",
        "architex",
        "billionDreams",
        "calasans",
        "fribash",
        "library",
        "magiera",
        "nickainley",
        "playhead",
        "playlist",
        "roboto",
        "simple",
        "slender",
        "signature"
    ], $adaptor, 
    $color, 
    $font, 
    $location;

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
    $line1, $line2, $line3,
    $jacket;

    public $line_count = 1,
    $dark_mode = false,
    $background = "Cut to shape";


    protected $rules = [
        'line1' => 'required',
        'shape' => 'required',
        'remote' => 'required',
        'total_price' => 'required|numeric',
        'alignment' => 'required',
        'color' => 'required',
        'font' => "required",
        'adaptor' => 'required',
        'location' => 'required',
        'email' => 'required|email',
    ];

    public function mount(){
        $this->shapes = Shape::all();
        $this->remotes = Remote::all();
        $this->lines = Line::all();
        $this->chars = $this->lines[0]->chars;
        $this->font = $this->fonts[0];
        $this->color = $this->colors[0];
        $this->location = $this->locations[0];
        $this->adaptor = $this->adaptors[0];
        $this->alignment = $this->alignments[0];
        $this->jacket = $this->jackets[0];
        $this->remote = $this->remotes[0]->type;
        $this->shape = $this->shapes[0]->shape;
        $this->line_price = $this->lines[0]->price;
        $this->line1 = "Text Here";
        $this->priceCalculator();
    }

    public function render(){
        return view('livewire.create-design');
    }

    public function updated(){
        $this->priceCalculator();
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
            $this->priceCalculator();
        }else{
            abort(500, "Internal Server Error");
        }
    }

    public function updatedline1(){
        if(strlen($this->line1) > $this->chars && strlen($this->line1) == 0){
            session()->flash('lineCount', 'Line must have only '. $this->chars. " characters");
        }
    }
    public function updatedline2(){
        if(strlen($this->line2) > $this->chars && strlen($this->line2) == 0){
            session()->flash('lineCount', 'Line must have only '. $this->chars. " characters");
        }
    }
    public function updatedline3(){
        if(strlen($this->line3) > $this->chars && strlen($this->line3) == 0){
            session()->flash('lineCount', 'Line must have only '. $this->chars. " characters");
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
        $jacket_price = 0;
        if($this->jacket == "colored"){
            $jacket_price = 20;
        }elseif($this->jacket == "white"){
            $jacket_price = 15;
        }else{
            abort(500, "Internal Server Error");
        }
        $total_price = $shape_price->price + $remote_price->price + $jacket_price + $this->line_price;
        if($this->location == "Out Door"){
            $this->total_price = $total_price + ($total_price * (15/100));
        }else{
            $this->total_price = $total_price;
        }
    }

    public function checkout(){
        $this->validate();
        if(Remote::where('type', $this->remote)->first() == null){
            abort(500, 'Internal Server Error');
        }else if(Shape::where('shape', $this->shape)->first() == null){
            abort(500, 'Internal Server Error');
        }
        if($this->arraycheck()){
            $checkout_id = $this->randomPassword();
            $order_id = $this->randomPassword();
            $stripe = new StripeClient(config('app.stripe'));
            $result = $stripe->prices->create([
                'unit_amount' => $this->total_price * 100,
                'currency' => 'USD',
                'product' => 'prod_NZuQ5Ir75DenC2',
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
                'font' => $this->font,
                'color' => $this->color,
                'backboard' => $this->shape,
                'location' => $this->location,
                'adaptor' => $this->adaptor,
                'remote' => $this->remote,
                'align' => $this->alignment,
                'email' => $this->email,
                'order_id' => $order_id,
                'price' => $this->total_price,
                'price_id' => $result['id'],
                'checkout_id' => $checkout_id
            ]);
            Http::post(config('app.order-pending'), [
                'content' => "**Email:** $this->email\n**CheckoutID:** $checkout_id\n**TotalPrice: $**$this->total_price\n**Jacket:** $this->jacket\n**Text:** $this->line1|$this->line2|$this->line2\n**Font:** $this->font\n**Color:** $this->color\n**Backboard:** $this->shape\n**Location:** $this->location\n**Adaptor:** $this->adaptor\n**Remote:** $this->remote\n**Alignment:** $this->alignment\n**PriceID:** {$result['id']}\n**CheckoutURL:**{$checkout['url']}"
            ]);
            return redirect($checkout['url']);
        }else{
            abort(500, "Internal Server Error");
        }
    }
}