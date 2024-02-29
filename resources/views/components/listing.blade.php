<section class="w-full px-4">
    <div class="max-w-7xl m-auto py-[100px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-gray-300 font-bold flex text-9xl justify-center items-center m-auto featured">Featured Products</h4>
        </div>
        <div class="grid grid-cols-4 gap-6 m-auto 1170px:grid-cols-3 940px:grid-cols-2 940px:max-w-2xl 620px:grid-cols-1 620px:max-w-[390px]">
            @foreach ($products as $item)
                <a href="{{ route('listing', $item->slug) }}" class="overflow-hidden group transition-all relative">
                    @if ($discount)
                        @if ($discount->discount != 0.00)
                            <span class="bg-red-600 p-2 rounded-lg absolute top-2 right-2 text-white font-semibold">{{ number_format($discount->discount, 0) }}% Off</span>
                        @endif
                    @endif
                    <div class="overflow-hidden rounded-lg">
                        <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-125 transition-all lazyload h-[300px] 620px:h-full" alt="{{ $item->name }}" title="{{ $item->name }} Image" loading="lazy" style="width: 100%; object-fit: cover">
                    </div>
                    <div class="bg-light p-3 w-full bottom-0 left-0">
                        @if (strlen($item->name) >= 26)
                            <h3 class="text-white text-center mb-3">{{ substr($item->name, 0, 26) }}...</h3>
                        @else
                            <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                        @endif
                        @if ($discount)
                            @if ($discount->discount != 0.00)
                                <div class="text-center">
                                    <del class="text-white/60">${{ number_format($item->categories[0]->price + (($discount->discount / 100) * $item->categories[0]->price), 2) }}</del>
                                    <p class="text-white text-3xl"><span class="font-semibold text-white">${{ number_format($item->categories[0]->price, 0) }}</span></p>
                                </div>
                            @endif
                        @endif
                        <span class="py-3 mt-3 rounded-md flex items-center group-hover:bg-[#90FED5] px-4 w-full transition-all text-center justify-center bg-[#00DC82] text-black font-bold">
                            @if (!$discount)
                                USD ${{ $item->categories[0]->price }}
                            @else
                                @if ($discount)
                                    @if ($discount->discount == 0.0)
                                        USD ${{ $item->categories[0]->price }}
                                    @else
                                        BUY NOW
                                    @endif
                                @endif
                            @endif
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="w-full flex justify-center mt-5">
            <a href="{{ route('products') }}" class="bg-white text-gray-800 py-2 px-6 mt-2 font-bold inline-block">View All Products</a>
        </div>
    </div>
</section>


{{-- <a href="{{ route('listing', $item->slug) }}" class="overflow-hidden group transition-all relative">
    @if ($discount)
        @if ($discount->discount != 0.00)
            <span class="bg-indigo-600 p-2 rounded-lg absolute top-2 right-2 text-white font-semibold">{{ $discount->discount }}% Off</span>
        @endif
    @endif
    <div class="overflow-hidden rounded-lg">
        <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-125 transition-all lazyload" alt="{{ $item->name }}" title="{{ $item->name }} Image" loading="lazy" style="height: 300px; width: 100%; object-fit: cover">
    </div>
    <div class="bg-light p-3 w-full bottom-0 left-0">
        @if (strlen($item->name) >= 26)
            <h3 class="text-white text-center mb-3">{{ substr($item->name, 0, 26) }}...</h3>
        @else
            <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
        @endif
        @if ($discount)
            @if ($discount->discount != 0.00)
                <p class="text-white"><span class="font-semibold text-3xl text-whtie"><span class="text-lg">$</span>{{ number_format($item->categories[0]->price, 0) }}/</span><span class="ml-1 font-semibold text-gray-300">was <del>${{ number_format($item->categories[0]->price + (($discount->discount / 100) * $item->categories[0]->price), 2) }}</del></span></p>
            @endif
        @endif
        <span class="py-3 mt-3 rounded-md flex items-center group-hover:bg-white group-hover:text-black group-hover:font-bold px-4 w-full transition-all text-center justify-center bg-indigo-600 text-white font-semibold">
            @if (!$discount)
                USD ${{ $item->categories[0]->price }}
            @else
                @if ($discount)
                    @if ($discount->discount == 0.0)
                        USD ${{ $item->categories[0]->price }}
                    @else
                        BUY NOW
                    @endif
                @endif
            @endif
        </span>
    </div>
</a> --}}