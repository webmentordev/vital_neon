<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateDesign extends Component
{
    public $custom_text = "Your Text";
    
    public function render()
    {
        return view('livewire.create-design')->layout('layouts.base');
    }
}