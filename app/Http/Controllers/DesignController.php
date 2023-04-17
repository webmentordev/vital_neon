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
        SEOMeta::setTitle("Create Your Own Neon Sign: Upload Your Design | VitalNeon");
        SEOMeta::setDescription("");
        SEOMeta::setCanonical("https://vitalneon.com/upload-design");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Create Your Own Neon Sign: Upload Your Design | VitalNeon");
        OpenGraph::setDescription(""); 
        OpenGraph::setUrl("https://vitalneon.com/upload-design");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/upload-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/upload-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Create Your Own Neon Sign: Upload Your Design | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/upload-2.png");
        TwitterCard::setDescription("");

        JsonLd::setTitle("Create Your Own Neon Sign: Upload Your Design | VitalNeon");
        JsonLd::setDescription("");
        JsonLd::addImage("https://vitalneon.com/assets/seo/upload-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/upload-1.png", ["height" => 400, "width" => 760]);

        return view('design');
    }
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|max:255',
            'message' => 'required',
            'name' => 'required|max:255',
            'image' => 'required|mimes:png,jpg,gif,pdf,jpeg,svg,webp|max:2048',
        ]);
        $result = Design::create([
            'email' => $request->email,
            'message' => $request->message,
            'name' => $request->name,
            'image' => $request->image->store('designs', 'public_disk')
        ]);
        Http::post(config('app.design'), [
            'content' => "**Email:** $result->email\n**Name:** $result->name\n**Message:** $result->message\n**Image:** https://vitalneon/storage/$result->image"
        ]);
        return back()->with('success', 'File uploaded. we will send you the quote in few hours');
    }
}