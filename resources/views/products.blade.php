@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-2xl m-auto py-[80px]">
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
                    <div class="overflow-hidden rounded-lg group transition-all">
                        <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-110 lazyload" loading="lazy" alt="{{ $item->name }}">
                        <div class="bg-light p-3 w-full bottom-0 left-0">
                            <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                            <a href="{{ route('listing', $item->slug) }}" class="py-2 group-hover:bg-[#00FFFF] px-4 w-full text-center inline-block bg-gray-300 text-black font-semibold">BUY NOW</a>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <p class="text-center text-lg text-white">Product(s) not found!</p>
            @endif
        </div>
        <x-f-a-q />
    </section>
@endsection