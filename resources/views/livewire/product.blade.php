<section class="w-full px-4">
    <div class="max-w-3xl m-auto py-[80px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose">{{ $product[0]->name }}</h4>
        </div>
        @foreach ($product as $item)
            <div class="flex rounded-lg mb-6 overflow-hidden">
                <img src="{{ asset('storage/'.$item->image) }}" class="max-w-[350px] w-full" alt="{{ $item->name }}">
                <div class="bg-light p-3 w-full bottom-0 left-0">
                    
                </div>
            </div>
        @endforeach
        <main class="main-body">
            {!! $item->body !!}
        </main>
    </div>
    <x-f-a-q />
</section>