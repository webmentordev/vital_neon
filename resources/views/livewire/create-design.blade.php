<section class="w-full py-[80px]">
    <div class="grid grid-cols-2 gap-6 max-w-6xl m-auto min-h-[800px]">
        <div class="bg-cover bg-center rounded-lg flex items-center justify-center" style="background-image: url({{ asset('assets/images/dark_wall.jpg') }})">
            <span class="neonText text-7xl font-semibold">{{ $custom_text }}</span>
        </div>
        <form wire:submit.prevent="createOrder" method="POST" class="text-sm">
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
                <h2 class="font-bold mb-2 text-lg">Choose a size</h2>
                <p class="text-gray-500 text-sm mb-3">*Each sign is handcrafted, and sizes shown will be accurate within 1 or 2 inches. Neon sign larger than 47 inches will be made on two or more backboards that can be easily arranged together.</p>
                
                <div class="grid grid-cols-2 gap-4">
                    <div wire:click="changeSize('small')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($size == 'small') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Small</p>
                        <span class="text-gray-500 text-sm">66.84cmx20.87cm/26.32inx8.22in</span>
                    </div>

                    <div wire:click="changeSize('medium')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($size == 'medium') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Medium</p>
                        <span class="text-gray-500 text-sm">92.24cmx28.80cm/36.32inx 11.34in</span>
                    </div>

                    <div wire:click="changeSize('large')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($size == 'large') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Large</p>
                        <span class="text-gray-500 text-sm">116.97cmx 36.53cm/46.05inx 14.38in</span>
                    </div>

                    <div wire:click="changeSize('x-large')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($size == 'x-large') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">X Large</p>
                        <span class="text-gray-500 text-sm">143.71cmx44.88cm/56.58inx 17.67in</span>
                    </div>

                    <div wire:click="changeSize('supersized')" class="flex p-3 cursor-pointer rounded-md flex-col mb-3 border @if ($size == 'supersized') border-main @else border-gray-300 @endif">
                        <p class="font-semibold mb-2">Supersized</p>
                        <span class="text-gray-500 text-sm">233.94cmx73.05cm/92.10inx28.76in</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>