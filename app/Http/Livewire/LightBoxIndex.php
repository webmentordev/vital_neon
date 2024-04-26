<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LightBox;

class LightBoxIndex extends Component
{
    public $total_price = 0, $remote = "standard", $product;

    public function mount(LightBox $lightbox){
        $this->product = $lightbox;
        $this->total_price = $lightbox->price;
    }

    public function render()
    {
        return view('livewire.light-box-index');
    }

    public function updatedremote(){
        if($this->remote == "controller"){
            $this->total_price = number_format($this->product->price, 2) + 20;
        }else{
            $this->total_price = number_format($this->product->price, 2);
        }
    }
}