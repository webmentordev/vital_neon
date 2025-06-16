<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Proposal;
use Livewire\WithFileUploads;
use App\Jobs\ProposalCreateJob;

class EditProposal extends Component
{
    use WithFileUploads;
    
    public $items = [], $email = "", $name = "";
    
    public function render()
    {
        return view('livewire.auth.edit-proposal')->layout('layouts.livewire');
    }

    public function mount(Proposal $proposal){
        $payload = json_decode($proposal->payload, true);
        foreach($payload as $key => $value){
            $this->name = $proposal->name;
            $this->email = $proposal->email;
            $this->items[$key] = [
                'color'=> $value['color'],
                'shape'=> $value['shape'],
                'usage'=> $value['usage'],
                'dimensions'=> $value['dimensions'],
                'drawing' => config('app.url'). '/storage/'.$value['drawing'],
                'mockup' => config('app.url'). '/storage/'.$value['mockup'],
                'sizes' => $value['sizes']
            ];
        }
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
            'items'=> ['required', 'array'],
            'items.*.color'=> ['required'],
            'items.*.shape'=> ['required'],
            'items.*.usage'=> ['required'],
            'items.*.dimensions'=> ['required'],
            'items.*.drawing'=> ['required', 'image', 'max:8000'],
            'items.*.mockup'=> ['required', 'image', 'max:8000'],
            'items.*.sizes' => ['required', 'array', 'min:3'],
            'items.*.sizes.*.size' => ['required', 'string'],
            'items.*.sizes.*.dimensions' => ['required', 'string'],
            'items.*.sizes.*.price' => ['required', 'numeric'],
        ]);

        foreach ($this->items as $key => $item) {
            if ($item['drawing']) {
                if(!filter_var($item['drawing'], FILTER_VALIDATE_URL)){
                    $this->items[$key]['drawing'] = $item['drawing']->store('drawings');
                }
            }
            if ($item['mockup']) {
                if(!filter_var($item['mockup'], FILTER_VALIDATE_URL)){
                    $this->items[$key]['mockup'] = $item['mockup']->store('mockup');
                }
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