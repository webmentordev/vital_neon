<section class="w-full px-4">
    <div class="max-w-4xl m-auto py-[100px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-gray-300 font-bold flex text-9xl justify-center items-center m-auto featured">Featured Products</h4>
        </div>
        <div class="grid grid-cols-3 gap-6">
            @foreach ($products as $item)
                <div class="overflow-hidden rounded-lg group transition-all">
                    <img src="{{ asset('storage/'.$item->image) }}" class="group-hover:scale-110" alt="{{ $item->name }}">
                    <div class="bg-light p-3 w-full bottom-0 left-0">
                        <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                        <a href="{{ route('listing', $item->slug) }}" class="py-2 group-hover:bg-[#00FFFF] px-4 w-full text-center inline-block bg-gray-300 text-black font-semibold">BUY NOW</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>