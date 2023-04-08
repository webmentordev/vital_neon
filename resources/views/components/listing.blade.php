<section class="w-full">
    <div class="max-w-4xl m-auto py-[100px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose">Our Products</h4>
        </div>
        <div class="grid grid-cols-3 gap-6">
            @foreach ($products as $item)
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-[300px]" alt="{{ $item->name }}">
                    <div class="bg-light p-3 w-full bottom-0 left-0">
                        <h3 class="text-white text-center mb-3">{{ $item->name }}</h3>
                        <a href="{{ route('listing', $item->slug) }}" class="py-2 px-4 w-full text-center inline-block bg-parrot text-black font-semibold">Buy Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>