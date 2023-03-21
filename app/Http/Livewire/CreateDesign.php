<?php

namespace App\Http\Livewire;

use App\Models\Remote;
use App\Models\Shape;
use App\Models\Size;
use Livewire\Component;

class CreateDesign extends Component
{
    public $custom_text = "Your Text";
    public $adaptor = "USA/Canada/120V";
    public $jacket = "colored";
    public $size = "Small";
    public $location = "in_door";
    public $email = "";
    public $background = "Cut to shape";
    public $remote = "Line Dimmer";
    
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

    public $images = [
        "dark_wall.jpg",
        "background1.png",
        "background3.jpg",
        "bed_room.jpg",
        "wall.jpg"
    ], $image_select = "dark_wall.jpg";

    public function render()
    {
        return view('livewire.create-design', [
            'sizes' => Size::all(),
            'shapes' => Shape::all(),
            'remotes' => Remote::all()
        ]);
    }
}