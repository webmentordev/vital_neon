<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            'products' => Product::latest()->with('categories')->where('for_customer', false)->where('is_active', true)->where('is_lead', false)->get(),
            'discount' => DB::table('discounts')->latest()->first(),
            'category' => []
        ]);
    }
    public function search(Request $request){
        $this->validate($request, [
            'search' => 'required|max:255'
        ]);
        $result = Product::where('is_active', true)->where('for_customer', false)->where('is_lead', false)
            ->where(function($query) use ($request) {
                $query->orWhere('name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('description', 'LIKE', '%'.$request->search.'%');
            })
            ->latest()
            ->get();
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
            'products' => $result,
            'discount' => DB::table('discounts')->latest()->first(),
            'category' => []
        ]);
    }
    public function category(Category $category){
        SEOMeta::setTitle($category->title);
        SEOMeta::setDescription($category->description);
        SEOMeta::setCanonical("https://vitalneon.com/products/category/". $category->slug);
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle($category->title);
        OpenGraph::setDescription($category->description); 
        OpenGraph::setUrl("https://vitalneon.com/products/category/". $category->slug);
        OpenGraph::addProperty("type", "website");
        OpenGraph::addProperty("locale", "eu");
        
        TwitterCard::setTitle($category->title);
        TwitterCard::setSite("@vitalneon");
        if($category->image){
            TwitterCard::setImage(config('app.url'). '/storage/'. $category->image);
            JsonLd::addImage(config('app.url'). '/storage/'. $category->image);
            OpenGraph::addImage(config('app.url'). '/storage/'. $category->image);
        }
        TwitterCard::setDescription($category->description);
       
        JsonLd::setTitle($category->title);
        JsonLd::setDescription($category->description);
        JsonLd::setType("WebSite");

        if($category->name == "Custom" && !Auth::check()){
            abort(404);
        }
        return view('products', [
            'products' => $category->products,
            'discount' => DB::table('discounts')->latest()->first(),
            'category' => $category,
        ]);
    }
};