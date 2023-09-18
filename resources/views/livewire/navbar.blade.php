<nav class="w-full py-2 sticky top-0 left-0 z-50 bg-dark text-white bg-opacity-80 backdrop-blur-lg">
    <div class="flex items-center justify-between max-w-[90%] m-auto w-full px-2">
        <a href="{{ route('home') }}" class="text-3xl font-semibold py-1"><img src="{{ asset('assets/neon_tranp_white.png') }}" width="150" alt="Vital Neon"></a>
        <ul class="flex items-center uppercase 1210px:hidden">
            <a class="mx-4" href="{{ route('home') }}">Home</a>
            <a class="mx-4" href="{{ route('products') }}">Products</a>
            <a class="mx-4" href="{{ route('create-design') }}">Design Your Own</a>
            <a class="mx-4" href="{{ route('upload-design') }}">Upload Design</a>
            <div class="mx-4 relative group">
                <span class="category flex items-center">Categories <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23ffffff" width="28" alt="Carret Down Logo"></span>
                <div class="hidden group-hover:block absolute top-7 max-w-[200px] w-full p-2 rounded-lg bg-dark bg-opacity-80 backdrop-blur-lg border border-white/10 text-gray-700">
                    <ul class="flex flex-col w-full text-white text-center">
                        @foreach ($categories as $item)
                            @if ($loop->last)
                                <a class="text-[15px] hover:font-semibold container" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                            @else
                                <a class="text-[15px] hover:font-semibold container border-b-4 border-white/10" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <a class="mx-4" href="{{ route('about') }}">About</a>
            <a class="mx-4" href="{{ route('f.a.q') }}">F.A.Q</a>
            <a class="mx-4" href="{{ route('track') }}">Track</a>
            <div class="mx-4 relative group">
                <span class="category flex items-center">Support <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23ffffff" width="28" alt="Carret Down Logo"></span>
                <div class="hidden group-hover:block absolute top-7 right-0 w-[120px] p-2 rounded-lg bg-dark bg-opacity-80 backdrop-blur-lg border border-white/10 text-gray-700">
                    <ul class="flex flex-col w-full text-white text-center">
                        <a class="text-[15px] p-1 mb-1 container border-b border-white/10 flex items-center" target="_blank" href="https://wa.me/16476165799"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" class="mr-2" width="20" alt="Social Media Icon">Whatsapp</a>
                        <a class="text-[15px] p-1 container flex items-center" target="_blank" href="https://m.me/100095082327532"><img src="https://api.iconify.design/logos:messenger.svg?color=%23121212" class="mr-2" width="20" alt="Social Media Icon">Facebook</a>
                    </ul>
                </div>
            </div>
            <a href="{{ route('carts') }}" class="relative">
                <img src="https://api.iconify.design/ion:md-basket.svg?color=%23ffffff" width="30" alt="Cart">
                <span class="bg-white absolute -top-3 h-[20px] w-[20px] flex items-center justify-center text-[10px] right-0 p-[2px] font-bold px-[5px] rounded-full text-black">{{ $itemsCount }}</span>
            </a>
        </ul>
        <div class="hidden 1210px:block" x-data="{open: false}">
            <ul x-on:click="open = true">
                <li class="bg-white my-2 h-[2px] w-[50px]"></li>
                <li class="bg-white my-2 h-[2px] w-[50px]"></li>
                <li class="bg-white my-2 h-[2px] w-[50px]"></li>
            </ul>
            <div class="fixed top-0 left-0 w-full h-screen bg-dark backdrop-blur-lg flex justify-center items-center z-50" x-show="open" x-on:click.self="open = !open" x-cloak>
                <ul class="text-center flex flex-col">
                    <a class="text-2xl mb-3" href="{{ route('home') }}">Home</a>
                    <a class="text-2xl mb-3" href="{{ route('products') }}">Products</a>
                    <a class="text-2xl mb-3" href="{{ route('create-design') }}">Design Your Own</a>
                    <a class="text-2xl mb-3" href="{{ route('upload-design') }}">Upload Design</a>
                    <div class="mx-4 relative mt-2" x-data="{toggle: false}">
                        <span class="flex items-center category text-3xl p-3 bg-light rounded-lg" x-on:click="toggle = !toggle">Categories <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23ffffff" width="28" alt="Carret Down Logo"></span>
                        <div class="flex flex-col" x-show="toggle">
                            @foreach ($categories as $item)
                                <a class="text-2xl" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a class="text-2xl mb-3" href="{{ route('about') }}">About</a>
                    <a class="text-2xl mb-3" href="{{ route('f.a.q') }}">F.A.Q</a>
                    <a class="text-2xl mb-3" href="{{ route('track') }}">Track</a>
                    <div class="mx-4 relative mb-3" x-data="{toggle: false}">
                        <span class="flex items-center category text-3xl p-3 bg-light rounded-lg" x-on:click="toggle = !toggle">Support <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23ffffff" width="28" alt="Carret Down Logo"></span>
                        <div class="flex flex-col" x-show="toggle">
                            <a class="text-2xl flex items-center" href="https://wa.me/16476165799" target="_blank"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" class="mr-2" width="20" alt="Social Media Icon">Whatsapp</a>
                            <a class="text-2xl flex items-center" href="https://m.me/100095082327532" target="_blank"><img src="https://api.iconify.design/logos:messenger.svg?color=%23121212" class="mr-2" width="20" alt="Social Media Icon">Facebook</a>
                        </div>
                    </div>
                    <a href="{{ route('carts') }}" class="relative w-fit flex items-center m-auto">
                        <img src="https://api.iconify.design/ion:md-basket.svg?color=%23ffffff" width="30" alt="Cart">
                        <span class="bg-white text-[10px] right-0 p-[2px] font-bold px-[5px] h-fit rounded-full text-black">{{ $itemsCount }}</span>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</nav>