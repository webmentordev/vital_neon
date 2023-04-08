<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 text-white gap-6 max-w-[1360px] m-auto min-h-[800px] 890px:grid-cols-1 bg-light p-6">
        <div class="bg-cover bg-center relative rounded-lg flex justify-center items-center 890px:min-h-[800px]" id="backDiv" style="background-color: {{ $BGColor }}">
            <span class="fixed bg-main rounded-lg p-3 bottom-3 z-10 right-3 text-gray-800 text-4xl font-semibold"><span class="text-2xl">$</span>{{ $total_price }}</span>
            
            <div wire:click="$set('dark_mode', {{ !$dark_mode }})" class=" @if (!$dark_mode) bg-white @else bg-gray-800 @endif p-3 rounded-lg absolute top-2 left-2">
                @if (!$dark_mode)
                    <img src="https://api.iconify.design/mdi:lightbulb-on.svg?color=%23e4aa0c" width="35" alt="Sun Image">
                @else
                    <img src="https://api.iconify.design/mdi:lightbulb-on.svg?color=%23ffffff" width="35" alt="Moon Image">
                @endif
            </div>
            
            <span class="text-white {{ $font_select }} {{ $alignment }} text-5xl font-semibold" @if (!$dark_mode) 
            style="text-shadow:
            0 0 7px {{ $color_select }},
            0 0 7px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }};" @endif>{{ $line_txt1 }}<br>{{ $line_txt2 }}<br>{{ $line_txt3 }}</span>

            <div class="flex items-center justify-between absolute w-full bottom-0 p-3">
                <input type="color" class="hidden" id="color" wire:model="BGColor">
                <label for="color" class="bg-white p-3 rounded-full"><img width="30" src="https://api.iconify.design/nimbus:color-palette.svg?color=%230d92f8" alt="Palet Icon"></label>
                <div class="px-2">
                    <label for="photo" class="flex items-center"><span class="mr-2 text-white font-semibold">Upload Your Own Image</span><img src="https://api.iconify.design/line-md:uploading-loop.svg?color=%23ffffff" width="40" alt="Upload"></label>
                    <input type="file" id="photo" accept="image/*" onchange="loadFile(event)" class="hidden">
                </div>
            </div>
        </div>
        <form wire:submit.prevent="checkout" method="POST" class="text-sm max-h-[900px] overflow-scroll px-6 py-6">
            <div class="flex items-center justify-between">
                <h1 class="text-main font-bold text-3xl mb-3">Design Your Neon</h1>
                <div class="flex items-center">
                    <img wire:click="$set('alignment', 'text-center')" src="https://api.iconify.design/material-symbols:format-align-center.svg?color=%23FFFFFF" class="p-2 rounded-lg bg-dark mr-2" alt="Alignment Icon" width="50">
                    <img wire:click="$set('alignment', 'text-start')" src="https://api.iconify.design/ic:baseline-format-align-left.svg?color=%23FFFFFF" class="p-2 rounded-lg bg-dark mr-2" alt="Alignment Icon" width="50">
                    <img wire:click="$set('alignment', 'text-end')" src="https://api.iconify.design/ic:baseline-format-align-right.svg?color=%23FFFFFF" class="p-2 rounded-lg bg-dark" alt="Alignment Icon" width="50">
                </div>
            </div>
            @if (session('failed'))
                <p class="text-white p-6 fixed bottom-2 left-2 z-20 rounded-lg bg-red-700 mb-3 border-red-600 border">{{ session('failed') }}</p>
            @endif
            <div class="py-2">
                <h2 class="font-bold text-lg">Text Line & Size Options <span class="text-sm text-gray-400">{{ $SelectLine }} (${{ $line_price }})</span></h2>
                <div class="mt-1">
                    <select wire:model="SelectLine" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        @foreach ($lines as $line)
                            @if ($loop->first)
                                <option value="{{ $line->name }}" selected>{{ $line->name }}</option>
                            @else
                                <option value="{{ $line->name }}">{{ $line->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($line_count >= 1)
                <h2 class="font-bold text-lg">Line One Text</h2>
                <input type="text" wire:model.debounce.500ms="line_txt1" placeholder="Text Line One" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @endif
            
            @if ($line_count >= 2)
                <h2 class="font-bold text-lg">Line Two Text</h2>
                <input type="text" wire:model.debounce.500ms="line_txt2" placeholder="Text Line Two" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @endif

            @if ($line_count == 3)
                <h2 class="font-bold text-lg">Line Three Text</h2>
                <input type="text" wire:model.debounce.500ms="line_txt3" placeholder="Text Line Three" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @endif

            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Choose a Jacket</h2>
                
                <div wire:click="$set('jacket', 'colored')" class="flex p-3 bg-dark cursor-pointer rounded-md flex-col mb-3 border @if ($jacket == 'colored') border-main @else border-gray-800 @endif">
                    <p class="font-semibold mb-2">Color-matching</p>
                    <span class="text-gray-500 text-sm">The tube will be colored when turned off.</span>
                </div>
                
                <div wire:click="$set('jacket', 'white')" class="flex p-3 bg-dark cursor-pointer rounded-md flex-col mb-3 border @if ($jacket == 'white') border-main @else border-gray-800 @endif">
                    <p class="font-semibold mb-2">White</p>
                    <span class="text-gray-500 text-sm">Your sign will be white when turned off.</span>
                </div>
            </div>

            <div class="py-2" x-data="{ open: false }">
                <h2 class="font-bold mb-2 text-lg">Choose Font</h2>
                <p class="p-3 border-gray-300 flex items-center justify-between bg-dark rounded-md mb-3 capitalize" x-on:click="open = !open">{{ $font_select }} <img src="https://api.iconify.design/fe:drop-down.svg?color=%231e1f1e" width="30" alt="Carret Down Icon"></p>
                <div class="grid grid-cols-2 gap-4" x-show="open" x-cloak>
                    @foreach ($fonts as $font)
                    <div wire:click="$set('font_select', '{{ $font }}')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border  @if ($font_select == $font) border-main @else border-gray-300 @endif">
                        <p class="text-center text-2xl {{ $font }}">{{ $line_txt1 }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Choose a colour</h2>
                <div class="flex flex-wrap">
                    @foreach ($colors as $color)
                        <div wire:click="$set('color_select', '{{ $color }}')" class="rounded-full m-2" style="@if($color == $color_select) border: 2px {{ $color_select }} solid; @endif">
                            <span class="flex p-4 cursor-pointer rounded-full flex-col border border-white shadow-md" style="background-color: {{ $color }};"></span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Backboard Style *{{ $background }}</h2>
                <div class="py-3">
                    @foreach ($shapes as $shape)
                        <div wire:click="$set('background', '{{ $shape->shape }}')" class="flex bg-dark mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($background ==  $shape->shape) border-main @else border-gray-800 @endif">
                            <p class="font-semibold mb-2">{{ $shape->shape }} (${{ $shape->price }})</p>
                            <span class="text-gray-500 text-sm">{{ $shape->description }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Location *{{ $location }}</h2>
                <div class="py-3 grid grid-cols-2 gap-4">
                    @foreach ($locations as $loc)
                        <div wire:click="$set('location', '{{ $loc }}')" class="flex bg-dark mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == $loc) border-main @else border-gray-800 @endif">
                            <p class="font-semibold text-center">{{ $loc }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg">Power Adaptor *{{ $adaptor }}</h2>
                <div class="mt-1">
                    <select wire:model="adaptor" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        @foreach ($adaptors as $itemAdapt)
                            @if ($loop->first)
                                <option value="{{ $itemAdapt }}" selected>{{ $itemAdapt }}</option>
                            @else
                                <option value="{{ $itemAdapt }}">{{ $itemAdapt }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg">Remote and Dimmer</h2>
                <p class="text-gray-500 text-sm mb-3">A remote and dimmer is included free with every sign! (Except for Multicolor Neon Signs, which are controlled by the APP)</p>
                <div class="py-3 grid grid-cols-2 gap-4">
                    @foreach ($remotes as $rItem)
                        <div wire:click="$set('remote', '{{ $rItem->type }}')" class=" bg-dark flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($remote == $rItem->type) border-main @else border-gray-800 @endif">
                            <p class="font-semibold text-center">{{ $rItem->type }} - ${{ $rItem->price }}</p>
                        </div>
                    @endforeach 
                </div>
            </div>
            <input type="text" wire:model.debounce.500ms="email" placeholder="Email Address" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            <button class="submit-btn" type="submit"><span class="mr-2 text-xl">Checkout</span> <img src="{{ asset('assets/images/stripe_small.png') }}" width="50" alt="Stripe Logo"></button>
        </form>
    </div>
    <img id="output"/>
    <script>
        var loadFile = function(event) {
          var output = document.getElementById('backDiv');
          output.style.backgroundColor = "transparent";
          output.style.backgroundImage = `url(${URL.createObjectURL(event.target.files[0]).toString()})`;
          output.onload = function() {
            var myURL = URL.revokeObjectURL(output.src) // free memory
            console.log(myURL)
          }
        };
      </script>
</section>