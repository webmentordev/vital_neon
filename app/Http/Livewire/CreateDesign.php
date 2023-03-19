<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateDesign extends Component
{
    public $custom_text = "Your Text";
    public $jacked = "colored";
    public $size = "small";
    public $background = "cut_to_shape";
    public $location = "out_door";
    public $bgColor = "none";
    public $remote = "no";
    
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

    public function changeLocation($location){
        $this->location = $location;
    }

    public function changeBGColor($color){
        $this->bgColor = $color;
    }

    public function changeRemote($status){
        $this->remote = $status;
    }
}