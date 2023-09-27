<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class HomeController extends Controller
{
    public function index(){
        SEOMeta::setTitle("Buy Custom Neon Signs | VitalNeon");
        SEOMeta::setCanonical("https://vitalneon.com");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Buy Custom Neon Signs | VitalNeon");
        OpenGraph::setUrl("https://vitalneon.com");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Buy Custom Neon Signs | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/home-2.png");

        JsonLd::setTitle("Buy Custom Neon Signs | VitalNeon");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        return view("home");
    }
}