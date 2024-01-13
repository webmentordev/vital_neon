<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class DesignController extends Controller
{
    public function index(){
        SEOMeta::setTitle("Upload Your Design | VitalNeon");
        SEOMeta::setDescription("Upload your own designand get a free quote and a mockup. With your unique design, you have the freedom to set your own budget as well");
        SEOMeta::setCanonical("https://vitalneon.com/upload-design");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Upload Your Design | VitalNeon");
        OpenGraph::setDescription("Upload your own designand get a free quote and a mockup. With your unique design, you have the freedom to set your own budget as well"); 
        OpenGraph::setUrl("https://vitalneon.com/upload-design");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/upload-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/upload-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Upload Your Design | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/upload-2.png");
        TwitterCard::setDescription("Upload your own designand get a free quote and a mockup. With your unique design, you have the freedom to set your own budget as well");

        JsonLd::setTitle("Upload Your Design | VitalNeon");
        JsonLd::setDescription("Upload your own designand get a free quote and a mockup. With your unique design, you have the freedom to set your own budget as well");
        JsonLd::addImage("https://vitalneon.com/assets/seo/upload-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/upload-1.png", ["height" => 400, "width" => 760]);

        return view('design');
    }

    function randomOrderID() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|max:255',
            'message' => 'required',
            'size' => 'required|max:255',
            'location' => 'required',
            'budget' => 'required|numeric|min:200|max:2000',
            'name' => 'required|max:255',
            'image' => 'required|mimes:png,jpg,gif,pdf,jpeg,svg,webp|max:3048',
        ]);
        $order_id = $this->randomOrderID();
        $result = Design::create([
            'order_id' => $order_id,
            'email' => $request->email,
            'message' => $request->message,
            'size' => $request->size,
            'location' => $request->location,
            'budget' => $request->budget,
            'name' => $request->name,
            'image' => $request->image->store('designs', 'public_disk')
        ]);
        Http::post(config('app.design'), [
            'content' => "**Order:** $order_id\n**Email:** $result->email\n**Name:** $result->name\n**Message:** $result->message\n**Size:** $result->size\n**Location:** $result->location\n**Budget:** $$result->budget\n**Image:** https://vitalneon.com/storage/$result->image"
        ]);
        return back()->with('success', 'File uploaded. we will contact you with mockup of your design and quote');
    }

    public function show(){
        return view('request', [
            'designs' => Design::latest()->paginate(50)
        ]);
    }
}