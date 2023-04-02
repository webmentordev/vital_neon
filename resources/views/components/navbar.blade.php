<nav class="w-full py-2 border-b border-gray-300 sticky top-0 left-0 z-50 bg-white">
    <div class="flex items-center justify-between max-w-[90%] m-auto w-full px-2">
        <a href="{{ route('home') }}" class="text-3xl font-semibold py-1"><img src="{{ asset('assets/images/v_logo.jpg') }}" width="220" alt="Vital Neon"></a>
        <ul class="flex items-center uppercase">
            <a class="mx-4" href="{{ route('create-design') }}">Design Your Own</a>
            <a class="mx-4" href="{{ route('upload-design') }}">Upload Design</a>
            <a class="mx-4" href="#">NEON Backdrop</a>
            <a class="ml-4" href="#">Support</a>
        </ul>
    </div>
</nav>