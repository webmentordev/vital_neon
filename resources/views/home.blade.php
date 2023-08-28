@extends('layouts.apps')
@section('content')
    <section id="max-h-[675px] overflow-hidden relative h-fit" class="w-full" aria-label="Beautiful Images">
        <img src="{{ asset('assets/slides/BANNER.gif') }}" class="w-full" alt="Slider 01">
    </section>


    {{-- <section id="image-carousel max-h-[675px] overflow-hidden" class="splide w-full" aria-label="Beautiful Images">
        <div class="splide__track w-full">
            <ul class="splide__list w-full">
                <li class="splide__slide w-full">
                    <a href="{{ route('create-design') }}"><img src="{{ asset('assets/slides/BANNER.gif') }}" class="w-full" alt="Slider 01"></a>
                </li>
            </ul>
        </div>
    </section> --}}

    <section class="bg-light">
        <div class="max-w-6xl m-auto py-[120px] px-4">
            <div class="text-center mb-6 border-b border-light py-3">
                <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose">WHY CHOOSE US<span class="text-7xl -translate-y-5 475px:text-2xl">❓</span></h4>
            </div>
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
        <div class="max-w-6xl m-auto py-[120px] relative z-10 overflow-x-hidden px-4">
            <h4 class="text-4xl text-center uppercase font-bold text-main mb-12 choose 475px:text-2xl">Light of Neon - Power of Will</h4>
            <div class="absolute w-full top-1/2 left-1/3 max-w-lg 1045px:left-1/4">
                <div class="absolute top-0 -left-4 w-72 h-72 bg-green-400 rounded-full mix-blend-multiply filter blur-3xl opacity-80"></div>
                <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-80"></div>
            </div>
            <div class="grid grid-cols-2 1045px:grid-cols-1 1045px:max-w-xl m-auto gap-6 bg-light bg-opacity-80 backdrop-blur-lg p-12 600px:p-3 rounded-lg shadow-md text-white" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover 1045px:h-[300px] rounded-lg overflow-hidden bg-center flex items-center justify-center lazyload" loading="lazy" style="background-image: url({{ asset('assets/images/background-card.png') }})">
                    <span class="neonText text-7xl font-semibold text-white 475px:text-4xl" x-text="text"></span>
                </div>
                <div class="p-6 flex flex-col my-6 600px:p-2">
                    <h3 class="text-7xl font-semibold uppercase mb-3 leading-[80px] text-parrot rubik 600px:text-3xl">CREATE YOUR OWN <br> NEON SIGN</h3>
                    <i><p class="mb-3 leading-7">Design your unique neon sign with our online custom tool in less than 5 minutes and enjoy 20% OFF + Free Shipping worldwide! 
                        <p class="mb-3 leading-7">Our online tool simplifies the process of designing a custom neon sign and provides a visual preview so you can see how it will appear before placing an order.</p>
                        <p class="mb-3 leading-7">Whether you're looking for a text neon sign for your home, business, party, wedding, or event, our custom sign will make your special occasion stand out.<br>Now it's time to bring your ideas to life!</p></i>
                    <input type="text" class="bg-light py-3 rounded-lg text-gray-200" x-model="text" :placeholder="placeholder">
                </div>
            </div>
        </div>
    </section>

    <script>
        var splide = new Splide('.splide', {
            type   : 'loop',
            autoplay: true,
            interval: 5000,
            pauseOnHover: true
        });
        splide.mount();
    </script>
@endsection