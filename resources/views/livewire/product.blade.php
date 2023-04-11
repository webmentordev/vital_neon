<section class="w-full px-4">
    <div class="max-w-3xl m-auto py-[80px]">
        <div class="text-center mb-6 border-b border-light py-3">
            <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose">{{ $product[0]->name }}</h4>
        </div>
        @foreach ($product as $item)
            <div class="flex rounded-lg mb-6 overflow-hidden">
                <img src="{{ asset('storage/'.$item->image) }}" class="max-w-[350px] w-full" alt="Buy {{ $item->name }}">
                <div class="bg-light p-3 w-full bottom-0 left-0">
                    <h3 class="text-white font-semibold">Dimensions</h3>
                    <select name="category" id="category" class="w-full mt-2 bg-dark rounded border border-gray-800 focus:border-main focus:ring-4 focus:ring-main-light text-base outline-none text-gray-200 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out mb-3">
                        @foreach ($item->categories as $category)
                            @if ($loop->first)
                                <option value="{{ $category->name }}" selected>{{ $category->name }} - ${{ $category->price }}</option>
                            @else
                                <option value="{{ $category->name }}">{{ $category->name }} - ${{ $category->price }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
        <main class="main-body">
            {!! $item->body !!}
        </main>
    </div>
    <x-f-a-q />
</section>