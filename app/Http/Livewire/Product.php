<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $product;
    public function mount($slug){
        $result = ModelsProduct::where('slug', $slug)->with('categories')->get();
        if(count($result)){
            $this->product = $result;
        }else{
            abort(404, 'Not Found');
        }
    }
    public function render()
    {
        return view('livewire.product');
    }
}
