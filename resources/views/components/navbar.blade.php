<nav class="w-full py-2 sticky top-0 left-0 z-50 bg-dark text-white bg-opacity-80 backdrop-blur-lg">
    <div class="flex items-center justify-between max-w-[90%] m-auto w-full px-2">
        <a href="{{ route('home') }}" class="text-3xl font-semibold py-1"><img src="{{ asset('assets/neon_tranp_white.png') }}" width="150" alt="Vital Neon"></a>
        <ul class="flex items-center uppercase 920px:hidden">
            <a class="mx-4" href="{{ route('home') }}">Home</a>
            <a class="mx-4" href="{{ route('create-design') }}">Design Your Own</a>
            <a class="mx-4" href="{{ route('upload-design') }}">Upload Design</a>
            <a class="mx-4" href="{{ route('products') }}">Products</a>
            <a class="px-5 border-r border-gray-600" href="{{ route('support') }}">Support</a>
            <a href="923036405299" class="ml-5"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" width="36" alt="Whatsapp Icon"></a>
        </ul>
        <div class="hidden 920px:block" x-data="{open: false}">
            <ul x-on:click="open = true">
                <li class="bg-white my-3 h-[2px] w-[90px]"></li>
                <li class="bg-white my-3 h-[2px] w-[90px]"></li>
                <li class="bg-white my-3 h-[2px] w-[90px]"></li>
            </ul>
            <div class="fixed top-0 left-0 w-full h-full" x-show="open">
                <div class="flex justify-end">
                    <div class="max-w-[300px] w-full bg-dark bg-opacity-70 backdrop-blur-md">

                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>