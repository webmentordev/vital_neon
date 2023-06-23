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
        SEOMeta::setDescription("Buy Energy Efficient and Loss Power Hungry Custom Artwork Neon Signs. Colored and Milky White Neon Signs. Cut to shape, Cut to letter, Cut ot rectangle neon signs. Buy Indoor or Out Door neon signs. Buy US Canada, Europe, Australia and Japan standard Neon Power Adaptors. Remote and RGB Dimmer Neon Signs. Screw Fixation, Hinge Suspension and Acrylic Stand Neon Signs.");
        SEOMeta::setCanonical("https://vitalneon.com");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Buy Custom Neon Signs | VitalNeon");
        OpenGraph::setDescription("Buy Energy Efficient and Loss Power Hungry Custom Artwork Neon Signs. Colored and Milky White Neon Signs. Cut to shape, Cut to letter, Cut ot rectangle neon signs. Buy Indoor or Out Door neon signs. Buy US Canada, Europe, Australia and Japan standard Neon Power Adaptors. Remote and RGB Dimmer Neon Signs. Screw Fixation, Hinge Suspension and Acrylic Stand Neon Signs."); 
        OpenGraph::setUrl("https://vitalneon.com");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Buy Custom Neon Signs | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/home-2.png");
        TwitterCard::setDescription("Buy Energy Efficient and Loss Power Hungry Custom Artwork Neon Signs. Colored and Milky White Neon Signs. Cut to shape, Cut to letter, Cut ot rectangle neon signs. Buy Indoor or Out Door neon signs. Buy US Canada, Europe, Australia and Japan standard Neon Power Adaptors. Remote and RGB Dimmer Neon Signs. Screw Fixation, Hinge Suspension and Acrylic Stand Neon Signs.");

        JsonLd::setTitle("Buy Custom Neon Signs | VitalNeon");
        JsonLd::setDescription("Buy Energy Efficient and Loss Power Hungry Custom Artwork Neon Signs. Colored and Milky White Neon Signs. Cut to shape, Cut to letter, Cut ot rectangle neon signs. Buy Indoor or Out Door neon signs. Buy US Canada, Europe, Australia and Japan standard Neon Power Adaptors. Remote and RGB Dimmer Neon Signs. Screw Fixation, Hinge Suspension and Acrylic Stand Neon Signs.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        return view("home");
    }
}