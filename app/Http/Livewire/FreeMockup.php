<?php

namespace App\Http\Livewire;

use App\Jobs\LeadMessageJob;
use App\Models\Lead;
use Livewire\Component;
use App\Mail\LeadRecieved;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class FreeMockup extends Component
{
    use WithFileUploads;

    public $uuid, $sessionActive, $source;

    public $name, $email, $phone_number, $location, $dimensions, $budget, $message, $logos = [];

    public function mount()
    {
        $utmParam = request()->query('utm');
        if ($utmParam) {
            $this->source = $utmParam;
            Session::put('utm', $utmParam);
        } elseif (Session::has('utm')) {
            $this->source = Session::get('utm');
        }
        if (Session::has('visitor_uuid')) {
            $this->uuid = Session::get('visitor_uuid');
        } else {
            $this->uuid = (string) Str::uuid();
            Session::put('visitor_uuid', $this->uuid);
        }
        $this->sessionActive = true;
    }

    public function render()
    {
        SEOMeta::setTitle("GET FREE NEON SIGN MOCKUP & QUOTE");
        SEOMeta::setDescription("Get free mockup design & quote of your neon sign. Provide your business's neon sign logo image or drawing.");
        SEOMeta::setCanonical("https://vitalneon.com/neon-sign-free-mockup-and-quote");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("GET FREE NEON SIGN MOCKUP & QUOTE");
        OpenGraph::setDescription("Get free mockup design & quote of your neon sign. Provide your business's neon sign logo image or drawing."); 
        OpenGraph::setUrl("https://vitalneon.com/neon-sign-free-mockup-and-quote");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/upload-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/upload-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("GET FREE NEON SIGN MOCKUP & QUOTE");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/upload-2.png");
        TwitterCard::setDescription("Get free mockup design & quote of your neon sign. Provide your business's neon sign logo image or drawing.");

        JsonLd::setTitle("GET FREE NEON SIGN MOCKUP & QUOTE");
        JsonLd::setDescription("Get free mockup design & quote of your neon sign. Provide your business's neon sign logo image or drawing.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/upload-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/upload-1.png", ["height" => 400, "width" => 760]);

        return view('livewire.free-mockup');
    }

    public function updated(){
        $request = request();
        Lead::updateOrCreate(
            ['uuid' => $this->uuid, 'is_completed' => false],
            [
                'uuid' => $this->uuid,
                'name' => $this->name, 
                'email' => $this->email, 
                'phone_number' => $this->phone_number, 
                'location' => $this->location, 
                'dimensions' => $this->dimensions, 
                'budget' => $this->budget,
                'message' => $this->message,
                'source' => $this->source,
                'user_agent' => $request->header('User-Agent'),
            ]
        );
    }

    public function store_data(){
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|numeric|min:8',
            'location' => 'required|max:255',
            'dimensions' => 'required|max:255',
            'budget' => 'required|numeric|min:200',
            'message' => 'required',
            'logos' => 'required|array',
            'logos.*' => 'required|mimes:png,jpg,jpeg,webp,pdf|max:5024',
        ]);
        $logoPaths = [];
        foreach ($this->logos as $logo) {
            $path = $logo->store('logos', 'storage');
            $logoPaths[] = $path;
        }
        $request = request();
        $lead = Lead::updateOrCreate(
            ['uuid' => $this->uuid, 'is_completed' => false],
            [
                'uuid' => $this->uuid,
                'name' => $this->name, 
                'email' => $this->email, 
                'phone_number' => $this->phone_number, 
                'location' => $this->location, 
                'dimensions' => $this->dimensions, 
                'budget' => $this->budget,
                'message' => $this->message,
                'logos' => json_encode($logoPaths),
                'source' => $this->source,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'is_completed' => true
            ]
        );
        // Mail::to($this->email)->queue(new LeadRecieved($lead));
        LeadMessageJob::dispatch($lead);
        $this->reset(['name', 'email', 'phone_number', 'location', 'dimensions', 'budget', 'message', 'logos']);
        return session()->flash('success', "Thank you!");
    }

    public function hide_message(){
        $this->uuid = (string) Str::uuid();
        Session::put('visitor_uuid', $this->uuid);
        return redirect()->to('/neon-sign-free-mockup-and-quote');
    }
}
