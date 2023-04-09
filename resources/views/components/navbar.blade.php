<nav class="w-full py-2 sticky top-0 left-0 z-50 bg-dark text-white bg-opacity-80 backdrop-blur-lg">
    <div class="flex items-center justify-between max-w-[90%] m-auto w-full px-2">
        <a href="{{ route('home') }}" class="text-3xl font-semibold py-1"><img src="{{ asset('assets/neon_tranp_white.png') }}" width="150" alt="Vital Neon"></a>
        <ul class="flex items-center uppercase">
            <a class="mx-4" href="{{ route('create-design') }}">Design Your Own</a>
            <a class="mx-4" href="{{ route('upload-design') }}">Upload Design</a>
            <a class="mx-4" href="{{ route('products') }}">Products</a>
            <a class="px-5 border-r border-gray-600" href="{{ route('support') }}">Support</a>
            <a href="923036405299" class="ml-5"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" width="36" alt="Whatsapp Icon"></a>
        </ul>
    </div>
</nav>