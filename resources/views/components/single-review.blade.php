@props(['review'])
<div class="flex flex-col h-fit w-full p-6 bg-white transition-all hover:shadow-xl border border-gray-200 rounded-xl">
    <div class="flex items-center mb-1">
        <div class="w-[30px] h-[30px] rounded-full bg-center bg-cover" style="background-image: url({{ asset('assets/etsy_logo.png') }})"></div>
        <span class="ml-3 text-sm text-slate-600">{{ $review->name }}</span>
    </div>
    <div class="flex items-center mb-1">
        <ul class="flex">
            <li><img width="20px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
            <li><img width="20px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
            <li><img width="20px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
            <li><img width="20px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
            @if ($review->star > 4.5)
                <li><img width="20px" src="https://api.iconify.design/material-symbols:star.svg?color=%23FFA41C" alt="Review star"></li>
            @else
                <li><img width="20px" src="https://api.iconify.design/material-symbols:star-half.svg?color=%23FFA41C" alt="Review star"></li>
            @endif
        </ul>
        <p class="text-[15px] ml-2 mt-1"><b>{{ $review->title }}</b></p>
    </div>
    <p class="text-slate-700 text-[14px] mb-2">Reviewd on {{ $review->date }}</p>
    <p class="text-[14px] mb-3">{{ $review->review }}</p>
    {{-- <img src="{{ asset('/storage/'. $review->image) }}" class="mb-3 rounded-lg" title="Vital Neon sign review by {{ $review->name }}" alt="{{ $review->name }}"> --}}
    <a href="{{ $review->url }}" class="text-sm w-fit font-semibold inline-block py-2 px-5 rounded-lg bg-[#FFA41C]" target="_blank" rel="nofollow">Read</a>
</div>