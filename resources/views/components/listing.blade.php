<section class="w-full px-4">
    <div class="max-w-4xl m-auto py-[100px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-gray-300 font-bold flex text-9xl justify-center items-center m-auto featured">Featured Products</h4>
        </div>
        <div class="grid grid-cols-3 gap-6 800px:grid-cols-2 m-auto 530px:grid-cols-1 530px:max-w-[280px]">
            @foreach ($products as $item)
                <a href="{{ route('listing', $item->slug) }}" class="overflow-hidden group transition-all">
                    <div class="overflow-hidden rounded-lg">
                        <img data-src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-125 transition-all lazyload" alt="{{ $item->name }}" loading="lazy" style="height: 300px; object-fit: cover">
                    </div>
                    <div class="bg-light p-3 w-full bottom-0 left-0">
                        <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                        <span class="py-3 mt-3 rounded-md flex items-center group-hover:bg-white group-hover:text-black group-hover:font-bold px-4 w-full transition-all text-center justify-center bg-indigo-600 text-white font-semibold"><img src="https://api.iconify.design/solar:cart-large-3-bold.svg?color=%23FFF" class="mr-2 group-hover:hidden" width="23" alt="Cart logo"><img src="https://api.iconify.design/solar:cart-large-3-bold.svg?color=%23000000" class="mr-2 group-hover:block hidden" width="23" alt="Cart logo">BUY NOW</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="w-full flex justify-center mt-5">
            <a href="{{ route('products') }}" class="bg-white text-gray-800 py-2 px-6 mt-2 font-bold inline-block">View All Products</a>
        </div>
    </div>
</section>