<?php

namespace App\Http\Livewire\Auth;

use App\Jobs\ProposalCreateJob;
use App\Models\Proposal;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProposal extends Component
{
    use WithFileUploads;
    
    public $items = [], $email = "", $name = "";
    public function render()
    {
        return view('livewire.auth.create-proposal')->layout('layouts.livewire');
    }

    public function mount(){
        $this->items['tab-1'] = [
            'color'=> '',
            'shape'=> '',
            'usage'=> '',
            'dimensions'=> '',
            'drawing' => null,
            'mockup' => null,
            'sizes'=> [
                [ 
                    "size" => "Small",
                    "price"=> "", 
                    "dimensions"=> "",  
                ],
                [ 
                    "size" => "Medium",
                    "price"=> "", 
                    "dimensions"=> "",  
                ],
                [ 
                    "size" => "Large",
                    "price"=> "", 
                    "dimensions"=> "",  
                ]
            ]
        ];
    }

    public function add_mockup(){
        $random = 'tab-'.rand(999,99999);
        $this->items[$random] = [
            'color'=> '',
            'shape'=> '',
            'usage'=> '',
            'dimensions'=> '',
            'drawing' => null,
            'mockup' => null,
            'sizes'=> [
                [ 
                    "size" => "Small",
                    "price"=> "", 
                    "dimensions"=> "",  
                ],
                [ 
                    "size" => "Medium",
                    "price"=> "", 
                    "dimensions"=> "",  
                ],
                [ 
                    "size" => "Large",
                    "price"=> "", 
                    "dimensions"=> "",  
                ]
            ]
        ];
    }

    public function remove_tab($id){
        if (count($this->items) > 1){
            unset($this->items[$id]);
        }
    }

    public function add_size($item){
        $this->items[$item]['sizes'][] = [ 
            "size" => "",
            "price"=> "", 
            "dimensions"=> "",  
        ];
    }

    public function remove_size($item, $index){
        unset($this->items[$item]['sizes'][$index]);
        $this->items[$item]['sizes'] = array_values($this->items[$item]['sizes']);
    }


    public function store(){
        $this->validate([
            'name'=> ['required'],
            'email'=> ['required'],
            'dimensions'=> ['required'],
            'items'=> ['required', 'array'],
            'items.*.color'=> ['required'],
            'items.*.shape'=> ['required'],
            'items.*.usage'=> ['required'],
            'items.*.drawing'=> ['required', 'image', 'max:8000'],
            'items.*.mockup'=> ['required', 'image', 'max:8000'],
            'items.*.sizes' => ['required', 'array'],
            'items.*.sizes.*.size' => ['required', 'string'],
            'items.*.sizes.*.dimensions' => ['required', 'string'],
            'items.*.sizes.*.price' => ['required', 'numeric'],
        ]);

        foreach ($this->items as $key => $item) {
            if ($item['drawing']) {
                $this->items[$key]['drawing'] = $item['drawing']->store('drawings');
            }
            if ($item['mockup']) {
                $this->items[$key]['mockup'] = $item['mockup']->store('mockup');
            }
        }

        $proposal = Proposal::create([
            'name'=> $this->name,
            'email'=> $this->email,
            'payload' => json_encode($this->items),
        ]);

        ProposalCreateJob::dispatch($proposal);

        return redirect('/proposal/create')->with('success','Proposal has been added to the queue!');
    }
    
    public function preview(){
        dd(["name" => $this->name, "email" => $this->email, $this->items]);
    }
}