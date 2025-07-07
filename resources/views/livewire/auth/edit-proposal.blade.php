<div class="py-2" x-data="{}">
    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg mb-3 font-bold">Update proposal!</h3>
                    <button class="bg-white text-black py-1 px-3 rounded-md font-semibold"
                        wire:click="add_mockup">+</button>
                </div>
                @if (session('success'))
                    <x-success :message="session('success')" />
                @endif
                @if (count($errors))
                    <p class="my-2 text-red-600 font-semibold">Mockup data is missing!</p>
                @endif
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div class="flex flex-col mb-3">
                        <x-form-input type="text" wire:model="name" placeholder="Customer name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex flex-col mb-3">
                        <x-form-input type="text" wire:model="email" placeholder="Customer Email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div x-data="{ 
                    activeTab: '{{ array_key_last($items) }}',
                    setActiveTab(tabId) {
                        this.activeTab = tabId;
                    }
                }" wire:key="tabs-{{ count($items) }}" @set-active-tab.window="setActiveTab($event.detail.tabId)">
                    <div class="grid grid-cols-7 gap-3 mb-3">
                        @foreach ($items as $item => $data)
                            <button x-on:click="setActiveTab('{{ $item }}')"
                                class="py-2 px-4 rounded-md font-semibold transition-colors" :class="activeTab === '{{ $item }}' ? 'bg-blue-500 text-white' : 'bg-black text-white'">
                                Tab #{{ $loop->iteration }}
                            </button>
                        @endforeach
                    </div>
                    @foreach ($items as $item => $data)
                        <div class="w-full p-3 bg-white/5 rounded-lg mb-3" x-show="activeTab === '{{ $item }}'"
                            x-transition>
                            <div class="flex flex-col mb-3">
                                <x-input-label class="mb-1">PDF Type (Vertical by default)</x-input-label>
                                <x-form-select type="file" wire:model="items.{{ $item }}.pdf" required>
                                    <option value="pdf">PDF (Vertical)</option>
                                    <option value="pdf-2">PDF-2 (Horizontal)</option>
                                </x-form-select>  
                                <x-input-error :messages="$errors->get('items.' . $item . '.pdf')" class="mt-2" />
                            </div>
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div class="flex flex-col">
                                    <x-input-label class="mb-1">Drawing Image</x-input-label>
                                    <x-form-input type="file" wire:model="items.{{ $item }}.drawing" accept="image/*"
                                        required />
                                    @if (is_string($data['drawing']))
                                        <a href="{{ config('app.url'). '/storage/'.$data['drawing'] }}" target="_blank" class="mt-3">
                                            <img src="{{ config('app.url'). '/storage/'.$data['drawing'] }}" width="120px" alt="Image">
                                        </a>
                                    @else
                                        @if ($data['drawing'] && !is_string($data['drawing']))
                                            <a href="{{ $data['drawing']->temporaryUrl() }}" target="_blank" class="mt-3">
                                                <img src="{{ $data['drawing']->temporaryUrl() }}" width="120px">
                                            </a>
                                        @endif
                                    @endif
                                    <x-input-error :messages="$errors->get('items.' . $item . '.drawing')" class="mt-2" />
                                </div>
                                <div class="flex flex-col">
                                    <x-input-label class="mb-1">Mockup Image</x-input-label>
                                    <x-form-input type="file" wire:model="items.{{ $item }}.mockup" accept="image/*"
                                        required />
                                    @if (is_string($data['mockup']))
                                        <a href="{{ config('app.url'). '/storage/'.$data['mockup'] }}" target="_blank" class="mt-3">
                                            <img src="{{ config('app.url'). '/storage/'.$data['mockup'] }}" width="120px">
                                        </a>
                                    @else
                                        @if ($data['mockup'] && !is_string($data['mockup']))
                                            <a href="{{ $data['mockup']->temporaryUrl() }}" target="_blank" class="mt-3">
                                                <img src="{{ $data['mockup']->temporaryUrl() }}" width="120px">
                                            </a>
                                        @endif
                                    @endif
                                    <x-input-error :messages="$errors->get('items.' . $item . '.mockup')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div class="flex flex-col">
                                    <x-form-input type="text" wire:model="items.{{ $item }}.color" placeholder="Color"
                                        required />
                                    <x-input-error :messages="$errors->get('items.' . $item . '.color')" class="mt-2" />
                                </div>
                                <div class="flex flex-col">
                                    <x-form-input type="text" wire:model="items.{{ $item }}.shape" placeholder="Shape"
                                        required />
                                    <x-input-error :messages="$errors->get('items.' . $item . '.shape')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex flex-col mb-3">
                                <x-form-input type="text" wire:model="items.{{ $item }}.usage" placeholder="Usage"
                                    required />
                                <x-input-error :messages="$errors->get('items.' . $item . '.usage')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-3 gap-3 mb-3">
                                @foreach ($data['sizes'] as $index => $size)
                                    <div class="flex flex-col">
                                        <x-form-input type="text" wire:model="items.{{ $item }}.sizes.{{ $index }}.size"
                                            placeholder="Size" required />
                                        <x-input-error :messages="$errors->get('items.{{ $item }}.sizes.{{ $index }}.size')"
                                            class="mt-2" />
                                    </div>
                                    <div class="flex flex-col">
                                        <x-form-input type="text" wire:model="items.{{ $item }}.sizes.{{ $index }}.dimensions"
                                            placeholder="Dimensions" required />
                                        <x-input-error :messages="$errors->get('items.{{ $item }}.sizes.{{ $index }}.dimensions')"
                                            class="mt-2" />
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center">
                                            <x-form-input type="number" step="0.01" wire:model="items.{{ $item }}.sizes.{{ $index }}.price"
                                            placeholder="Price" required />
                                            {{-- @if ($index != 0)
                                                <button class="py-1 px-3 bg-red-700 rounded-lg text-white ml-1"
                                                wire:click="remove_size('{{ $item }}', '{{ $index }}')">-</button>
                                            @endif --}}
                                        </div>
                                        <x-input-error :messages="$errors->get('items.{{ $item }}.sizes.{{ $index }}.price')"
                                            class="mt-2" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-between">
                                <button class="py-1 px-3 bg-red-700 rounded-lg"
                                wire:click="remove_tab('{{ $item }}')">Remove</button>
                            {{--<button class="py-1 px-3 bg-blue-700 rounded-lg text-white"
                                wire:click="add_size('{{ $item }}')">Add</button>--}}
                            </div> 
                        </div>
                        
                    @endforeach
                </div>
                <div class="flex items-center justify-between">
                    <button wire:click="store" class="bg-black text-white py-2 px-6 rounded-md mt-3 font-semibold">Submit</button>
                <button wire:click="preview" class="bg-white text-black py-2 px-4 rounded-md mt-3">Preview</button>
                </div>
            </div>
        </div>
    </div>
</div>