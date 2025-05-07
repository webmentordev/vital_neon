<?php

namespace App\Http\Livewire\Auth;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;

class Leads extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.auth.leads', [
            'leads' => Lead::latest()->paginate(100),
        ])->layout('layouts.livewire');;
    }

    public function delete(Lead $lead){
       $lead->delete();
       session()->flash('success','Lead has been deleted!');
    }
}
