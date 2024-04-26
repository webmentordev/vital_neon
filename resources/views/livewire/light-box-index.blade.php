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
        
        <div class="grid grid-cols-2 gap-3 rounded-lg mb-6 overflow-hidden 890px:grid-cols-1 890px:max-w-lg m-auto">
            <div class="w-full">
                <img data-src="{{ asset('storage/'.$product->light_image) }}" class="w-full lazyload rounded-lg mb-3 890px:h-[450px] 890px:object-cover" loading="lazy" alt="Buy {{ $product->title }}" title="Buy {{ $product->title }}">
                {{-- <img class="mt-3 890px:hidden" src="{{ asset('assets/colors.png') }}" title="VitalNeon signs colors" alt="Colors selection"> --}}
                <a href="https://www.trustpilot.com/review/vitalneon.com" title="Vital Neon TrustPilot reviews" target="_blank" rel="nofollow" class="py-3 rounded-lg bg-gray-100 mb-6">
                    <img class="max-w-[80%] w-full m-auto" src="{{ asset('assets/vital-neon-trustpilot-reviews.png') }}" alt="Vital Neon TrustPilot reviews">
                </a>
                <a href="https://www.etsy.com/shop/VitalNeons" title="Vital Neon Etsy reviews" target="_blank" rel="nofollow" class="mb-3 py-3 rounded-lg bg-gray-100">
                    <img class="max-w-[80%] w-full m-auto" src="{{ asset('assets/vital-neon-etsy-reviews.png') }}" alt="Vital Neon Etsy reviews">
                </a>
            </div>
            <div class="bg-light p-6 h-fit w-full bottom-0 left-0 870px:max-h-fit overflow-y-scroll">
                <h1 class="text-white mb-3 text-3xl capitalize font-bold">{{ $product->title }}</h1>
                <h3 class="text-white font-semibold mb-1">Select Remote type <span class="text-main">(Step#01)</span></h3>
                <div class="flex flex-wrap mb-4">
                    <span wire:click="$set('remote', 'standard')" class="text-sm cursor-pointer py-1 px-3 rounded-full border @if ($remote == 'standard') border-main @else border-white/10 @endif m-1 text-white">Standard</span>
                    <span wire:click="$set('remote', 'controller')" class="text-sm cursor-pointer py-1 px-3 rounded-full border @if ($remote == 'controller') border-main @else border-white/10 @endif m-1 text-white">Controller</span>
                </div>
                @error('remote')
                    <p class="text-red-600 mb-2">{{ $message }}</p>
                @enderror
                <h3 class="text-white font-semibold mb-1">Email Address <span class="text-main">(Step#02)</span></h3>
                <input type="text" wire:model.debounce.2000ms="email" placeholder="Contact Email Address" class="w-full bg-dark mt-2 rounded border border-white/10 focus:ring-4 focus:ring-main text-base outline-none text-gray-300 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                @error('email')
                    <p class="text-red-600 mb-2">{{ $message }}</p>
                @enderror
                
                <div class="flex items-center">
                    <button class="py-3 px-4 mb-2 mr-3 w-full bg-white rounded-md font-bold text-dark add_to_cart" wire:click="addToCart('{{ $product->slug }}')" id="add_to_cart">Add To Cart</button>
                    <a href="{{ route('carts') }}" class="py-3 px-4 mb-3 w-full bg-white rounded-md text-center font-bold text-dark">Checkout</a>
                </div>

                <button class="p-3 bg-indigo-600 rounded-lg w-full mb-3 font-semibold text-lg text-white" wire:click="clickPay">
                    {{-- <img src="{{ asset('assets/buy-with-stripe-logo.png') }}" class="w-[40%] m-auto" alt="Buy with stripe logo"> --}}
                    Click and Pay Now
                </button>
                
                <p class="text-gray-300">🚚 Estimated Delivery: {{ \Carbon\Carbon::now()->format('d-M-y') }} - {{ \Carbon\Carbon::now()->addDays(14)->format('d-M-y') }}</p>

                <div class="flex justify-between items-center 530px:flex-col w-full mt-2 py-3 mb-2">
                    <img src="{{ asset('assets/images/payment_cards.png') }}" width="190px" alt="Stripe Payment methods icon">
                    <img src="{{ asset('assets/images/stripe_square_logo.png') }}" width="190px" alt="Powerd by stipe image">
                </div>
                
            </div>
        </div>

        <main class="main-body">
            {!! $product->body !!}
            <p class="mb-1"><strong>Published at</strong>: <time class="entry-date published" datetime="{{ $product->created_at->tz('UTC')->toAtomString() }}" itemprop="datePublished">{{ $product->created_at->format('M, d Y') }}</time></p>
            @if ($product->created_at != $product->updated_at)
                <p class="mb-3"><strong>Last Updated</strong>: <time class="entry-date published" datetime="{{ $product->updated_at->tz('UTC')->toAtomString() }}" itemprop="datePublished">{{ $product->updated_at->format('M, d Y') }}</time>
            @endif
        </main>
    </div>
    <script>
        document.addEventListener('livewire:load', function (event) {
            Livewire.on('addToCart', () => {
                gtag('event', 'add_to_cart', {
                    'event_category': 'Shopping',
                    'event_action': 'add_to_cart',
                    'event_label': "{{ $product->title }}",
                    'value': {{ number_format($total_price, 2) }}
                });
                gtag('event', 'conversion', {
                    'send_to': 'AW-16465873503/W_pKCJ-8k5YZEN-Uxas9'
                });
            });
        });
    </script>
</section>