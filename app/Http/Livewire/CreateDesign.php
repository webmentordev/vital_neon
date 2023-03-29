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

class CreateDesign extends Component
{
    use WithFileUploads;
    
    public $shapes, $remotes;
    public $remote = "Line Dimmer";
    public $dark_mode = false;
    public $alignment = 'text-center';

    public $BGColor = "#000000";

    public $lines, $line_txt1 = "Text Goes Here", $line_txt2, $line_txt3, $SelectLine, $line_count = 1;
    public $line_price, $line_chars;
    
    
    public $adaptors = [
        "USA/Canada/120V",
        "UK/IRELAND 230V",
        "EUROPE 230V",
        "AUSTRALIA/NA 230V",
        "JAPAN 100V"
    ], $adaptor = "USA/Canada/120V";
    public $jacket = "colored";
    
    public $locations = [
        "In Door",
        "Out Door"
    ], $location = "In Door";
    
    public $email = "";
    
    public $background = "Cut to shape";
    
    public $total_price;
    
    public $colors = [
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
    ], $color_select = "rgb(252, 96, 2)";
    public $fonts = [
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
    ], $font_select = "logo";
    
    public function mount(){
        $this->lines = Line::orderBy('id', 'asc')->get();
        $this->shapes = Shape::all();
        $this->remotes = Remote::all();
        $line = Line::first();
        $this->line_count = $line->lines;
        $this->line_price = $line->price;
        $this->line_chars = $line->chars;
        $this->SelectLine = $line->name;
        $this->calculate();
    }

    public function render(){
        return view('livewire.create-design');
    }

    public function updated(){
        $line = Line::where('name', $this->SelectLine)->first();
        $this->line_count = $line->lines;
        $this->line_price = $line->price;
        $this->line_chars = $line->chars;
        $this->calculate();
    }

    public function calculate(){
        if(strlen($this->line_txt1) <= $this->line_chars && strlen($this->line_txt2) <= $this->line_chars && strlen($this->line_txt3) <= $this->line_chars){
            $shape = Shape::where('shape', $this->background)->first();
            $remote = Remote::where('type', $this->remote)->first();

            if($shape != null && $remote != null){
                if($this->jacket == "colored"){
                    $jacket_price = 20;
                }elseif($this->jacket == "white"){
                    $jacket_price = 15;
                }else{
                    $jacket_price = 0;
                    session()->flash('failed', 'Something is wrong with the system!');
                }
    
                $total_price = $shape->price + $jacket_price + $remote->price + $this->line_price;
                
                if($this->location == "Out Door"){
                    $this->total_price = $total_price + ($total_price * (15/100));
                }else{
                    $this->total_price = $total_price;
                }
            }else{
                session()->flash('failed', 'Something is wrong with the system!');
            }
        }else{
            $this->total_price = 0;
            session()->flash('failed', 'Characters must not exceed '. $this->line_chars);
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
        if($this->email != ""){
            if(in_array($this->adaptor, $this->adaptors) && in_array($this->location, $this->locations) && in_array($this->font_select, $this->fonts) && in_array($this->color_select, $this->colors)){
            
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
                    'text' => $this->line_txt1.'|'.$this->line_txt2.'|'.$this->line_txt3,
                    'jacket' => $this->jacket,
                    'font' => $this->font_select,
                    'color' => $this->color_select,
                    'backboard' => $this->background,
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
                return redirect($checkout['url']);
            }else{
                session()->flash('failed', 'There is something wrong with the system!');
            }
        }else{
            session()->flash('failed', 'Email address is required!');
        }
    }
}