<section class="w-full px-4">
    <div class="max-w-6xl m-auto py-[50px]">
        <div wire:loading wire:target="checkout" class="fixed left-[45%] bottom-3">
            <div class="flex items-center bg-black text-white p-6 rounded-lg"><img src="https://api.iconify.design/svg-spinners:ring-resize.svg?color=%23ffffff" alt="Loading Icon"> <span class="ml-2">Processing...</span></div>
        </div>
        
        @if ($total_price != 0)
            <span class="fixed bg-main rounded-lg p-3 bottom-3 z-10 w-fit left-3 text-gray-800 text-4xl font-semibold"><span class="text-2xl">$</span>{{ $total_price }}</span>
        @endif

        @if (session('success'))
            <x-success class="bottom-[85px]" :message="session('success')" />
        @endif

        <div wire:loading wire:target='clickPay'>
            <x-processing class="bottom-[85px]" message="Processing..." />
        </div>
        

        @foreach ($product as $item)
            <div class="grid grid-cols-2 gap-3 rounded-lg mb-6 overflow-hidden 890px:grid-cols-1 890px:max-w-lg m-auto">
                <div class="w-full">
                    <img data-src="{{ asset('storage/'.$item->image) }}" class="w-full lazyload rounded-lg mb-3 890px:h-[450px] 890px:object-cover" loading="lazy" alt="Buy {{ $item->name }}" title="Buy {{ $item->name }}">
                    {{-- <img class="mt-3 890px:hidden" src="{{ asset('assets/colors.png') }}" title="VitalNeon signs colors" alt="Colors selection"> --}}
                    <a href="https://www.trustpilot.com/review/vitalneon.com" title="Vital Neon TrustPilot reviews" target="_blank" rel="nofollow" class="py-3 rounded-lg bg-gray-100 mb-6">
                        <img class="max-w-[80%] w-full m-auto" src="{{ asset('assets/vital-neon-trustpilot-reviews.png') }}" alt="Vital Neon TrustPilot reviews">
                    </a>
                    <a href="https://www.etsy.com/shop/VitalNeons" title="Vital Neon Etsy reviews" target="_blank" rel="nofollow" class="mb-3 py-3 rounded-lg bg-gray-100">
                        <img class="max-w-[80%] w-full m-auto" src="{{ asset('assets/vital-neon-etsy-reviews.png') }}" alt="Vital Neon Etsy reviews">
                    </a>
                </div>
                <div class="bg-light p-6 h-fit w-full bottom-0 left-0 870px:max-h-fit overflow-y-scroll">
                    <h1 class="text-white mb-3 text-3xl capitalize font-bold">{{ $product[0]->name }}</h1>
                    <div class="flex mb-3">
                        <button class="w-full py-2 rounded-lg border border-white/10 px-3 text-white @if ($setting == 'purchase') bg-main @endif" wire:click="$set('setting', 'purchase')">
                            Purchase
                        </button>
                        <button class="w-full py-2 ml-2 rounded-lg border border-white/10 px-3 text-white @if ($setting == 'install') bg-main @endif" wire:click="$set('setting', 'install')">
                            Installation?
                        </button>
                    </div>
                    @if ($setting == "purchase")
                        <h3 class="text-white font-semibold mb-1">Select size <span class="text-main">(Step#01)</span></h3>
                        <div class="flex flex-wrap mb-4">
                            @foreach ($categories as $cat)
                                <span wire:click="$set('category', '{{ $cat->name }}')" class="text-sm cursor-pointer py-1 px-3 rounded-full border @if ($category == $cat->name)
                                    border-main
                                @else
                                    border-white/10
                                @endif m-1 text-white">{{ $cat->name }}</span>
                            @endforeach
                            <span wire:click="$set('category', 'custom')" class="text-sm cursor-pointer py-1 px-3 rounded-full border border-white/10 m-1 text-white">Custom</span>
                        </div>
                        @error('category')
                            <p class="text-red-600 mb-2">{{ $message }}</p>
                        @enderror
                        <h3 class="text-white font-semibold">Neon Sign color <span class="text-main">(Step#02)</span></h3>
                        @if ($item->category->name != "RGB")
                            <p class="text-gray-300 text-sm mb-3">Same means that the neon sign color will be identical to that in the image.</p>
                        @else
                            <p class="text-gray-300 text-sm mb-3">If you select a color other than RGB, the neon sign will not have RGB lighting.</p>
                        @endif
                        <div class="flex flex-wrap mb-4 items-center">
                            @if ($item->category->name != "RGB")
                                <span wire:click="$set('color_selected', 'Same')" class="p-1 px-3 m-1 border 
                                @if ($color_selected == 'Same')
                                    border-main
                                @else
                                    border-white/10
                                @endif rounded-full cursor-pointer text-white text-sm">Same</span>
                            @else
                                <span wire:click="$set('color_selected', 'RGB')" class="p-1 px-3 m-1 border 
                                @if ($color_selected == 'RGB')
                                    border-main
                                @else
                                    border-white/10
                                @endif rounded-full cursor-pointer text-white text-sm">RGB</span>
                            @endif
                            @foreach ($colors as $color)
                                <span wire:click="$set('color_selected', '{{ $color }}')" class="h-[15px] w-[15px] p-2 m-1 border-4 
                                @if ($color_selected == $color)
                                    border-main
                                @else
                                    border-transparent
                                @endif rounded-full cursor-pointer" style="background-color: {{ $color }}"></span>
                            @endforeach
                        </div>

                        @error('color_selected')
                            <p class="text-red-600 mb-2">{{ $message }}</p>
                        @enderror

                        <h3 class="text-white font-semibold mb-1">Email Address <span class="text-main">(Step#03)</span></h3>
                        <input type="text" wire:model.debounce.2000ms="email" placeholder="Contact Email Address" class="w-full bg-dark mt-2 rounded border border-white/10 focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        @error('email')
                            <p class="text-red-600 mb-2">{{ $message }}</p>
                        @enderror
                        
                        <div class="flex items-center">
                            <button class="py-3 px-4 mb-2 mr-3 w-full bg-white rounded-md font-bold text-dark add_to_cart" wire:click="addToCart('{{ $product[0]->slug }}')" id="add_to_cart">Add To Cart</button>
                            <a href="{{ route('carts') }}" class="py-3 px-4 mb-3 w-full bg-white rounded-md text-center font-bold text-dark">Checkout</a>
                        </div>

                        <button class="p-3 bg-indigo-600 rounded-lg w-full mb-3 font-semibold text-lg text-white" wire:click="clickPay">
                            {{-- <img src="{{ asset('assets/buy-with-stripe-logo.png') }}" class="w-[40%] m-auto" alt="Buy with stripe logo"> --}}
                            Click and Pay Now
                        </button>
                        
                        <p class="text-gray-300">🚚 Estimated Delivery: {{ \Carbon\Carbon::now()->format('d-M-y') }} - {{ \Carbon\Carbon::now()->addDays(5)->format('d-M-y') }}</p>

                        <div class="flex justify-between items-center 530px:flex-col w-full mt-2 py-3 mb-2">
                            <img src="{{ asset('assets/images/payment_cards.png') }}" width="190px" alt="Stripe Payment methods icon">
                            <img src="{{ asset('assets/images/stripe_square_logo.png') }}" width="190px" alt="Powerd by stipe image">
                        </div>
                    @else
                        <video src="{{ asset('videos/neon-sign-unboxing-video.MOV') }}" controls loop autoplay muted class="mb-3"></video>
                        <p class="text-gray-300">🚚 Estimated Delivery: {{ \Carbon\Carbon::now()->format('d-M-y') }} - {{ \Carbon\Carbon::now()->addDays(5)->format('d-M-y') }}</p>
                        <div class="flex justify-between items-center 530px:flex-col w-full mt-2 py-3 mb-2">
                            <img src="{{ asset('assets/images/payment_cards.png') }}" width="190px" alt="Stripe Payment methods icon">
                            <img src="{{ asset('assets/images/stripe_square_logo.png') }}" width="190px" alt="Powerd by stipe image">
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <main class="main-body">
            @if ($item->category->name == "RGB")
                <h3>Example of RGB Neon Sign</h3>
                <video title="Example of RGB Neon Signs" src="{{ asset('videos/rgb-neon-sign-example.mp4') }}" controls loop autoplay muted class="mb-4 w-full"></video>
            @endif
            {!! $product[0]->body !!}
            <p class="mb-1"><strong>Published at</strong>: <time class="entry-date published" datetime="{{ $product[0]->created_at->tz('UTC')->toAtomString() }}" itemprop="datePublished">{{ $product[0]->created_at->format('M, d Y') }}</time></p>
            @if ($product[0]->created_at != $product[0]->updated_at)
                <p class="mb-3"><strong>Last Updated</strong>: <time class="entry-date published" datetime="{{ $product[0]->updated_at->tz('UTC')->toAtomString() }}" itemprop="datePublished">{{ $product[0]->updated_at->format('M, d Y') }}</time>
            @endif
        </main>
    </div>
    <script>
        document.addEventListener('livewire:load', function (event) {
            Livewire.on('addToCart', () => {
                gtag('event', 'add_to_cart', {
                    'event_category': 'Shopping',
                    'event_action': 'add_to_cart',
                    'event_label': "{{ $product[0]->name }}",
                    'value': {{ number_format($total_price, 2) }}
                });
                gtag('event', 'conversion', {
                    'send_to': 'AW-16465873503/W_pKCJ-8k5YZEN-Uxas9'
                });
            });
        });
    </script>
</section>