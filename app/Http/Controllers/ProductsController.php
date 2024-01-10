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
        SEOMeta::setTitle("Buy Eye Catching Custom Neon Signs | Vital Neon");
        SEOMeta::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty");
        SEOMeta::setCanonical("https://vitalneon.com/products");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Buy Eye Catching Custom Neon Signs | Vital Neon");
        OpenGraph::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty"); 
        OpenGraph::setUrl("https://vitalneon.com/products");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Buy Eye Catching Custom Neon Signs | Vital Neon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/listing-2.png");
        TwitterCard::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty");

        JsonLd::setTitle("Buy Eye Catching Custom Neon Signs | Vital Neon");
        JsonLd::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);

        return view('products', [
            'products' => Product::latest()->with('categories')->get()
        ]);
    }
    public function search(Request $request){
        $result = Product::where('name', 'LIKE', '%'.$request->search.'%')->get();
        Search::create([
            'search' => $request->search
        ]);
        SEOMeta::setTitle("Search Eye Catching Custom Neon Signs | Vital Neon");
        SEOMeta::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty");
        SEOMeta::setCanonical("https://vitalneon.com/products");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Search Eye Catching Custom Neon Signs | Vital Neon");
        OpenGraph::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty."); 
        OpenGraph::setUrl("https://vitalneon.com/products");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Search Eye Catching Custom Neon Signs | Vital Neon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/listing-2.png");
        TwitterCard::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty.");

        JsonLd::setTitle("Search Eye Catching Custom Neon Signs | Vital Neon");
        JsonLd::setDescription("Buy artistic anime, wedding, bedroom, business, special event related custom neon signs with local power adaptor and 2 years warrenty.");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/listing-1.png", ["height" => 400, "width" => 760]);
        return view('products', [
            'products' => $result
        ]);
    }
    public function category(Category $category){
        SEOMeta::setTitle("Eye Cathing Neon Signs Categories | VitalNeon");
        SEOMeta::setDescription("Buy artistic anime, wedding, bedroom, business, love, cartoon, artwork neon signs with 2 years warrenty and free shipping");
        SEOMeta::setCanonical("https://vitalneon.com/products");
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle("Eye Cathing Neon Signs Categories | VitalNeon");
        OpenGraph::setDescription("Buy artistic anime, wedding, bedroom, business, love, cartoon, artwork neon signs with 2 years warrenty and free shipping"); 
        OpenGraph::setUrl("https://vitalneon.com/products");
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/category-2.png");
        OpenGraph::addImage("https://vitalneon.com/assets/seo/category-1.png", ["height" => 400, "width" => 760]);

        TwitterCard::setTitle("Eye Cathing Neon Signs Categories | VitalNeon");
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/assets/seo/category-2.png");
        TwitterCard::setDescription("Buy artistic anime, wedding, bedroom, business, love, cartoon, artwork neon signs with 2 years warrenty and free shipping");

        JsonLd::setTitle("Eye Cathing Neon Signs Categories | VitalNeon");
        JsonLd::setDescription("Buy artistic anime, wedding, bedroom, business, love, cartoon, artwork neon signs with 2 years warrenty and free shipping");
        JsonLd::addImage("https://vitalneon.com/assets/seo/category-2.png");
        JsonLd::setType("WebSite");
        JsonLd::addImage("https://vitalneon.com/assets/seo/category-1.png", ["height" => 400, "width" => 760]);

        return view('products', [
            'products' => $category->products
        ]);
    }
};