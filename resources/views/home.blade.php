@extends('layouts.apps')
@section('content')
    <section id="max-h-[675px] overflow-hidden relative h-fit" class="w-full" aria-label="Beautiful Images">
        <a href="{{ route('products') }}"><img src="{{ asset('assets/slides/BANNER.gif') }}" class="w-full" alt="Slider 01"></a>
    </section>

    <section class="bg-light">
        <div class="max-w-6xl m-auto py-[120px] px-4">
            <div class="grid grid-cols-4 gap-6 mb-6 940px:grid-cols-3 710px:grid-cols-2 475px:grid-cols-1 m-auto">
                <div class="p-3 py-12 text-center rounded-lg bg-dark hover:bg-white group transition-all">
                    <img data-src="https://api.iconify.design/emojione:airplane.svg?color=%234bcc14" class="m-auto mb-3 lazyload" loading="lazy" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">Fast & Free Delivery</h2>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-dark hover:bg-white group transition-all">
                    <img data-src="https://api.iconify.design/fxemoji:fourleafclover.svg?color=%234bcc14" class="m-auto mb-3 lazyload" loading="lazy" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">High Efficiency</h2>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-dark hover:bg-white group transition-all">
                    <img data-src="https://api.iconify.design/noto-v1:shield.svg?color=%234bcc14" class="m-auto mb-3 lazyload" loading="lazy" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">2-Year Guarantee</h2>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-dark hover:bg-white group transition-all">
                    <img data-src="https://api.iconify.design/flat-color-icons:shipped.svg?color=%234bcc14" class="m-auto mb-3 lazyload" loading="lazy" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">Easy Installation</h2>
                </div>
            </div>
        </div>
    </section>

    <x-listing />
    
    
    <section class="w-full">
        <div class="py-[120px] relative z-10 overflow-x-hidden">
            <h4 class="text-4xl text-center uppercase font-bold text-main mb-12 choose 475px:text-2xl">Light of Neon - Power of Will</h4>
            <div class="grid grid-cols-2 1045px:grid-cols-1 1045px:max-w-xl m-auto gap-6 bg-light bg-opacity-80 backdrop-blur-lg  600px:p-3 shadow-md text-white" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover 1045px:h-[300px] overflow-hidden bg-center flex items-center justify-center lazyload" loading="lazy" style="background-image: url({{ asset('assets/background.jpg') }})"></div>
                <div class="p-6 py-12 flex flex-col 600px:p-2">
                    <h3 class="text-6xl font-semibold uppercase mb-3 leading-[80px] text-parrot rubik 600px:text-3xl">CREATE YOUR OWN <br> NEON SIGN</h3>
                    <i><p class="mb-3 leading-7">Design your unique neon sign with our online custom tool in less than 5 minutes and enjoy 20% OFF + Free Shipping worldwide! 
                        <p class="mb-3 leading-7">Our online tool simplifies the process of designing a custom neon sign and provides a visual preview so you can see how it will appear before placing an order.</p>
                        <p class="mb-3 leading-7">Whether you're looking for a text neon sign for your home, business, party, wedding, or event, our custom sign will make your special occasion stand out.<br>Now it's time to bring your ideas to life!</p></i>
                    <a href="{{ route('create-design') }}" class="py-2 px-4 rounded-lg bg-main text-black font-semibold w-fit">Create Your Design Now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-dark">
        <x-brands />
    </section>

    <script>
        var splide = new Splide('.splide', {
            type   : 'loop',
            autoplay: true,
            interval: 3000,
            pauseOnHover: true,
            arrows: false,
            pagination: false
        });
        splide.mount();
    </script>
@endsection