<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        return view('reviews.reviews', [
            'reviews' => Review::latest()->paginate(100)
        ]);
    }

    public function create(){
        return view('reviews.create-review');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'date' => 'required|max:255',
            'review' => 'required',
            'star' => 'required|numeric|min:4|max:5',
            'url' => 'required|url',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2024',
        ]);

        Review::create([
            'name' => $request->name,
            'date' => $request->date,
            'review' => $request->review,
            'star' => $request->star,
            'url' => $request->url,
            'image' => $request->image->store('review_images', 'public_disk')
        ]);

        return back()->with('success', 'Review has been posted');
    }


    public function update(Review $review){
        return view('reviews.update-review', [
            'review' => $review
        ]);
    }

    public function review_update(Request $request, Review $review){
        $this->validate($request, [
            'name' => 'required|max:255',
            'date' => 'required|max:255',
            'review' => 'required',
            'star' => 'required|numeric|min:4|max:5',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2024',
        ]);

        $image = null;
        if($request->image){
            $image = $request->image->store('review_images', 'public_disk');
        }

        $array = array_filter([
            'name' => $request->name,
            'date' => $request->date,
            'review' => $request->review,
            'star' => $request->star,
            'url' => $request->url,
            'image' => $image,
        ]);

        $review->update($array);

        $review->save();
        
        return back()->with('success', 'Review has been updated!');
    }
}
