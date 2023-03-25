<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 gap-6 max-w-[1360px] m-auto min-h-[800px] px-4 890px:grid-cols-1">
        <div class="bg-cover bg-center relative rounded-lg flex justify-center 890px:min-h-[800px]" style="background-image: url({{ asset('assets/images/background/'.$image_select) }})">
            <span class="absolute top-3 right-3 text-white text-4xl">$ {{ $total_price }}</span>
            
            <div wire:click="$set('dark_mode', {{ !$dark_mode }})" class=" @if (!$dark_mode) bg-white @else bg-gray-800 @endif p-3 rounded-lg absolute top-2 left-2">
                @if (!$dark_mode)
                    <img src="https://api.iconify.design/line-md:moon-filled-alt-to-sunny-filled-loop-transition.svg?color=%23febc06" width="35" alt="Sun Image">
                @else
                    <img src="https://api.iconify.design/pepicons-pop:moon-filled.svg?color=%23febc06" width="35" alt="Moon Image">
                @endif
            </div>
            

            <span class="text-white {{ $font_select }} m-auto mt-[300px] text-center text-5xl font-semibold" @if (!$dark_mode) 
            style="text-shadow:
            0 0 7px {{ $color_select }},
            0 0 7px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }};" @endif>{{ $custom_text }}</span>
            <div class="absolute bottom-0 w-full p-3 grid grid-cols-5 gap-4">
                @foreach ($images as $image)
                    <span wire:click="$set('image_select', '{{ $image }}')" style='background-image: url({{ asset("assets/images/background/".$image ) }})' class="rounded-md h-[150px] bg-cover bg-center border @if($image_select == $image) border-main opacity-100 @else opacity-50 @endif"></span>
                @endforeach
            </div>
        </div>
        <form wire:submit.prevent="checkout" method="POST" class="text-sm max-h-[900px] overflow-scroll px-6 py-6">
            <h1 class="text-main font-bold text-3xl mb-3">Design Your Neon</h1>
            @if (session('failed'))
                <p class="text-white p-6 fixed bottom-2 left-2 z-20 rounded-lg bg-red-700 mb-3 border-red-600 border">{{ session('failed') }}</p>
            @endif
            
            <p wire:loading wire:target="calculate" class="text-orange-700 p-6 fixed bottom-2 left-2 z-20 rounded-lg bg-orange-700 mb-3 border-orange-600 border bg-opacity-40">Calculating</p>
            
            
            <h2 class="font-bold text-lg">Write your text</h2>
            <input type="text" wire:model.debounce.500ms="custom_text" placeholder="Custom Text" class="w-full mt-2 bg-white rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Choose a Jacket</h2>
                
                <div wire:click="$set('jacket', 'colored')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($jacket == 'colored') border-main @else border-gray-300 @endif">
                    <p class="font-semibold mb-2">Color-matching</p>
                    <span class="text-gray-500 text-sm">The tube will be colored when turned off.</span>
                </div>
                
                <div wire:click="$set('jacket', 'white')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($jacket == 'white') border-main @else border-gray-300 @endif">
                    <p class="font-semibold mb-2">White</p>
                    <span class="text-gray-500 text-sm">Your sign will be white when turned off.</span>
                </div>
            </div>

            <div class="py-2" x-data="{ open: false }">
                <h2 class="font-bold mb-2 text-lg">Choose Font</h2>
                <p class="p-3 border-gray-300 flex items-center justify-between bg-gray-100 rounded-md mb-3 capitalize" x-on:click="open = !open">{{ $font_select }} <img src="https://api.iconify.design/fe:drop-down.svg?color=%231e1f1e" width="30" alt="Carret Down Icon"></p>
                <div class="grid grid-cols-2 gap-4" x-show="open" x-cloak>
                    @foreach ($fonts as $font)
                    <div wire:click="$set('font_select', '{{ $font }}')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border  @if ($font_select == $font) border-main @else border-gray-300 @endif">
                        <p class="text-center text-2xl {{ $font }}">{{ $custom_text }}</p>
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
                <h2 class="font-bold mb-2 text-lg">Choose a size *{{ $size }}</h2>
                <p class="text-gray-500 text-sm mb-3">*Each sign is handcrafted, and sizes shown will be accurate within 1 or 2 inches. Neon sign larger than 47 inches will be made on two or more backboards that can be easily arranged together.</p>
                <div class="grid grid-cols-2 gap-4 whitespace-pre-wrap">
                    @foreach ($sizes as $item)
                        <div wire:click="$set('size', '{{ $item->size }}')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == $item->size) border-main @else border-gray-300 @endif">
                            <p class="font-semibold mb-2">{{ $item->size }}</p>
                            <span class="text-gray-500 text-sm">{{ $item->width }} inc / {{ $item->height }} Inc <span class="text-[10px]">(width / height)</span></span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Backboard Style *{{ $background }}</h2>
                <div class="py-3">
                    @foreach ($shapes as $shape)
                        <div wire:click="$set('background', '{{ $shape->shape }}')" class="flex mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($background ==  $shape->shape) border-main @else border-gray-300 @endif">
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
                        <div wire:click="$set('location', '{{ $loc }}')" class="flex mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == $loc) border-main @else border-gray-300 @endif">
                            <p class="font-semibold text-center">{{ $loc }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg">Power Adaptor *{{ $adaptor }}</h2>
                <div class="mt-1">
                    <select wire:model="adaptor" class="w-full mt-2 bg-white rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
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
                <h2 class="font-bold text-lg">Free Remote and Dimmer</h2>
                <p class="text-gray-500 text-sm mb-3">A remote and dimmer is included free with every sign! (Except for Multicolor Neon Signs, which are controlled by the APP)</p>
                <div class="py-3 grid grid-cols-2 gap-4">
                    @foreach ($remotes as $rItem)
                        <div wire:click="$set('remote', '{{ $rItem->type }}')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($remote == $rItem->type) border-main @else border-gray-300 @endif">
                            <p class="font-semibold text-center">{{ $rItem->type }} - ${{ $rItem->price }}</p>
                        </div>
                    @endforeach 
                </div>
            </div>
            <input type="text" wire:model.debounce.500ms="email" placeholder="Email Address" class="w-full mt-2 bg-white rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            <button class="py-3 text-center bg-main w-full text-white font-semibold rounded-md flex items-center justify-center" type="submit"><span class="mr-2 text-xl">Checkout</span> <img src="{{ asset('assets/images/stripe_small.png') }}" width="50" alt="Stripe Logo"></button>
        </form>
    </div>
</section>