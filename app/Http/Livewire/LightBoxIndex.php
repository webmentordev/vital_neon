<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\LightBox;
use Stripe\StripeClient;
use App\Mail\OrderPlaced;
use App\Models\LightBoxOrder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class LightBoxIndex extends Component
{
    public $total_price = 0, $remote = "standard", $adaptor = "USB Line", $product, $email;

    protected $rules = [
        'remote' => 'required',
        'adaptor' => 'required',
        'email' => 'required|email|max:255',
    ];

    public function mount(LightBox $lightbox){
        if(!$lightbox->is_active){
            abort(404);
        }
        
        $this->product = $lightbox;
        $this->total_price = $lightbox->price;

        SEOMeta::setTitle($this->product->title);
        SEOMeta::setDescription($this->product->description);
        SEOMeta::setCanonical("https://vitalneon.com/lightbox/".$this->product->slug);
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle($this->product->title);
        OpenGraph::setDescription($this->product->description); 
        OpenGraph::setUrl("https://vitalneon.com/lightbox/".$this->product->slug);
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/storage/".$this->product->light_image, ["height" => 630, "width" => 630]);

        TwitterCard::setTitle($this->product->title);
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/storage/".$this->product->light_image);
        TwitterCard::setDescription($this->product->description);

        JsonLd::setTitle($this->product->title);
        JsonLd::setDescription($this->product->description);
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/storage/".$this->product->light_image, ["height" => 630, "width" => 630]);
    }

    public function render()
    {
        return view('livewire.light-box-index');
    }

    public function updatedremote(){
        if($this->remote == "controller"){
            $this->total_price = number_format($this->product->price, 2) + 10;
        }else{
            $this->total_price = number_format($this->product->price, 2);
        }
    }

    function randomCheckoutID() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function clickPay(){
        $this->validate();
        $this->checkout();
    }

    private function checkout(){
        $checkoutID = $this->randomCheckoutID();
        $stripe = new StripeClient(config('app.stripe'));
        $checkout = $stripe->checkout->sessions->create([
            'success_url' => config('app.url').'/success-lightbox-order/'.$checkoutID,
            'cancel_url' => config('app.url').'/cancel-lightbox-order/'.$checkoutID,
            'currency' => "USD",
            'billing_address_collection' => 'required',
            'expires_at' => Carbon::now()->addMinutes(360)->timestamp,
            'line_items' => [
                    [ 
                        'price_data' => [
                        "product" => $this->product->stripe_id,
                        "currency" => 'USD',
                        "unit_amount" =>  $this->total_price * 100,
                    ], 
                'quantity' => 1 
                ],
            ],
            'mode' => 'payment'
        ]);

        LightBoxOrder::create([
            'title' => $this->product->title,
            'email' => $this->email,
            'remote' => $this->remote,
            'adaptor' => $this->adaptor,
            'price' => $this->total_price,
            'checkout_id' => $checkoutID,
            'url' => $checkout['url']
        ]);

        $content = "Lamp - Direct order placed:\n**Product:** {$this->product->title}\n**Price:** {$this->total_price}\n**Remote:** {$this->remote}\n**Adaptor:** {$this->adaptor}\n**Details:** {$checkout['url']}";
        
        Http::post(config('app.product-pending'), [
            'content' => $content
        ]);

        Mail::to($this->email)->send(new OrderPlaced($checkout['url']));
        return redirect()->away($checkout['url']);
    }
}