<section class="w-full px-4">
    <div class="max-w-5xl m-auto py-[80px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl 490px:text-2xl justify-center items-center m-auto choose">{{ $product[0]->name }}</h4>
        </div>
        <div wire:loading wire:target="checkout" class="fixed left-[45%] bottom-3">
            <div class="flex items-center bg-black text-white p-6 rounded-lg"><img src="https://api.iconify.design/svg-spinners:ring-resize.svg?color=%23ffffff" alt="Loading Icon"> <span class="ml-2">Processing...</span></div>
        </div>
        <span class="fixed bg-main rounded-lg p-3 bottom-3 z-10 right-3 text-gray-800 text-4xl font-semibold"><span class="text-2xl">$</span>{{ $total_price }}</span>
        @foreach ($product as $item)
            <div class="flex 870px:flex-col rounded-lg mb-6 overflow-hidden">
                <img data-src="{{ asset('storage/'.$item->image) }}" class="max-w-[450px] 870px:max-w-full w-full lazyload" loading="lazy" alt="Buy {{ $item->name }}">
                <div class="bg-light p-6 w-full bottom-0 left-0 max-h-[450px] 870px:max-h-fit overflow-y-scroll">
                    <h3 class="text-white font-semibold">Dimensions</h3>
                    <select name="category" id="category" wire:model="category" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">Up to {{ $category->name }} - ${{ $category->price }}</option>
                        @endforeach
                        <option value="custom">CUSTOMIZED</option>
                    </select>
                    @error('category')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <h3 class="text-white font-semibold">Location *{{ $location }}</h3>
                    <div class="py-3 grid grid-cols-2 gap-4 text-white">
                        @foreach ($locations as $loc)
                            <div wire:click="$set('location', '{{ $loc }}')" class="flex bg-dark mb-4 items-center justify-center p-3 cursor-pointer rounded-md flex-col border @if ($location == $loc) border-main @else border-gray-800 @endif">
                                <p class="font-semibold text-center">{{ $loc }}</p>
                            </div>
                        @endforeach
                    </div>
                    @error('location')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <h3 class="text-white font-semibold">Power Adaptor *{{ $adaptor }}</h3>
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
                    @error('adaptor')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <h3 class="text-white font-semibold">Backboard Style *{{ $shape }}</h3>
                    <div class="py-3">
                        @foreach ($shapes as $item)
                            <div wire:click="$set('shape', '{{ $item->shape }}')" class="flex bg-dark mb-4 p-3 cursor-pointer rounded-md flex-col border @if ($shape ==  $item->shape) border-main @else border-gray-800 @endif">
                                <p class="font-semibold mb-2 text-gray-300">{{ $item->shape }} (${{ $item->price }})</p>
                                <span class="text-gray-500 text-sm">{{ $item->description }}</span>
                            </div>
                        @endforeach
                    </div>
                    @error('adaptor')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <h3 class="text-white font-semibold">Remote and Dimmer *{{ $remote }}</h2>
                    <p class="text-gray-300 text-sm">A remote and dimmer is included free with every sign! (Except for Multicolor Neon Signs, which are controlled by the APP)</p>
                    <div class="py-3 w-full">
                        <select name="remote" id="remote" wire:model="remote" class="bg-dark text-white flex items-center w-full justify-center p-3 cursor-pointer rounded-md flex-col border">
                            @foreach ($remotes as $item)
                                <option value="{{ $item->type }}">{{ $item->type }} - ${{ $item->price }}</option>  
                            @endforeach 
                        </select>
                    </div>
                    @error('remote')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <div class="py-2 text-white">
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
                    <input type="number" wire:model.debounce.500ms="phone" placeholder="Phone (for shipping purpose)" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                    @error('phone')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <input type="text" wire:model.debounce.500ms="email" placeholder="Email Address" class="w-full border-none bg-dark mt-2 rounded focus:border-main focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                    @error('email')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                    @enderror
                    <button class="submit-btn" wire:click="checkout" type="submit"><span class="mr-2 text-xl">Checkout</span> <img src="{{ asset('assets/images/stripe_small.png') }}" width="50" alt="Stripe Logo"></button>
                </div>
            </div>
        @endforeach
        <p class="p-6 border-l border-gray-400 bg-light text-white mb-6 text-[13px] leading-6">We're pleased to offer Stripe as our payment system, providing you with a secure and reliable way to make payments. With Stripe, your credit card information is kept safe and secure, as we don't store it on our servers. We only collect your email address for communication purposes, and we never share your personal information with third parties. Stripe's user-friendly interface allows for seamless payments, giving you peace of mind and a smooth payment experience. Thank you for choosing to shop with us!</p>
        <main class="main-body">
            {!! $product[0]->body !!}
        </main>
    </div>
    <x-f-a-q />
</section>