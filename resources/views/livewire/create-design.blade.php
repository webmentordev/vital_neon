<section class="w-full py-[10px]">
    <div class="grid grid-cols-5 text-white relative m-auto 890px:flex 890px:flex-col bg-dark p-6 mb-6">
        <div wire:loading wire:target="checkout" class="fixed left-[45%] 575px:left-0 bottom-3">
            <div class="flex items-center bg-black text-white p-6 rounded-lg"><img src="https://api.iconify.design/svg-spinners:ring-resize.svg?color=%23ffffff" alt="Loading Icon"> <span class="ml-2">Processing...</span></div>
        </div>
        <div class="bg-cover bg-center @if ($direction) col-span-5 relative @else sticky col-span-3 @endif top-0 890px:static left-0 rounded-lg flex justify-center items-center h-[970px] w-full 890px:relative 890px:min-h-[970px]" style="background-image: url({{ $backgroundImage }})" id="backDiv">
            
            @if ($total_price != 0)
                <span class="fixed bg-main rounded-lg p-3 bottom-3 left-3 text-gray-800 text-4xl font-semibold z-50"><span class="text-2xl">$</span>{{ $total_price }}</span>
            @endif
            
            <div wire:click="$set('dark_mode', {{ !$dark_mode }})" class=" @if (!$dark_mode) bg-white @else bg-gray-800 @endif p-3 rounded-lg absolute top-2 left-2">
                @if (!$dark_mode)
                    <img src="https://api.iconify.design/mdi:lightbulb-on.svg?color=%23e4aa0c" width="35" alt="Sun Image">
                @else
                    <img src="https://api.iconify.design/mdi:lightbulb-on.svg?color=%23ffffff" width="35" alt="Moon Image">
                @endif
            </div>

            <div wire:click="$set('direction', {{ !$direction }})" class="bg-white p-[14px] rounded-lg absolute top-[10px] left-[72px]">
                <img src="https://api.iconify.design/akar-icons:full-screen.svg?color=%23e4aa0c" width="30" alt="Sun Image">
            </div>

            <div class="absolute top-2 right-2">
                <div class="flex items-center">
                    <div class="flex mr-1">
                        <div class="bg-gray-800 p-1 rounded-lg mb-1 cursor-pointer h-fit mr-1" wire:click="$set('size', {{ $this->size + 10 }})">
                            <img src="https://api.iconify.design/material-symbols:add-rounded.svg?color=%23ffffff" width="30" alt="">
                        </div>
                        <div class="bg-gray-800 p-1 rounded-lg cursor-pointer h-fit" wire:click="$set('size', {{ $this->size - 10 }})">
                            <img src="https://api.iconify.design/ic:outline-remove.svg?color=%23ffffff" width="30" alt="">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="bg-gray-800 p-1 rounded-lg mb-1 cursor-pointer" wire:click="$set('leading', {{ $this->leading + 10 }})">
                            <img src="https://api.iconify.design/ic:outline-keyboard-arrow-up.svg?color=%23ffffff" width="30" alt="">
                        </div>
                        <div class="bg-gray-800 p-1 rounded-lg cursor-pointer" wire:click="$set('leading', {{ $this->leading - 10 }})">
                            <img src="https://api.iconify.design/ic:outline-keyboard-arrow-down.svg?color=%23ffffff" width="30" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col {{ $alignment }}" id="main-text">
                <span class="text-white {{ $font }} font-semibold" 
                style="@if (!$dark_mode) text-shadow:
                {{ $color }} 0px 0px 5px,
                {{ $color }} 0px 0px 10px,
                {{ $color }} 0px 0px 20px,
                {{ $color }} 0px 0px 30px,
                {{ $color }} 0px 0px 40px,
                {{ $color }} 0px 0px 55px,
                {{ $color }} 0px 0px 75px; @endif font-size: {{ $size }}px;">{{ $line1 ? $line1 : "Text Here" }}</span>
                @if ($line2)
                <span class="text-white {{ $font }} font-semibold" 
                style="@if (!$dark_mode) text-shadow:
                    {{ $color }} 0px 0px 5px,
                    {{ $color }} 0px 0px 10px,
                    {{ $color }} 0px 0px 20px,
                    {{ $color }} 0px 0px 30px,
                    {{ $color }} 0px 0px 40px,
                    {{ $color }} 0px 0px 55px,
                    {{ $color }} 0px 0px 75px; @endif font-size: {{ $size }}px; margin-top: {{ $leading }}px">{{ $line2 }}</span>
                @endif
                @if ($line3)
                    <span class="text-white {{ $font }} font-semibold" 
                    style="@if (!$dark_mode) text-shadow:
                    {{ $color }} 0px 0px 5px,
                    {{ $color }} 0px 0px 10px,
                    {{ $color }} 0px 0px 20px,
                    {{ $color }} 0px 0px 30px,
                    {{ $color }} 0px 0px 40px,
                    {{ $color }} 0px 0px 55px,
                    {{ $color }} 0px 0px 75px; @endif font-size: {{ $size }}px; margin-top: {{ $leading }}px">{{ $line3 }}</span>
                @endif
            </div>

            <div class="flex items-center justify-between absolute w-full bottom-0 p-3 530px:flex-col">
                {{-- <input type="color" class="hidden" id="color" onchange="change()">
                <label for="color" class="bg-white p-3 rounded-full"><img width="30" src="https://api.iconify.design/nimbus:color-palette.svg?color=%230d92f8" alt="Palet Icon"></label> --}}
                
                <input type="range" id="move" name="move" min="-400" max="400" value="0" class="530px:mb-3 w-[200px] h-[5px] 530px:w-full">
                
                <div class="px-2">
                    <label for="photo" class="flex items-center"><span class="mr-2 text-white font-semibold">Upload Your Own Image</span><img src="https://api.iconify.design/line-md:uploading-loop.svg?color=%23ffffff" width="40" alt="Upload"></label>
                    <input type="file" id="photo" accept="image/*" onchange="loadFile(event)" class="hidden">
                </div>
            </div>
        </div>
        <form wire:submit.prevent="checkout" method="POST" class="bg-light inline-block @if ($direction) col-span-5 @else col-span-2 @endif text-sm w-full px-6 py-6 850px:p-3 850px:overflow-y-hidden">
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
                <h2 class="font-bold text-lg">Select number of lines and size <span class="text-red-600">*</span></h2>
                @error('line_check')
                    <p class="text-red-600 mb-2">{{ $message }}</p>
                @enderror
                <div class="mt-1">
                    <select wire:model="Select" class="w-full mt-2 bg-dark rounded border border-main focus:ring-4 text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        <option value="" selected>——Please select here——</option>
                        @foreach ($lines as $line)
                            <option value="{{ $line->name }}">{{ $line->name }} - ${{ $line->price + ($line->price * ($increment / 100)) }}</option>
                        @endforeach
                        <option value="custom">Custom Lines and Size</option>
                    </select>
                    @error('Select')
                    <p class="text-red-600 mb-2">{{ $message }}</p>
                @enderror
                </div>
            </div>
            
           <div class="p-6 rounded-lg bg-dark">
            
            <h2 class="font-bold text-lg">Text For Each Line:</h2>
            <input type="text" wire:model.debounce.1000ms="line1" placeholder="Line 1 text" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @error('line1')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror
            @if (session('lineCount1'))
                <p class="text-red-600 mb-2">{{ session('lineCount1') }}</p>
            @endif
            @if ($line_count >= 2)
                @error('line2')
                    <p class="text-red-600 mb-2">{{ $message }}</p>
                @enderror
                <input type="text" wire:model.debounce.1000ms="line2" placeholder="Line 2 text" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                @if (session('lineCount2'))
                    <p class="text-red-600 mb-2">{{ session('lineCount2') }}</p>
                @endif
            @endif
            @if ($line_count == 3)
                @error('line3')
                    <p class="text-red-600 mb-2">{{ $message }}</p>
                @enderror
                <input type="text" wire:model.debounce.1000ms="line3" placeholder="Line 3 text" class="w-full mt-2 bg-dark rounded border focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                @if (session('lineCount3'))
                    <p class="text-red-600 mb-2">{{ session('lineCount3') }}</p>
                @endif
            @endif
            <div class="grid grid-cols-3 gap-2 1210px:grid-cols-2 870px:grid-cols-3 575px:grid-cols-2 475px:grid-cols-1">
                @foreach ($fonts as $fonty)
                <div class="p-3 cursor-pointer rounded-lg text-center border text-lg capitalize {{ $fonty }} @if ($font == $fonty) border-main @else border-white/10 @endif" wire:click="$set('font', '{{ $fonty }}')">
                    {{ $fonty }}
                </div>
                @endforeach
            </div>
            <div class="py-2">
                <div class="flex flex-wrap">
                    @foreach ($colors as $item)
                        <div wire:click="$set('color', '{{ $item }}')" class="rounded-full m-2" style="@if($color == $item) border: 2px {{ $item }} solid; @endif">
                            <span class="flex p-2 cursor-pointer rounded-full flex-col border border-white shadow-md" style="background-color: {{ $item }};"></span>
                        </div>
                    @endforeach
                </div>
            </div>
           </div>

            <div class="py-2">
                <h2 class="font-bold text-lg mb-3 group relative flex items-center w-fit">Backboard Style <img src="https://api.iconify.design/ant-design:exclamation-circle-twotone.svg?color=%23b0b0b0" width="20" class="mx-2 -translate-y-[2px]" title="Backboard Style Idea Icon" alt="Backboard Style Idea Icon"> <span class="text-main">* {{ $shape }}</span><img class="absolute left-0 top-6 hidden group-hover:block" src="{{ asset('assets/back_cut.jpg') }}" width="300px" title="Backboard Style" alt="Neon Backboard Style"></h2>
                <div class="py-3">
                    <select name="shape" id="shape" wire:model="shape" class="bg-dark flex items-center w-full justify-center p-3 cursor-pointer rounded-md flex-col border">
                        <option value="" selected>— Select the shape —</option>  
                        @foreach ($shapes as $item)
                            <option value="{{ $item->shape }}">{{ $item->shape }}</option>  
                         @endforeach 
                    </select>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg mb-1">Location <span class="text-main">* {{ $location }}</span></h2>
                <div class="py-3 grid grid-cols-2 gap-4">
                    @foreach ($locations as $loc)
                        <div wire:click="$set('location', '{{ $loc }}')" class="flex bg-dark mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == $loc) border-main @else border-gray-800 @endif">
                            <p class="font-semibold text-center">{{ $loc }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <input type="number" min="5" wire:model.debounce.500ms="phone" placeholder="Phone Number (shipping purpose)" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @error('phone')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror

            <input type="text" wire:model.debounce.500ms="address" placeholder="Shipping Address (Street, County, Postal Code, Country)" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @error('address')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror

            <input type="text" wire:model.debounce.500ms="email" placeholder="Email Address" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
            @error('email')
                <p class="text-red-600 mb-2">{{ $message }}</p>
            @enderror
            <button class="py-3 px-4 w-full bg-white rounded-md font-bold text-dark" type="submit">Checkout</button>
            <div class="flex justify-between 530px:flex-col items-center w-full mt-2 py-3">
                <img src="{{ asset('assets/images/payment_cards.png') }}" width="190px" alt="Stripe Payment methods icon">
                <img src="{{ asset('assets/images/stripe_square_logo.png') }}" width="190px" alt="Powerd by stipe image">
            </div>
        </form>
    </div>
    <section class="max-w-[1366px] m-auto">
        <p class="p-6 col-span-2 border-l border-gray-400 bg-light text-white mb-6 leading-6">We're pleased to offer Stripe as our payment system, providing you with a secure and reliable way to make payments. With Stripe, your credit card information is kept safe and secure, as we don't store it on our servers. We only collect your email address for communication purposes, and we never share your personal information with third parties. Stripe's user-friendly interface allows for seamless payments, giving you peace of mind and a smooth payment experience. Thank you for choosing to shop with us!</p>
    </section>

    <section class="bg-light">
        <div class="max-w-6xl m-auto py-[120px] px-4">
            <h2 class="text-4xl mb-3 text-white font-semibold">How to create Custom Neon Sign?</h2>
            <div class="grid grid-cols-2 gap-6 mb-6 710px:grid-cols-1 m-auto">
                <div class="p-3 border border-white/10 px-6 py-12 text-white rounded-lg bg-dark hover:bg-white group transition-all">
                    <h3 class="mb-2 text-2xl font-semibold group-hover:text-gray-700 flex items-center">Lines Based Pricing <img data-src="https://api.iconify.design/noto:dollar-banknote.svg" class="ml-2 lazyload" loading="lazy" width="35" alt="Delivery Icon"></h3>
                    <p class="group-hover:text-gray-700 text-white/70">You have the option to select the size and number of characters per line, ensuring that you don't get overpriced. If you desire a larger neon sign than what is mentioned, feel free to contact us</p>
                </div>

                <div class="p-3 border border-white/10 px-6 py-12 text-white rounded-lg bg-dark hover:bg-white group transition-all">
                    <h3 class="mb-2 text-2xl font-semibold group-hover:text-gray-700 flex items-center">Neon Fonts Style <img data-src="https://api.iconify.design/vscode-icons:folder-type-fonts-opened.svg?color=%23413e3e" class="ml-2 lazyload" loading="lazy" width="35" alt="Delivery Icon"></h3>
                    <p class="group-hover:text-gray-700 text-white/70">You have the option to select the font style for each line and character. We offer more than 40 fonts, and the selection is continuously expanding to provide you with various options</p>
                </div>

                <div class="p-3 border border-white/10 px-6 py-12 text-white rounded-lg bg-dark hover:bg-white group transition-all">
                    <h3 class="mb-2 text-2xl font-semibold group-hover:text-gray-700 flex items-center">Local Power Adaptors <img data-src="https://api.iconify.design/fluent-emoji-flat:battery.svg" class="ml-2 lazyload" loading="lazy" width="35" alt="Delivery Icon"></h3>
                    <p class="group-hover:text-gray-700 text-white/70">All neon signs come with a free power adapter. You have a variety of choices to select from your local power adapters. Please verify the kind of adapter that aligns with your energy laws</p>
                </div>

                <div class="p-3 border border-white/10 px-6 py-12 text-white rounded-lg bg-dark hover:bg-white group transition-all">
                    <h3 class="mb-2 text-2xl font-semibold group-hover:text-gray-700 flex items-center">Water Resistant <img data-src="https://api.iconify.design/fxemoji:sunraincloud.svg" class="ml-2 lazyload" loading="lazy" width="35" alt="Delivery Icon"></h3>
                    <p class="group-hover:text-gray-700 text-white/70">You get the option to select if you want the Indoor neon sign which is cheap but not water resistant and Outdoor option which is Water resistant but comes at extra cost</p>
                </div>

                <div class="p-3 border border-white/10 px-6 py-12 text-white rounded-lg bg-dark hover:bg-white group transition-all">
                    <h3 class="mb-2 text-2xl font-semibold group-hover:text-gray-700 flex items-center">Dimmer Controller <img data-src="https://api.iconify.design/twemoji:light-bulb.svg" class="ml-2 lazyload" loading="lazy" width="35" alt="Delivery Icon"></h3>
                    <p class="group-hover:text-gray-700 text-white/70">We offer three different types of dimmers, <b>Simple Dimmer</b>: Adjusts the lighting intensity. <b>Remote Dimmer</b>: Controls various lighting effects. <b>RGB Dimmer</b>: Changes the color of your neon sign</p>
                </div>

                <div class="p-3 border border-white/10 px-6 py-12 text-white rounded-lg bg-dark hover:bg-white group transition-all">
                    <h3 class="mb-2 text-2xl font-semibold group-hover:text-gray-700 flex items-center">Neon Installation Kits <img data-src="https://api.iconify.design/twemoji:light-bulb.svg" class="ml-2 lazyload" loading="lazy" width="35" alt="Delivery Icon"></h3>
                    <p class="group-hover:text-gray-700 text-white/70">We offer three types of installation kits, <b>Screw Fixation (Free)</b>: Basic installation using screws, <b>Hinge Suspension or Both</b>: Options for dynamic and versatile installations. <b>Acrylic Stand</b>: An alternative stand option for your neon sign.</p>
                </div>
            </div>
        </div>
    </section>

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
          var myImageURL = URL.createObjectURL(event.target.files[0]).toString();
          console.log(event.target.files[0]);
          output.style.backgroundImage = `url(${myImageURL})`;
          document.cookie = `myimageurl=${myImageURL}`;
        
            //   output.onload = function() {
            //     var myURL = URL.revokeObjectURL(output.src)
            //     console.log(myURL)
            //   }
        };

        function change(){
            output.style.backgroundColor = color.value;
        }

        move.oninput = function() {
            text.style.transform = `translateY(${move.value}px)`;
        }
      </script>
</section>