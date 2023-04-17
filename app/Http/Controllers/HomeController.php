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
        SEOMeta::setDescription("Welcome to VitalNeon, your one-stop-shop for buying and creating custom neon signs. We offer a wide variety of pre-made neon signs for purchase, as well as the option to create your own personalized neon sign. Our team of experienced designers and artisans use only the highest quality materials to produce stunning neon signs that will make your business, event, or home truly stand out. Whether you're looking for a classic neon sign or something completely unique, VitalNeon has got you covered. Shop now and bring your vision to life with VitalNeon.");
        SEOMeta::setCanonical("https://vitalneon.com");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Buy Custom Neon Signs | VitalNeon");
        OpenGraph::setDescription("Welcome to VitalNeon, your one-stop-shop for buying and creating custom neon signs. We offer a wide variety of pre-made neon signs for purchase, as well as the option to create your own personalized neon sign. Our team of experienced designers and artisans use only the highest quality materials to produce stunning neon signs that will make your business, event, or home truly stand out. Whether you're looking for a classic neon sign or something completely unique, VitalNeon has got you covered. Shop now and bring your vision to life with VitalNeon."); 
        OpenGraph::setUrl("https://vitalneon.com");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Buy Custom Neon Signs | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/home-2.png");
        TwitterCard::setDescription("Welcome to VitalNeon, your one-stop-shop for buying and creating custom neon signs. We offer a wide variety of pre-made neon signs for purchase, as well as the option to create your own personalized neon sign. Our team of experienced designers and artisans use only the highest quality materials to produce stunning neon signs that will make your business, event, or home truly stand out. Whether you're looking for a classic neon sign or something completely unique, VitalNeon has got you covered. Shop now and bring your vision to life with VitalNeon.");

        JsonLd::setTitle("Buy Custom Neon Signs | VitalNeon");
        JsonLd::setDescription("Welcome to VitalNeon, your one-stop-shop for buying and creating custom neon signs. We offer a wide variety of pre-made neon signs for purchase, as well as the option to create your own personalized neon sign. Our team of experienced designers and artisans use only the highest quality materials to produce stunning neon signs that will make your business, event, or home truly stand out. Whether you're looking for a classic neon sign or something completely unique, VitalNeon has got you covered. Shop now and bring your vision to life with VitalNeon.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/home-1.png", ["height" => 400, "width" => 760]);

        return view("home");
    }
}