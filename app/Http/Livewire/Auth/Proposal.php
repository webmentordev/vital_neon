<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Proposal as ProposalModel;
use Livewire\WithPagination;

class Proposal extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.auth.proposal', [
            'proposals'=> ProposalModel::latest()->paginate(100),
        ])->layout('layouts.livewire');
    }
}