<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 gap-6 max-w-6xl m-auto min-h-[800px]">
        <div class="bg-cover bg-center rounded-lg flex items-center justify-center" style="background-image: url({{ asset('assets/images/dark_wall.jpg') }})">
            <span class="neonText text-7xl font-semibold">{{ $custom_text }}</span>
        </div>
        <form wire:submit.prevent="createOrder" method="POST" class="text-sm max-h-[900px] overflow-scroll px-6">
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

            <div class="py-2">
                <h2 class="font-bold mb-2 text-lg">Choose Font</h2>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($fonts as $font)
                    <div wire:click="changeFont('{{ $font }}')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($font_select == '{{ $font }}') border-main @else border-gray-300 @endif">
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
                <div class="grid grid-cols-2 gap-4">
                    <div wire:click="changeSize('small')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == 'small') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Small</p>
                        <span class="text-gray-500 text-sm">66.84cmx20.87cm/26.32inx8.22in</span>
                    </div>

                    <div wire:click="changeSize('medium')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == 'medium') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Medium</p>
                        <span class="text-gray-500 text-sm">92.24cmx28.80cm/36.32inx 11.34in</span>
                    </div>

                    <div wire:click="changeSize('large')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == 'large') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Large</p>
                        <span class="text-gray-500 text-sm">116.97cmx 36.53cm/46.05inx 14.38in</span>
                    </div>

                    <div wire:click="changeSize('x-large')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == 'x-large') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">X Large</p>
                        <span class="text-gray-500 text-sm">143.71cmx44.88cm/56.58inx 17.67in</span>
                    </div>

                    <div wire:click="changeSize('supersized')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($size == 'supersized') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Supersized</p>
                        <span class="text-gray-500 text-sm">233.94cmx73.05cm/92.10inx28.76in</span>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-boldtext-lg mb-3">Backboard Style *{{ $background }}</h2>
                <div class="py-3">
                    <div wire:click="changeBG('cut_to_shape')" class="flex mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($background == 'cut_to_shape') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Cut to shape</p>
                        <span class="text-gray-500 text-sm">The backboard will be shaped in line with the letters. Compared to the cut-to-letter backing, it provides greater support to the neon sign while also lending a stylish and modern appearance.</span>
                    </div>

                    <div wire:click="changeBG('cut_to_letter')" class="flex mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($background == 'cut_to_letter') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Cut to letter</p>
                        <span class="text-gray-500 text-sm">The backboard will closely follow the pattern of the preferred font size and style. It provides a minimalistic appearance, making it perfect for interior decoration.</span>
                    </div>

                    <div wire:click="changeBG('cut_to_rectangle')" class="flex mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($background == 'cut_to_rectangle') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Cut to rectangle (+$20.00)</p>
                        <span class="text-gray-500 text-sm">The backboard will be cut rectangularly like a frame. It offers the greatest stability for LED neon signs due to its larger backing surface, making it ideal for outdoor use and sturdier framing needs.</span>
                    </div>

                    <div wire:click="changeBG('stand')" class="flex p-3 cursor-pointer rounded-md flex-col border @if ($background == 'stand') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Stand (+$30.00)</p>
                        <span class="text-gray-500 text-sm">Make your sign upright on the floor or desk. Lightweight and portable, you can easily place them anywhere you need them.</span>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Choose a background Color</h2>
                <p class="capitalize">{{ $bgColor }}</p>
                <div class="py-3 grid grid-cols-4 gap-4">
                    <div wire:click="changeBGColor('none')" class="flex mb-4 items-center w-full h-[50px] bg-cover bg-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($bgColor == 'none') border-main @else border-gray-300 @endif" style="background-image: url('https://d1no4rdxmwcuog.cloudfront.net/files/NU9kHUypVKu7GgDjpRPg_.png')">
                    </div>
                    <div wire:click="changeBGColor('white')" class="flex mb-4 items-center w-full h-[50px] bg-cover bg-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($bgColor == 'white') border-main @else border-gray-300 @endif" style="background-image: url('https://d1no4rdxmwcuog.cloudfront.net/files/rqGyW704bxMZm410Pcqtp.png')">
                    </div>
                    <div wire:click="changeBGColor('black')" class="flex mb-4 items-center w-full h-[50px] bg-cover bg-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($bgColor == 'black') border-main @else border-gray-300 @endif" style="background-image: url('https://d1no4rdxmwcuog.cloudfront.net/files/f7GuJ7845qruhQRXU7yZY.png')">
                    </div>
                    <div wire:click="changeBGColor('silver')" class="flex mb-4 items-center w-full h-[50px] bg-cover bg-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($bgColor == 'silver') border-main @else border-gray-300 @endif" style="background-image: url('https://d1no4rdxmwcuog.cloudfront.net/files/vkdGCK-IclQBnW8eATwm3.png')">
                    </div>
                    <div wire:click="changeBGColor('gold')" class="flex mb-4 items-center w-full h-[50px] bg-cover bg-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($bgColor == 'gold') border-main @else border-gray-300 @endif" style="background-image: url('https://d1no4rdxmwcuog.cloudfront.net/files/qiQZkeRsQdd2PWwzZvPl6.png')">
                    </div>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg mb-3">Location *{{ $location }}</h2>
                <div class="py-3 grid grid-cols-2 gap-4">
                    <div wire:click="changeLocation('out_door')" class="flex mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == 'out_door') border-main @else border-gray-300 @endif">
                        <p class="font-semibold text-center">Outdoor (+20%) With Waterproof Technology</p>
                    </div>
                    <div wire:click="changeLocation('in_door')" class="flex mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == 'in_door') border-main @else border-gray-300 @endif">
                        <p class="font-semibold text-center">InDoor</p>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <h2 class="font-bold text-lg">Power Adaptor</h2>
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
                    <div wire:click="changeRemote('yes')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($remote == 'yes') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2 text-center">YES</p>
                    </div>
                    <div wire:click="changeRemote('no')" class="flex items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($remote == 'no') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2 text-center">No</p>
                    </div>
                </div>
            </div>
            <button class="py-3 text-center bg-main w-full text-white font-semibold rounded-md" type="submit">Checkout</button>
        </form>
    </div>
</section>