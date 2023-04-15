<?php

namespace App\Http\Livewire;

use App\Models\CategoryPrice;
use App\Models\Product as ModelsProduct;
use App\Models\Remote;
use Livewire\Component;

class Product extends Component
{
    public $product, $remote, $categories, $location, $adaptor, $category, $email;
    public $adaptors = [
        "USA/Canada/120V",
        "UK/IRELAND 230V",
        "EUROPE 230V",
        "AUSTRALIA/NA 230V",
        "JAPAN 100V"
    ],$locations = [
        "In Door",
        "Out Door"
    ], $remotes, $total_price = 0, $category_price;

    protected $rules = [
        'remote' => 'required',
        'adaptor' => 'required',
        'location' => 'required',
        'email' => 'required|email',
    ];

    public function mount($slug){
        $result = ModelsProduct::where('slug', $slug)->with('categories')->get();
        if(count($result)){
            $this->remotes = Remote::all();
            $this->remote = $this->remotes[0]->type;
            $this->categories = $result[0]->categories;
            $this->location = $this->locations[0];
            $this->adaptor = $this->adaptors[0];
            $this->category_price = $result[0]->categories[0]->price;
            $this->product = $result;
            $this->priceCalculator();
        }else{
            abort(404, 'Not Found');
        }
    }

    public function updated(){
        foreach($this->categories as $category){
            if($this->category == $category->name){
                $this->category_price = $category->price;
            }
        }
        $this->priceCalculator();
    }

    public function render()
    {
        return view('livewire.product');
    }

    public function priceCalculator(){
        $result = Remote::where('type', $this->remote)->first();
        if($result != null){
            $total_price = $this->category_price + $result->price;
            if(in_array($this->location, $this->locations)){
                if($this->location == "Out Door"){
                    $this->total_price = $total_price + ($total_price * (15/100));
                }else{
                    $this->total_price = $total_price;
                }
            }else{
                abort(500, 'Internal Error');
            }
        }else{
            abort(500, 'Internal Error');
        }
    }


    public function checkout(){
        $this->validate();
    }
}
