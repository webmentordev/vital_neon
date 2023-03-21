<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 gap-6 max-w-[1360px] m-auto min-h-[800px]">
        <div class="bg-cover bg-center relative rounded-lg flex justify-center" style="background-image: url({{ asset('assets/images/background/'.$image_select) }})">
            <span class="text-white {{ $font_select }} m-auto mt-[250px] text-center text-6xl font-semibold" style="text-shadow:
            0 0 7px {{ $color_select }},
            0 0 7px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }},
            0 0 22px {{ $color_select }};">{{ $custom_text }}</span>
            <div class="absolute bottom-0 w-full p-3 grid grid-cols-5 gap-4">
                @foreach ($images as $image)
                    <span wire:click="changeImage('{{ $image }}')" style='background-image: url({{ asset("assets/images/background/".$image ) }})' class="rounded-md h-[150px] bg-cover bg-center border @if($image_select == $image) border-main opacity-100 @else opacity-50 @endif"></span>
                @endforeach
            </div>
        </div>
        <form wire:submit.prevent="createOrder" method="POST" class="text-sm max-h-[900px] overflow-scroll px-6 py-6">
            <h1 class="text-main font-bold text-3xl mb-3">Design Your Neon</h1>
            <h2 class="font-bold text-lg">Write your text</h2>
            <input type="text" wire:model.debounce.500ms="custom_text" placeholder="Custom Text" class="w-full mt-2 bg-white rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Choose a Jacket</h2>
                
                <div wire:click="changeJacket('colored')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($jacked == 'colored') border-main @else border-gray-300 @endif">
                    <p class="font-semibold mb-2">Color-matching</p>
                    <span class="text-gray-500 text-sm">The tube will be colored when turned off.</span>
                </div>
                
                <div wire:click="changeJacket('white')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($jacked == 'white') border-main @else border-gray-300 @endif">
                    <p class="font-semibold mb-2">White</p>
                    <span class="text-gray-500 text-sm">Your sign will be white when turned off.</span>
                </div>
            </div>

            <div class="py-2" x-data="{ open: false }">
                <h2 class="font-bold mb-2 text-lg">Choose Font</h2>
                <p class="p-3 border-gray-300 flex items-center justify-between bg-gray-100 rounded-md mb-3 capitalize" x-on:click="open = !open">{{ $font_select }} <img src="https://api.iconify.design/fe:drop-down.svg?color=%231e1f1e" width="30" alt="Carret Down Icon"></p>
                <div class="grid grid-cols-2 gap-4" x-show="open" x-cloak>
                    @foreach ($fonts as $font)
                    <div wire:click="changeFont('{{ $font }}')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border  @if ($font_select == $font) border-main @else border-gray-300 @endif">
                        <p class="text-center text-2xl {{ $font }}">{{ $custom_text }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Choose a colour</h2>
                <div class="flex flex-wrap">
                    @foreach ($colors as $color)
                        <div wire:click="changeColor('{{ $color }}')" class="rounded-full m-2" style="@if($color == $color_select) border: 2px {{ $color_select }} solid; @endif">
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
                        <div wire:click="changeSize('{{ $item->size }}')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == $item->size) border-main @else border-gray-300 @endif">
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
                        <div wire:click="changeBG('{{ $shape->shape }}')" class="flex mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($background ==  $shape->shape) border-main @else border-gray-300 @endif">
                            <p class="font-semibold mb-2">{{ $shape->shape }} (${{ $shape->price }})</p>
                            <span class="text-gray-500 text-sm">{{ $shape->description }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Location *{{ $location }}</h2>
                <div class="py-3 grid grid-cols-2 gap-4">
                    <div wire:click="changeLocation('in_door')" class="flex mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == 'in_door') border-main @else border-gray-300 @endif">
                        <p class="font-semibold text-center">InDoor</p>
                    </div>
                    <div wire:click="changeLocation('out_door')" class="flex mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == 'out_door') border-main @else border-gray-300 @endif">
                        <p class="font-semibold text-center">Outdoor (+20%) With Waterproof Technology</p>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg">Power Adaptor *{{ $adaptor }}</h2>
                <div class="mt-1">
                    <select wire:model="adaptor" class="w-full mt-2 bg-white rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        <option value="USA/Canada/120V" selected>USA/Canada/120V</option>
                        <option value="UK/IRELAND 230V">UK/IRELAND 230V</option>
                        <option value="EUROPE 230V">EUROPE 230V</option>
                        <option value="AUSTRALIA/NA">AUSTRALIA/NA 230V</option>
                        <option value="JAPAN 100V">JAPAN 100V</option>
                    </select>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg">Free Remote and Dimmer</h2>
                <p class="text-gray-500 text-sm mb-3">A remote and dimmer is included free with every sign! (Except for Multicolor Neon Signs, which are controlled by the APP)</p>
                <div class="py-3 grid grid-cols-2 gap-4">
                    <div wire:click="changeRemote('no')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($remote == 'no') border-main @else border-gray-300 @endif">
                        <p class="font-semibold text-center">No</p>
                    </div>
                    <div wire:click="changeRemote('yes')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($remote == 'yes') border-main @else border-gray-300 @endif">
                        <p class="font-semibold text-center">YES</p>
                    </div>
                </div>
            </div>

            <input type="text" wire:model.debounce.500ms="email" placeholder="Email Address" class="w-full mt-2 bg-white rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            <button class="py-3 text-center bg-main w-full text-white font-semibold rounded-md" type="submit">Checkout</button>
        </form>
    </div>
</section>