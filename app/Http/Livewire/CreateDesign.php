<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateDesign extends Component
{
    public $custom_text = "Your Text";
    public $jacked = "colored";
    public $size = "small";
    
    public function render()
    {
        return view('livewire.create-design')->layout('layouts.base');
    }

    public function changeJacket($type){
        $this->jacked = $type;
    }

    public function changeSize($size){
        $this->size = $size;
    }
}