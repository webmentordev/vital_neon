@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-[95%] m-auto py-[80px]">
            <div class="text-center mb-6 border-b border-light py-3">
                <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose 490px:text-2xl">Our Light Box Listing</h4>
            </div>
            <form action="{{ route('lightboxes') }}" class="mb-6" method="get">
                <div class="bg-light p-3 pl-5 rounded-lg flex 490px:flex-col">
                    <img class="490px:hidden" src="https://api.iconify.design/streamline:interface-search-glass-search-magnifying.svg?color=%23ffffff" width="30" alt="Search Icon">
                    <input type="text" class="bg-transparent border-none 490px:border 490px:border-white/10 focus:outline-none 490px:rounded-lg py-2 490px:py-3 ml-3 490px:ml-0 490px:mb-2 w-full outline-none text-gray-300" autocomplete="off" placeholder="Search..." name="search">
                    <button type="submit" class="bg-white text-dark font-semibold px-6 rounded-lg 490px:py-3">Search</button>
                </div>
            </form>
            @if (count($products))
            <div class="grid grid-cols-4 gap-6 m-auto 1170px:grid-cols-3 940px:grid-cols-2 940px:max-w-2xl 620px:grid-cols-1 620px:max-w-[390px]">
                @foreach ($products as $item)
                    <a href="{{ route('lightboxe.product', $item->slug) }}" class="overflow-hidden group transition-all relative">
                        @if ($discount)
                            @if ($discount->discount != 0.00)
                                <span class="bg-red-600 p-2 rounded-lg absolute top-2 right-2 text-white font-semibold">{{ number_format($discount->discount, 0) }}% Off</span>
                            @endif
                        @endif
                        @if ($item->dark_image)
                            <div class="overflow-hidden rounded-lg group">
                                <img data-src="{{ asset('storage/'.$item->light_image) }}" class="group-hover:hidden transition-all lazyload h-[350px] 620px:h-full" alt="{{ $item->title }}" title="{{ $item->title }} Image" loading="lazy" style="width: 100%; object-fit: cover">
                                <img data-src="{{ asset('storage/'.$item->dark_image) }}" class="hidden group-hover:block transition-all lazyload h-[350px] 620px:h-full" alt="{{ $item->title }}" title="{{ $item->title }} Image" loading="lazy" style="width: 100%; object-fit: cover">
                            </div>
                        @else
                            <div class="overflow-hidden rounded-lg">
                                <img data-src="{{ asset('storage/'.$item->light_image) }}" class="group-hover:scale-125 transition-all lazyload h-[350px] 620px:h-full" alt="{{ $item->title }}" title="{{ $item->title }} Image" loading="lazy" style="width: 100%; object-fit: cover">
                            </div>
                        @endif
                        <div class="bg-light p-3 w-full bottom-0 left-0">
                            @if (strlen($item->title) >= 26)
                                <h3 class="text-white text-center mb-3">{{ substr($item->title, 0, 26) }}...</h3>
                            @else
                                <h3 class="text-white text-center mb-3">{{ $item->title }}</h3>
                            @endif
                            @if ($discount)
                                @if ($discount->discount != 0.00)
                                    <div class="text-center">
                                        <del class="text-white/60">${{ number_format($item->price + (($discount->discount / 100) * $item->price), 2) }}</del>
                                        <p class="text-white text-3xl"><span class="font-semibold text-white">${{ number_format($item->price, 0) }}</span></p>
                                    </div>
                                @endif
                            @endif
                            <span class="py-3 mt-3 rounded-md flex items-center group-hover:bg-[#90FED5] px-4 w-full transition-all text-center justify-center bg-[#00DC82] text-black font-bold">
                                @if (!$discount)
                                    USD ${{ $item->price }}
                                @else
                                    @if ($discount)
                                        @if ($discount->discount == 0.0)
                                            USD ${{ $item->price }}
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
            @else
                <p class="text-center text-lg text-white">Product(s) not found!</p>
            @endif
        </div>
    </section>
@endsection