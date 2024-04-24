<?php

namespace App\Http\Controllers;

use App\Models\LightBox;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LightBoxController extends Controller
{
    public function index(){
        return view('lightbox.create', [
            'lightboxes' => LightBox::latest()->paginate(100)
        ]);
    }
    public function orders(){
        return view('lightbox.orders');
    }
    public function update(LightBox $light_box){
        return view('lightbox.update', [
            'lightbox' => $light_box
        ]);
    }



    public function status(LightBox $light_box){
        $light_box->is_active = !$light_box->is_active;
        $light_box->save();
        return back();
    }
    public function feature(LightBox $light_box){
        $light_box->is_featured = !$light_box->is_featured;
        $light_box->save();
        return back();
    }
    public function store(Request $request){
        $stripe = new StripeClient(config('app.stripe'));
        $this->validate($request, [
            'title' => "required|max:255|unique:light_boxes,title",
            'light_image' => "required|image|mimes:png,jpg,jpeg,webp",
            'dark_image' => "nullable|image|mimes:png,jpg,jpeg,webp",
            'slug' => "required|max:255",
            'price' => "required|numeric|min:1",
            'body' => "required",
            'description' => "required"
        ]);
        $slug = strtolower(str_replace(' ', '-', $request->slug));
        $imageLink = $request->light_image->storeAs('lightboxes', $slug.'-light-'.rand(9,999999).".".$request->light_image->getClientOriginalExtension(), 'public_disk');
        $dark_image = null;
        if($request->hasFile('dark_image')){
            $dark_image = $request->dark_image->storeAs('lightboxes', $slug.'-dark-'.rand(9,999999).".".$request->dark_image->getClientOriginalExtension(), 'public_disk');
        }
        $result = $stripe->products->create([
            'name' => $request->title,
            'images' => [
                config('app.url').'/storage/'.$imageLink
            ]
        ]);
        LightBox::create([
            'title' => $request->title,
            'stripe_id' => $result['id'],
            'slug' => $slug,
            'light_image' => $imageLink,
            'dark_image' => $dark_image,
            'body' => $request->body,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return back()->with('success', 'LightBox has been added!');
    }
    public function update_box(Request $request, LightBox $light_box){
        $stripe = new StripeClient(config('app.stripe'));
        $this->validate($request, [
            'title' => "required|max:255",
            'light_image' => "nullable|image|mimes:png,jpg,jpeg,webp",
            'dark_image' => "nullable|image|mimes:png,jpg,jpeg,webp",
            'slug' => "required|max:255",
            'price' => "required|numeric|min:1",
            'body' => "required",
            'description' => "required"
        ]);
        $slug = strtolower(str_replace(' ', '-', $request->slug));
        $light_image = null;
        $dark_image = null;
        if($request->hasFile('light_image')){
            Storage::disk('public_disk')->delete($light_box->light_image);
            $light_image = $request->light_image->storeAs('lightboxes', $slug.'-light-'.rand(9,999999).".".$request->light_image->getClientOriginalExtension(), 'public_disk');
            $stripe->products->update(
                $light_box->stripe_id,
                [
                    'images' => [
                        config('app.url').'/storage/'.$light_image
                    ]
                ]
            );
        }
        if($request->hasFile('dark_image')){
            if($light_box->dark_image){
                Storage::disk('public_disk')->delete($light_box->dark_image);
            }
            $dark_image = $request->dark_image->storeAs('lightboxes', $slug.'-dark-'.rand(9,999999).".".$request->dark_image->getClientOriginalExtension(), 'public_disk');
        }

        if($request->title != $light_box->title){
            $stripe->products->update(
                $light_box->stripe_id,
                ['name' => $request->title]
            );
        }
        $light_box->update(array_filter([
            'title' => $request->title,
            'slug' => $slug,
            'price' => $request->price,
            'light_image' => $light_image,
            'dark_image' => $dark_image,
            'body' => $request->body,
            'description' => $request->description
        ]));
        return back()->with('success', 'LightBox has been updated');
    }
}