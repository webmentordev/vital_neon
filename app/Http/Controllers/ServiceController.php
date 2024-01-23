<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class ServiceController extends Controller
{
    public function terms(){
        SEOMeta::setTitle("Vital Neon Terms of service");
        SEOMeta::setCanonical("https://vitalneon.com/terms-of-service");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Vital Neon Terms of service");
        OpenGraph::setUrl("https://vitalneon.com/terms-of-service");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Vital Neon Terms of service");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/home-2.png");

        JsonLd::setTitle("Vital Neon Terms of service");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);
        return view('terms-of-service');
    }

    public function privacy(){
        SEOMeta::setTitle("Vital Neon Privacy Policy");
        SEOMeta::setCanonical("https://vitalneon.com/privacy-policy");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Vital Neon Privacy Policy");
        OpenGraph::setUrl("https://vitalneon.com/privacy-policy");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Vital Neon Privacy Policy");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/home-2.png");

        JsonLd::setTitle("Vital Neon Privacy Policy");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);
        return view('privacy-policy');
    }

    public function return(){
        SEOMeta::setTitle("Vital Neon Return Policy");
        SEOMeta::setCanonical("https://vitalneon.com/return-policy");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Vital Neon Return Policy");
        OpenGraph::setUrl("https://vitalneon.com/return-policy");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Vital Neon Return Policy");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/home-2.png");

        JsonLd::setTitle("Vital Neon Return Policy");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);
        return view('return-policy');
    }
}