<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateDesign extends Component
{
    public $custom_text = "Your Text";
    public $jacked = "colored";
    public $size = "small";
    public $location = "out_door";
    public $background = "cut_to_shape";
    public $bgColor = "none";
    public $remote = "no";
    public $colors = [
        "rgb(252, 96, 2)",
        "rgb(255, 255, 255)",
        "rgb(251, 236, 186)",
        "rgb(237, 244, 27)",
        "rgb(252, 203, 2)",
        "rgb(255, 1, 1)",
        "rgb(255, 151, 188)",
        "rgb(247, 53, 199)",
        "rgb(179, 60, 255)",
        "rgb(0, 54, 255)",
        "rgb(1, 221, 255)",
        "rgb(30, 255, 0)"
    ], $color_select = "rgb(252, 96, 2)";

    public $fonts = [
        "logo",
        "allura",
        "dancing",
        "montecarlo",
        "aamonoline",
        "allison",
        "always",
        "ananda",
        "architex",
        "billionDreams",
        "calasans",
        "fribash",
        "library",
        "magiera",
        "nickainley",
        "playhead",
        "playlist",
        "roboto",
        "simple",
        "slender",
        "signature"
    ], $font_select = "logo";

    

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

    public function changeBG($bgshape){
        $this->background = $bgshape;
    }

    public function changeBGColor($color){
        $this->bgColor = $color;
    }

    public function changeRemote($status){
        $this->remote = $status;
    }

    public function changeColor($coloring){
        $this->color_select = $coloring;
    }


    public function changeFont($font){
        $this->font_select = $font;
    }


    public function create(){
        $this->validate([

        ]);
    }
}