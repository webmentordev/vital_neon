<?php

namespace App\Http\Livewire\Auth;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;

class Leads extends Component
{
    use WithPagination;

    public $search = "";
    public function render()
    {
        $this->search = trim($this->search);
        return view('livewire.auth.leads', [
            'leads' => Lead::where(function($query) {
                    if ($this->search) {
                        $query->where('uuid', 'like', '%' . $this->search . '%')
                            ->orWhere('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                            ->orWhere('ip_address', 'like', '%' . $this->search . '%');
                    }
                })
                ->latest()
                ->paginate(100),
        ])->layout('layouts.livewire');
    }

    public function delete(Lead $lead){
       $lead->delete();
       session()->flash('success','Lead has been deleted!');
    }
}
