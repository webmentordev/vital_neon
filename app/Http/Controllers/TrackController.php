<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class TrackController extends Controller
{
    public function index(){
        SEOMeta::setTitle("Track Order | VitalNeon");
        SEOMeta::setDescription("At VitalNeon, we believe in providing exceptional customer support every step of the way. Our knowledgeable and friendly support team is always here to help with any questions or concerns you may have about our products and services. Whether you need assistance with a custom neon sign order, have a question about shipping, or need help with installation, we're here to make sure you have a seamless and stress-free experience. Contact us today and let us help you make your vision a reality with VitalNeon.");
        SEOMeta::setCanonical("https://vitalneon.com/track-order");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Track Order | VitalNeon");
        OpenGraph::setDescription("At VitalNeon, we believe in providing exceptional customer support every step of the way. Our knowledgeable and friendly support team is always here to help with any questions or concerns you may have about our products and services. Whether you need assistance with a custom neon sign order, have a question about shipping, or need help with installation, we're here to make sure you have a seamless and stress-free experience. Contact us today and let us help you make your vision a reality with VitalNeon."); 
        OpenGraph::setUrl("https://vitalneon.com/track-order");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");

        TwitterCard::setTitle("Track Order | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setDescription("At VitalNeon, we believe in providing exceptional customer support every step of the way. Our knowledgeable and friendly support team is always here to help with any questions or concerns you may have about our products and services. Whether you need assistance with a custom neon sign order, have a question about shipping, or need help with installation, we're here to make sure you have a seamless and stress-free experience. Contact us today and let us help you make your vision a reality with VitalNeon.");

        JsonLd::setTitle("Track Order | VitalNeon");
        JsonLd::setDescription("At VitalNeon, we believe in providing exceptional customer support every step of the way. Our knowledgeable and friendly support team is always here to help with any questions or concerns you may have about our products and services. Whether you need assistance with a custom neon sign order, have a question about shipping, or need help with installation, we're here to make sure you have a seamless and stress-free experience. Contact us today and let us help you make your vision a reality with VitalNeon.");
        JsonLd::setType("WebSite");
        return view('track-order', [
            'order' => null
        ]);
    }
    public function search(Request $request){
        $result = Order::where('checkout_id', $request->order)->first();
        if($result){
            if($result->status != 'canceled'){
                return view('track-order', [
                    'order' => $result
                ]);
            }else{
                return view('track-order', [
                    'order' => null
                ]);
            }
        }else{
            return back();
        }
    }
}