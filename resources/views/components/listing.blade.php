<section class="w-full px-4">
    <div class="max-w-7xl m-auto py-[100px] flex relative">
        <div class="max-w-[270px] mr-6 w-full h-fit sticky top-1 left-0 1210px:hidden">
            <div class="w-full rounded-lg p-4 bg-light flex items-center mb-4 border border-white/10">
                <img src="https://api.iconify.design/material-symbols:format-list-bulleted.svg?color=%23ffffff" width="20" alt="List">
                <h3 class="text-white ml-2 font-bold">Search by Category
                </h3>
            </div>
            <div class="w-full rounded-lg bg-light flex items-center border border-white/10">
                @if (count($categories))
                    <ul class="flex flex-col w-full text-white">
                        @foreach ($categories as $item)
                            @if ($loop->last)
                                <a class="py-3 px-5 border-white/10 transition-all bg-opacity-60 hover:text-black hover:bg-main over:bg-opacity-100" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                            @else
                                <a class="py-3 px-5 transition-all bg-opacity-60 hover:text-black hover:bg-main hover:bg-opacity-100 border-b border-white/10" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p>No category found!</p>
                @endif
            </div>
        </div>
        <div class="w-full">
            <div class="mb-6 text-white">
                <h4 class="text-[34.5px] uppercase mb-1 font-bold flex text-9xl 530px:text-3xl">Our Featured Products</h4>
                <p class="text-gray-300 mb-2">Checkout our list of best-selling Featured Products, meticulously curated to suit your diverse needs but not limited to this selection.</p>
                <div class="flex-wrap hidden 1210px:flex">
                    @foreach ($categories as $item)
                        <a class="py-1 px-2 border rounded-xl m-1 w-fit border-white/10 transition-all bg-opacity-60 hover:bg-main hover:bg-opacity-100 hover:text-black" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                    @endforeach
                </div>
            </div>
            <form action="{{ route('product.search') }}" class="mb-6" method="get">
                <div class="bg-dark rounded-lg flex 490px:flex-col">
                    <input type="text" id="search" class="border-white/10 border bg-light mr-2 490px:border 490px:border-white/10 focus:outline-none rounded-lg py-3 490px:py-3 490px:ml-0 490px:mb-2 w-full outline-none text-gray-300" autocomplete="off" placeholder="Search for any product..." name="search">
                    <button type="submit" class="bg-main text-dark font-semibold px-6 rounded-lg 490px:py-3">Search</button>
                </div>
            </form>
            <div class="grid grid-cols-3 gap-6 m-auto 1170px:grid-cols-3 940px:grid-cols-2 940px:max-w-2xl 620px:grid-cols-1 620px:max-w-[390px]">
                @foreach ($products as $item)
                    <a href="{{ route('listing', $item->slug) }}" class="overflow-hidden rounded-lg group transition-all relative">
                        @if ($discount)
                            @if ($discount->discount != 0.00)
                                <span class="bg-red-600 p-2 rounded-lg absolute top-2 right-2 text-white font-semibold">{{ number_format($discount->discount, 0) }}% Off</span>
                            @endif
                        @endif
                        <div class="overflow-hidden rounded-lg">
                            <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-125 transition-all lazyload h-[300px] 1210px:h-[350px] 620px:h-full" alt="{{ $item->name }}" title="{{ $item->name }} Image" loading="lazy" style="width: 100%; object-fit: cover">
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