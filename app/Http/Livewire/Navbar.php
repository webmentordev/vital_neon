<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navbar extends Component
{
    public $itemsCount = 0;
    protected $listeners = ['cartCheck' => 'itemsCountCheck'];

    public function mount(){
        $this->itemsCount = count(session()->get('cart', []));
    }

    public function render()
    {
        return view('livewire.navbar', [
            'categories' => Category::get()
        ]);
    }

    public function itemsCountCheck(){
        $this->itemsCount = count(session()->get('cart'));
    }
}