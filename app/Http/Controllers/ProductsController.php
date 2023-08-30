<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Search;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class ProductsController extends Controller
{
    public function index(){
        SEOMeta::setTitle("Custom Neon Signs | VitalNeon");
        SEOMeta::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");
        SEOMeta::setCanonical("https://vitalneon.com/products");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Custom Neon Signs | VitalNeon");
        OpenGraph::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon."); 
        OpenGraph::setUrl("https://vitalneon.com/products");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Custom Neon Signs | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/listing-2.png");
        TwitterCard::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");

        JsonLd::setTitle("Custom Neon Signs | VitalNeon");
        JsonLd::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);

        return view('products', [
            'products' => Product::latest()->get()
        ]);
    }
    public function search(Request $request){
        $result = Product::where('name', 'LIKE', '%'.$request->search.'%')->get();
        Search::create([
            'search' => $request->search
        ]);
        SEOMeta::setTitle("Search Custom Neon Signs | VitalNeon");
        SEOMeta::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");
        SEOMeta::setCanonical("https://vitalneon.com/products");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Search Custom Neon Signs | VitalNeon");
        OpenGraph::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon."); 
        OpenGraph::setUrl("https://vitalneon.com/products");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Search Custom Neon Signs | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/listing-2.png");
        TwitterCard::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");

        JsonLd::setTitle("Search Custom Neon Signs | VitalNeon");
        JsonLd::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);
        return view('products', [
            'products' => $result
        ]);
    }
    public function category(Category $category){
        SEOMeta::setTitle("Custom Neon Sign Categories | VitalNeon");
        SEOMeta::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");
        SEOMeta::setCanonical("https://vitalneon.com/products");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Custom Neon Sign Categories | VitalNeon");
        OpenGraph::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon."); 
        OpenGraph::setUrl("https://vitalneon.com/products");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/category-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/category-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Custom Neon Sign Categories | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/category-2.png");
        TwitterCard::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");

        JsonLd::setTitle("Custom Neon Sign Categories | VitalNeon");
        JsonLd::setDescription("Discover the vibrant world of neon signs at VitalNeon. Our extensive collection of pre-made neon signs includes a variety of designs, from classic to contemporary, that are sure to catch the eye and brighten any space. We also offer the option to create your own personalized neon sign, so you can bring your unique vision to life. All of our neon signs are handcrafted using high-quality materials and advanced techniques, ensuring that each sign is built to last. Browse our selection now and add a touch of neon to your life with VitalNeon.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/category-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/category-1.png", ["height" => 400, "width" => 760]);

        return view('products', [
            'products' => $category->products
        ]);
    }
};