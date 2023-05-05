<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 text-white gap-6 max-w-[1360px] m-auto min-h-[800px] 575px:min-h-fit 890px:flex 890px:flex-col bg-light p-6 mb-6">
        <div wire:loading wire:target="checkout" class="fixed left-[45%] 575px:left-0 bottom-3">
            <div class="flex items-center bg-black text-white p-6 rounded-lg"><img src="https://api.iconify.design/svg-spinners:ring-resize.svg?color=%23ffffff" alt="Loading Icon"> <span class="ml-2">Processing...</span></div>
        </div>
        <div class="bg-cover bg-center relative rounded-lg flex justify-center items-center 890px:min-h-[800px] h-full" id="backDiv">
            <span class="fixed bg-main rounded-lg p-3 bottom-3 z-10 right-3 text-gray-800 text-4xl font-semibold z-50"><span class="text-2xl">$</span>{{ $total_price }}</span>
            
            <div wire:click="$set('dark_mode', {{ !$dark_mode }})" class=" @if (!$dark_mode) bg-white @else bg-gray-800 @endif p-3 rounded-lg absolute top-2 left-2">
                @if (!$dark_mode)
                    <img src="https://api.iconify.design/mdi:lightbulb-on.svg?color=%23e4aa0c" width="35" alt="Sun Image">
                @else
                    <img src="https://api.iconify.design/mdi:lightbulb-on.svg?color=%23ffffff" width="35" alt="Moon Image">
                @endif
            </div>

            <div class="absolute top-2 right-2">
                <div class="flex items-center">
                    <div class="flex mr-1">
                        <div class="bg-gray-800 p-1 rounded-lg mb-1 cursor-pointer h-fit mr-1" wire:click="upSize">
                            <img src="https://api.iconify.design/material-symbols:add-rounded.svg?color=%23ffffff" width="30" alt="">
                        </div>
                        <div class="bg-gray-800 p-1 rounded-lg cursor-pointer h-fit" wire:click="downSize">
                            <img src="https://api.iconify.design/ic:outline-remove.svg?color=%23ffffff" width="30" alt="">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="bg-gray-800 p-1 rounded-lg mb-1 cursor-pointer" wire:click="upHeight">
                            <img src="https://api.iconify.design/ic:outline-keyboard-arrow-up.svg?color=%23ffffff" width="30" alt="">
                        </div>
                        <div class="bg-gray-800 p-1 rounded-lg cursor-pointer" wire:click="downHeight">
                            <img src="https://api.iconify.design/ic:outline-keyboard-arrow-down.svg?color=%23ffffff" width="30" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <input type="range" id="move" name="move" min="-400" value="0" max="400" class="absolute rotate-90" style="right:-280px; width: 600px; height: 5px">
            
            <div class="flex flex-col {{ $alignment }}" id="main-text">
                <span class="text-white {{ $font }} font-semibold" 
                style="@if (!$dark_mode) text-shadow:
                {{ $color }} 0px 0px 5px,
                {{ $color }} 0px 0px 10px,
                {{ $color }} 0px 0px 20px,
                {{ $color }} 0px 0px 30px,
                {{ $color }} 0px 0px 40px,
                {{ $color }} 0px 0px 55px,
                {{ $color }} 0px 0px 75px; @endif font-size: {{ $size }}px;">{{ $line1 }}</span>
                @if ($line2)
                <span class="text-white {{ $font2 }} font-semibold" 
                style="@if (!$dark_mode) text-shadow:
                    {{ $color2 }} 0px 0px 5px,
                    {{ $color2 }} 0px 0px 10px,
                    {{ $color2 }} 0px 0px 20px,
                    {{ $color2 }} 0px 0px 30px,
                    {{ $color2 }} 0px 0px 40px,
                    {{ $color2 }} 0px 0px 55px,
                    {{ $color2 }} 0px 0px 75px; @endif font-size: {{ $size }}px; margin-top: {{ $leading }}px">{{ $line2 }}</span>
                @endif
                @if ($line3)
                    <span class="text-white {{ $font3 }} font-semibold" 
                    style="@if (!$dark_mode) text-shadow:
                    {{ $color3 }} 0px 0px 5px,
                    {{ $color3 }} 0px 0px 10px,
                    {{ $color3 }} 0px 0px 20px,
                    {{ $color3 }} 0px 0px 30px,
                    {{ $color3 }} 0px 0px 40px,
                    {{ $color3 }} 0px 0px 55px,
                    {{ $color3 }} 0px 0px 75px; @endif font-size: {{ $size }}px; margin-top: {{ $leading }}px">{{ $line3 }}</span>
                @endif
            </div>

            <div class="flex items-center justify-between absolute w-full bottom-0 p-3">
                <input type="color" class="hidden" id="color" onchange="change()">
                <label for="color" class="bg-white p-3 rounded-full"><img width="30" src="https://api.iconify.design/nimbus:color-palette.svg?color=%230d92f8" alt="Palet Icon"></label>
                <div class="px-2">
                    <label for="photo" class="flex items-center"><span class="mr-2 text-white font-semibold 400px:hidden">Upload Your Own Image</span><img src="https://api.iconify.design/line-md:uploading-loop.svg?color=%23ffffff" width="40" alt="Upload"></label>
                    <input type="file" id="photo" accept="image/*" onchange="loadFile(event)" class="hidden">
                </div>
            </div>
        </div>
        <form wire:submit.prevent="checkout" method="POST" class="text-sm max-h-[900px] overflow-y-scroll 850px:max-h-full px-6 py-6 850px:px-0 850px:overflow-y-hidden">
            <div class="flex items-center justify-between 490px:flex-col">
                <h1 class="text-main font-bold text-3xl mb-3">Design Your Neon</h1>
                <div class="flex items-center">
                    <img wire:click="$set('alignment', 'items-center')" src="https://api.iconify.design/material-symbols:format-align-center.svg?color=%23FFFFFF" class="p-2 rounded-lg bg-dark mr-2" alt="Alignment Icon" width="50">
                    <img wire:click="$set('alignment', 'items-start')" src="https://api.iconify.design/ic:baseline-format-align-left.svg?color=%23FFFFFF" class="p-2 rounded-lg bg-dark mr-2" alt="Alignment Icon" width="50">
                    <img wire:click="$set('alignment', 'items-end')" src="https://api.iconify.design/ic:baseline-format-align-right.svg?color=%23FFFFFF" class="p-2 rounded-lg bg-dark" alt="Alignment Icon" width="50">
                </div>
            </div>
            @if (session('failed'))
                <p class="text-white p-6 fixed bottom-2 left-2 z-20 rounded-lg bg-red-700 mb-3 border-red-600 border">{{ session('failed') }}</p>
            @endif
            <div class="py-2">
                <h2 class="font-bold text-lg">Text Line & Size Options</h2>
                <div class="mt-1">
                    <select wire:model="Select" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
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
            <div class="p-6 bg-[#1E1E1E] rounded-lg mb-5">
                <h2 class="font-bold text-lg">Line One Text</h2>
                <input type="text" wire:model.debounce.1000ms="line1" placeholder="Text Line One" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                @if (session('lineCount1'))
                    <p class="text-red-600 mb-2">{{ session('lineCount1') }}</p>
                @endif
                <div class="py-2">
                    <h2 class="font-bold mb-2 text-lg">Choose Line-1 Font</h2>
                    <div class="grid grid-cols-2 gap-2 475px:grid-cols-1">
                        @foreach ($fonts as $fonty)
                            <div class="p-3 cursor-pointer rounded-lg text-center border text-lg capitalize {{ $fonty }} @if ($font == $fonty) border-main @else border-white/10 @endif" wire:click="$set('font', '{{ $fonty }}')">
                                {{ $fonty }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="py-2">
                    <h2 class="font-bold mb-2 text-lg">Choose a colour</h2>
                    <div class="flex flex-wrap">
                        @foreach ($colors as $item)
                            <div wire:click="$set('color', '{{ $item }}')" class="rounded-full m-2" style="@if($color == $item) border: 2px {{ $item }} solid; @endif">
                                <span class="flex p-2 cursor-pointer rounded-full flex-col border border-white shadow-md" style="background-color: {{ $item }};"></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if ($line_count >= 2)
                <div class="p-6 bg-[#1E1E1E] rounded-lg mb-5">
                    <h2 class="font-bold text-lg">Line Two Text</h2>
                    <input type="text" wire:model.debounce.1000ms="line2" placeholder="Text Line Two" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                    @if (session('lineCount2'))
                        <p class="text-red-600 mb-2">{{ session('lineCount2') }}</p>
                    @endif
                    <div class="py-2">
                        <h2 class="font-bold mb-2 text-lg">Choose Line-2 Font</h2>
                        <div class="grid grid-cols-2 gap-2 475px:grid-cols-1">
                            @foreach ($fonts as $fonty)
                                <div class="p-3 cursor-pointer rounded-lg text-center border text-lg capitalize {{ $fonty }} @if ($font2 == $fonty) border-main @else border-white/10 @endif" wire:click="$set('font2', '{{ $fonty }}')">
                                    {{ $fonty }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="py-2">
                        <h2 class="font-bold mb-2 text-lg">Choose a colour</h2>
                        <div class="flex flex-wrap">
                            @foreach ($colors as $item)
                                <div wire:click="$set('color2', '{{ $item }}')" class="rounded-full m-2" style="@if($color2 == $item) border: 2px {{ $item }} solid; @endif">
                                    <span class="flex p-2 cursor-pointer rounded-full flex-col border border-white shadow-md" style="background-color: {{ $item }};"></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if ($line_count == 3)
               <div class="p-6 bg-[#1E1E1E] rounded-lg mb-5">
                    <h2 class="font-bold text-lg">Line Three Text</h2>
                    <input type="text" wire:model.debounce.1000ms="line3" placeholder="Text Line Three" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                    @if (session('lineCount3'))
                        <p class="text-red-600 mb-2">{{ session('lineCount3') }}</p>
                    @endif
                    <div class="py-2">
                        <h2 class="font-bold mb-2 text-lg">Choose Line-3 Font</h2>
                        <div class="grid grid-cols-2 gap-2 475px:grid-cols-1">
                            @foreach ($fonts as $fonty)
                                <div class="p-3 cursor-pointer rounded-lg text-center border text-lg capitalize {{ $fonty }} @if ($font3 == $fonty) border-main @else border-white/10 @endif" wire:click="$set('font3', '{{ $fonty }}')">
                                    {{ $fonty }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="py-2">
                        <h2 class="font-bold mb-2 text-lg">Choose a colour</h2>
                        <div class="flex flex-wrap">
                            @foreach ($colors as $item)
                                <div wire:click="$set('color3', '{{ $item }}')" class="rounded-full m-2" style="@if($color3 == $item) border: 2px {{ $item }} solid; @endif">
                                    <span class="flex p-2 cursor-pointer rounded-full flex-col border border-white shadow-md" style="background-color: {{ $item }};"></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
               </div>
            @endif

            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Neon Strip Color When Light Off</h2>
                <div wire:click="$set('jacket', 'colored')" class="flex p-3 bg-dark cursor-pointer rounded-md flex-col mb-3 border @if ($jacket == 'colored') border-main @else border-gray-800 @endif">
                    <p class="font-semibold mb-2">Similar Color as Light Color</p>
                    <span class="text-gray-500 text-sm">The tube will be colored when turned off.</span>
                </div>
                <div wire:click="$set('jacket', 'white')" class="flex p-3 bg-dark cursor-pointer rounded-md flex-col mb-3 border @if ($jacket == 'white') border-main @else border-gray-800 @endif">
                    <p class="font-semibold mb-2">Milky White</p>
                    <span class="text-gray-500 text-sm">Your sign will be white when turned off.</span>
                </div>
            </div>

            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Backboard Style *{{ $background }}</h2>
                <div class="py-3">
                    @foreach ($shapes as $item)
                        <div wire:click="$set('shape', '{{ $item->shape }}')" class="flex bg-dark mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($shape ==  $item->shape) border-main @else border-gray-800 @endif">
                            <p class="font-semibold mb-2">{{ $item->shape }} (${{ $item->price }})</p>
                            <span class="text-gray-500 text-sm">{{ $item->description }}</span>
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
                <h2 class="font-bold text-lg">Remote and Dimmer *{{ $remote }}</h2>
                <p class="text-gray-500 text-sm">A remote and dimmer is included free with every sign! (Except for Multicolor Neon Signs, which are controlled by the APP)</p>
                <div class="py-3 w-full">
                    <select name="remote" id="remote" wire:model="remote" class="bg-dark flex items-center w-full justify-center p-3 cursor-pointer rounded-md flex-col border">
                        @foreach ($remotes as $item)
                            <option value="{{ $item->type }}">{{ $item->type }} - ${{ $item->price }}</option>  
                         @endforeach 
                    </select>
                </div>
            </div>
            @error('remote')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror
            <div class="py-2">
                <h2 class="font-bold text-lg">Installation Kit *{{ $kit }}</h2>
                <div class="py-3 w-full">
                    <select name="kit" id="kit" wire:model="kit" class="bg-dark flex items-center w-full justify-center p-3 cursor-pointer rounded-md flex-col border">
                        @foreach ($kits as $item)
                            <option value="{{ $item->name }}">{{ $item->name }} - ${{ $item->price }}</option>  
                         @endforeach 
                    </select>
                </div>
            </div>
            @error('kit')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror

            <input type="number" min="5" wire:model.debounce.500ms="phone" placeholder="Phone Number (shipping purpose)" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @error('phone')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror

            <input type="text" wire:model.debounce.500ms="email" placeholder="Email Address" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @error('email')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror
            <button class="submit-btn" type="submit"><span class="mr-2 text-xl">Checkout</span> <img src="{{ asset('assets/images/stripe_small.png') }}" width="50" alt="Stripe Logo"></button>
        </form>
        <p class="p-6 col-span-2 border-l border-gray-400 bg-light text-white mb-6 leading-6">We're pleased to offer Stripe as our payment system, providing you with a secure and reliable way to make payments. With Stripe, your credit card information is kept safe and secure, as we don't store it on our servers. We only collect your email address for communication purposes, and we never share your personal information with third parties. Stripe's user-friendly interface allows for seamless payments, giving you peace of mind and a smooth payment experience. Thank you for choosing to shop with us!</p>
    </div>
    <section class="bg-light">
        <x-listing />
    </section>
    <section class="bg-dark">
        <x-f-a-q />
    </section>
    <img id="output"/>
    
    <script>
        const color = document.getElementById('color');
        var output = document.getElementById('backDiv');

        const text = document.getElementById('main-text');
        const move = document.getElementById('move');

        const text1 = document.getElementById('text1');
        const text2 = document.getElementById('text2');

        output.style.backgroundColor = "#000000";

        var loadFile = function(event) {
          output.style.backgroundColor = "transparent";
          output.style.backgroundImage = `url(${URL.createObjectURL(event.target.files[0]).toString()})`;
          output.onload = function() {
            var myURL = URL.revokeObjectURL(output.src)
            console.log(myURL)
          }
        };
        function change(){
            output.style.backgroundColor = color.value;
        }

        move.oninput = function() {
            text.style.transform = `translateY(${move.value}px)`;
        }
      </script>
</section>