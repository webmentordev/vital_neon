<?php

namespace App\Http\Controllers;

use App\Models\CategoryPrice;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryPriceController extends Controller
{
    public function index(){
        return view('product-price', [
            'products' => CategoryPrice::latest()->paginate(50),
            'productNames' => Product::latest()->get()
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => "required|max:255",
            'product' => "required|numeric",
            'price' => "required|numeric|min:1",
        ]);
        CategoryPrice::create([
            'name' => $request->name,
            'product_id' => $request->product,
            'price' => $request->price
        ]);
        return back()->with('success', 'Price for a product has been added!');
    }


    public function update(Request $request, $id){
        $this->validate($request, [
            'up_name' => "required|max:255",
            'up_product' => "required|numeric",
            'up_price' => "required|numeric|min:1",
        ]);
    
        $price = CategoryPrice::find($id);
    
        if($price != null){
            $price->name = $request->up_name;
            $price->product_id = $request->up_product;
            $price->price = $request->up_price;
    
            $price->save();
    
            return back()->with('success', 'Price for a product has been updated!');
        } else {
            abort(404, 'Not Found!');
        }
    }
}