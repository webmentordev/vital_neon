@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-4xl m-auto py-[80px]">
            <div class="text-center mb-6 border-b border-light py-3">
                <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose 490px:text-2xl">Our Products Listing</h4>
            </div>
            <form action="{{ route('product.search') }}" class="mb-6" method="get">
                <div class="bg-light p-3 pl-5 rounded-lg flex 490px:flex-col">
                    <img class="490px:hidden" src="https://api.iconify.design/streamline:interface-search-glass-search-magnifying.svg?color=%23ffffff" width="30" alt="Search Icon">
                    <input type="text" class="bg-transparent border-none 490px:border 490px:border-white/10 focus:outline-none 490px:rounded-lg py-2 490px:py-3 ml-3 490px:ml-0 490px:mb-2 w-full outline-none text-gray-300" autocomplete="off" placeholder="Search..." name="search">
                    <button type="submit" class="bg-white text-dark font-semibold px-6 rounded-lg 490px:py-3">Search</button>
                </div>
            </form>
            @if (count($products))
            <div class="grid grid-cols-3 gap-6 m-auto 600px:grid-cols-2 600px:max-w-lg 490px:grid-cols-1 490px:max-w-[300px]">
                @foreach ($products as $item)
                    <a href="{{ route('listing', $item->slug) }}" class="overflow-hidden group transition-all">
                        <div class="overflow-hidden rounded-lg">
                            <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-125 transition-all lazyload" alt="{{ $item->name }}" loading="lazy" style="height: 300px; object-fit: cover">
                        </div>
                        <div class="bg-light p-3 w-full bottom-0 left-0">
                            @if (strlen($item->name) >= 26)
                                <h3 class="text-white text-center mb-3">{{ substr($item->name, 0, 26) }}...</h3>
                            @else
                                <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                            @endif
                            <span class="py-3 mt-3 rounded-md flex items-center group-hover:bg-white group-hover:text-black group-hover:font-bold px-4 w-full transition-all text-center justify-center bg-indigo-600 text-white font-semibold"><img src="https://api.iconify.design/solar:cart-large-3-bold.svg?color=%23FFF" class="mr-2 group-hover:hidden" width="23" alt="Cart logo"><img src="https://api.iconify.design/solar:cart-large-3-bold.svg?color=%23000000" class="mr-2 group-hover:block hidden" width="23" alt="Cart logo">BUY NOW</span>
                        </div>
                    </a>
                @endforeach
            </div>
            @else
                <p class="text-center text-lg text-white">Product(s) not found!</p>
            @endif
        </div>
        <x-f-a-q />
    </section>
@endsection