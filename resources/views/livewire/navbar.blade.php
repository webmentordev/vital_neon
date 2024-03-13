<nav class="w-full py-2 sticky top-0 left-0 z-50 bg-dark text-white bg-opacity-80 backdrop-blur-lg border-b border-white/10">
    <div class="flex items-center justify-between max-w-7xl m-auto w-full px-2">
        <a href="{{ route('home') }}" class="text-3xl font-semibold py-1"><img src="{{ asset('assets/neon_tranp_white.png') }}" width="130" alt="Vital Neon"></a>
        <ul class="flex font-normal items-center capitalize 940px:hidden">
            <a class="mx-4" href="{{ route('home') }}">Home</a>
            <a class="mx-4" href="{{ route('products') }}">Products</a>
            <a class="mx-4" href="{{ route('create-design') }}">Design Your Own</a>
            <a class="mx-4" href="{{ route('upload-design') }}">Upload Design</a>
            <div class="mx-4 relative group">
                <span class="category flex items-center">Categories <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23ffffff" width="28" alt="Carret Down Logo"></span>
                <div class="hidden group-hover:block absolute top-7 w-[310px] right-0 p-2 rounded-lg bg-white text-gray-800">
                    <div class="w-full grid grid-cols-2 gap-3 p-2">
                        @foreach ($categories as $item)
                            <a class="font-semibold container py-2 px-3 bg-gray-100 rounded-lg h-fit" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mx-4 relative group">
                <span class="category flex items-center">Support <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23ffffff" width="28" alt="Carret Down Logo"></span>
                <div class="hidden group-hover:block absolute top-7 right-0 w-[120px] p-2 rounded-lg bg-dark bg-opacity-80 backdrop-blur-lg border border-white/10 text-gray-700">
                    <ul class="flex flex-col w-full text-white text-center">
                        <a rel="nofollow" class="text-[15px] p-1 mb-1 container border-b border-white/10 flex items-center" target="_blank" href="https://wa.me/16476165799"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" class="mr-2" width="20" alt="Social Media Icon">Whatsapp</a>
                        <a rel="nofollow" class="text-[15px] p-1 container flex items-center" target="_blank" href="https://m.me/100095082327532"><img src="https://api.iconify.design/logos:messenger.svg?color=%23121212" class="mr-2" width="20" alt="Social Media Icon">Facebook</a>
                    </ul>
                </div>
            </div>
            <a href="{{ route('carts') }}" class="relative">
                <img src="https://api.iconify.design/ion:md-basket.svg?color=%23ffffff" width="30" alt="Cart">
                <span class="bg-white absolute -top-3 h-[20px] w-[20px] flex items-center justify-center text-[10px] right-0 p-[2px] font-bold px-[5px] rounded-full text-black">{{ $itemsCount }}</span>
            </a>
        </ul>
        <div class="hidden 940px:block">
            <div class="flex items-center">
                <a class="text-base mr-6" title="VitalNeon Neon Signs" href="{{ route('products') }}">Products</a>
                <a class="text-base mr-6" title="VitalNeon Cart" href="{{ route('carts') }}">Cart</a>
                <div x-data="{open: false}">
                    <div x-on:click="open = true" class="p-2 rounded-full bg-white cursor-pointer">
                        <img width="30" src="https://api.iconify.design/ph:text-align-right-fill.svg?color=%23000000" alt="Align image">
                    </div>
                    <div class="fixed overflow-y-scroll top-0 left-0 max-w-[340px] w-full h-screen bg-white backdrop-blur-lg z-50" x-show="open" x-on:click.self="open = !open" x-cloak>
                        <div class="w-full flex justify-end p-2 cursor-pointer">
                            <img width="40" x-on:click="open = false" src="https://api.iconify.design/gridicons:cross-circle.svg?color=%23e12d2d" alt="Align image">
                        </div>
                        <ul class="flex flex-col text-black px-3 font-semibold">
                            <a class="text-lg mb-3" href="{{ route('home') }}">Home</a>
                            <a class="text-lg mb-3" title="VitalNeon Neon Signs" href="{{ route('products') }}">Products</a>
                            <a class="text-lg mb-3" title="Create You own Neon Design" href="{{ route('create-design') }}">Design Your Own</a>
                            <a class="text-lg mb-3" title="Request your neon sign" href="{{ route('upload-design') }}">Upload Design</a>
                            <div class="relative mb-2" x-data="{toggle: false}">
                                <span class="flex items-center category cursor-pointer p-2 bg-gray-200" x-on:click="toggle = 
                                !toggle">Categories <img src="https://api.iconify.design/ic:outline-arrow-drop-down.svg?color=%23000000" width="28" alt="Carret Down Logo"></span>
                                <div class="flex flex-col font-normal" x-show="toggle">
                                    @foreach ($categories as $item)
                                        <a class="p-1" href="{{ route('category.search', $item->slug) }}">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="relative mb-3 mt-3">
                                <a class="flex items-center mb-2" href="https://wa.me/16476165799" target="_blank"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" class="mr-2" width="30" alt="Social Media Icon">Whatsapp</a>
                                <a class="flex items-center" href="https://m.me/100095082327532" target="_blank"><img src="https://api.iconify.design/logos:messenger.svg?color=%23121212" class="mr-2" width="30" alt="Social Media Icon">Facebook</a>
                            </div>
                            <a href="{{ route('carts') }}" class="w-fit flex items-center rounded-full bg-black p-3">
                                <img src="https://api.iconify.design/ion:md-basket.svg?color=%23ffffff" width="30" alt="Cart">
                                <span class="bg-white rounded-full px-2 text-black text-lg ml-3 mr-3">{{ $itemsCount }}</span>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>