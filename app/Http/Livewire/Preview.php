<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Preview extends Component
{
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
    ], $font, $fonts = [
        "amejo",
        "artelyinks",
        "bayshore",
        "bendungan",
        "beon",
        "billistone",
        "carbono",
        "cliquelly",
        "colon-mono",
        "daisy-chain",
        "garnet-script",
        "gotham",
        "greyton",
        "gruenewald",
        "highway",
        "love-malia",
        "magnolia",
        "market",
        "mikagi",
        "monly",
        "msmadi",
        "nevada",
        "palm-canyon",
        "panatype",
        "point-soft",
        "rename",
        "retro-signature",
        "rosemary",
        "sahur-bosku",
        "saltines",
        "sandstone",
        "sci-fied",
        "setting-fires",
        "starstoles-free",
        "suddenlydemo-jrn5a",
        "suddenly-regular",
        "torusbiline-bold",
        "torusbold",
        "violia-free",
        "wiretype",
        "yarorg"
    ];
    public function render()
    {
        return view('livewire.preview')->layout('layouts.preview');
    }
}
