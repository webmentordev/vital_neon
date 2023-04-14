@extends('layouts.apps')
@section('content')
    <section id="image-carousel max-h-[675px] overflow-hidden" class="splide w-full" aria-label="Beautiful Images">
        <div class="splide__track w-full">
            <ul class="splide__list w-full">
                <li class="splide__slide w-full">
                    <img src="{{ asset('assets/slides/slider_03.png') }}" class="w-full" alt="Slider 03">
                </li>
                <li class="splide__slide w-full">
                    <img src="{{ asset('assets/slides/slider_01.png') }}" class="w-full" alt="Slider 01">
                </li>
                <li class="splide__slide w-full">
                    <img src="{{ asset('assets/slides/slider_02.png') }}" class="w-full" alt="Slider 02">
                </li>
            </ul>
        </div>
    </section>
    
    <section class="w-full px-4">
        <div class="max-w-4xl m-auto pt-[100px] grid grid-cols-3 gap-6">
            <div class="flex justify-center items-center bg-light border border-white/10 rounded-lg p-6">
                <div class="flex items-center">
                    <img src="https://api.iconify.design/bi:chat-right-heart-fill.svg?color=%2300FFFF" width="40" alt="Package Icon">
                    <span class="text-gray-300 font-semibold ml-3">PREMIUM QUALITY</span>
                </div>
            </div>
            <div class="flex justify-center items-center bg-light border border-white/10 rounded-lg p-6">
                <div class="flex items-center">
                    <img src="https://api.iconify.design/majesticons:globe-earth.svg?color=%2300FFFF" width="40" alt="Package Icon">
                    <span class="text-gray-300 font-semibold ml-3">GLOBAL SHIPPING</span>
                </div>
            </div>

            <div class="flex justify-center items-center bg-light border border-white/10 rounded-lg p-6">
                <div class="flex items-center">
                    <img src="https://api.iconify.design/ic:round-contact-phone.svg?color=%2300FFFF" width="40" alt="Package Icon">
                    <span class="text-gray-300 font-semibold ml-3">24/7 SUPPORT</span>
                </div>
            </div>
        </div>
    </section>

    <x-listing />
    
    <section class="bg-dark">
        <div class="max-w-3xl m-auto py-[120px] px-4">
            <div class="text-center mb-6 border-b border-light py-3">
                <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold flex text-5xl justify-center items-center m-auto choose">WHY CHOOSE US<span class="text-7xl -translate-y-5">❓</span></h4>
            </div>
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div class="p-3 py-12 text-center rounded-lg bg-light hover:bg-white group transition-all">
                    <img src="https://api.iconify.design/emojione:airplane.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">Fast & Free Delivery</h2>
                    <p class="text-sm leading-6 text-gray-200 group-hover:text-gray-500">We offer worldwide free shipping for all orders. Shipments are handled by DHL, FedEx or UPS.</p>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-light hover:bg-white group transition-all">
                    <img src="https://api.iconify.design/fxemoji:fourleafclover.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">High Efficiency</h2>
                    <p class="text-sm leading-6 text-gray-200 group-hover:text-gray-500">Our LED neon signs can sustain 100,000+ hours of usage while consuming 80% less power than traditional pieces.</p>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-light hover:bg-white group transition-all">
                    <img src="https://api.iconify.design/noto-v1:shield.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">2-Year Guarantee</h2>
                    <p class="text-sm leading-6 text-gray-200 group-hover:text-gray-500">Every product comes with a 2-year warranty on electrical components when used properly.</p>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-light hover:bg-white group transition-all">
                    <img src="https://api.iconify.design/flat-color-icons:shipped.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">Easy Installation</h2>
                    <p class="text-sm leading-6 text-gray-200 group-hover:text-gray-500">Every neon sign comes with screws and hanging kit for free.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="max-w-6xl m-auto py-[120px] relative z-10">
            <h4 class="text-4xl text-center uppercase font-bold text-main mb-12 choose">Light of Neon - Power of Will</h4>
            <div class="absolute w-full top-1/2 left-1/3 max-w-lg">
                <div class="absolute top-0 -left-4 w-72 h-72 bg-green-400 rounded-full mix-blend-multiply filter blur-3xl opacity-80"></div>
                <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-80"></div>
            </div>
            <div class="grid grid-cols-2 gap-6 bg-dark bg-opacity-80 backdrop-blur-lg p-12 rounded-lg shadow-md text-white" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover rounded-lg overflow-hidden bg-center flex items-center justify-center" style="background-image: url({{ asset('assets/images/background-card.png') }})">
                    <span class="neonText text-7xl font-semibold text-white" x-text="text"></span>
                </div>
                <div class="p-6 flex flex-col my-6">
                    <h3 class="text-7xl font-semibold uppercase mb-3 leading-[80px] text-parrot rubik">CREATE YOUR OWN <br> NEON SIGN</h3>
                    <i><p class="mb-3 leading-7">Design your unique neon sign with our online custom tool in less than 5 minutes and enjoy 20% OFF + Free Shipping worldwide! 
                        <p class="mb-3 leading-7">Our online tool simplifies the process of designing a custom neon sign and provides a visual preview so you can see how it will appear before placing an order.</p>
                        <p class="mb-3 leading-7">Whether you're looking for a text neon sign for your home, business, party, wedding, or event, our custom sign will make your special occasion stand out.<br>Now it's time to bring your ideas to life!</p></i>
                    <input type="text" class="bg-light py-3 rounded-lg text-gray-200" x-model="text" :placeholder="placeholder">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="max-w-3xl m-auto py-[120px]">
            <div class="text-center mb-6 border-b border-light py-3">
                <h4 class="text-[34.5px] uppercase mb-3 text-white font-bold text-5xl m-auto">About Us<span class="text-5xl ml-2">❗</span></h4>
            </div>
            <p class="leading-9 text-white text-center p1"><i><span class="text-3xl">"</span>VitalNeon is an online store that specializes in selling high-quality neon signs. Our extensive range of products includes custom text line and size options to suit your specific needs. We offer a variety of backboard styles to complement your neon sign and ensure it stands out in any space. We also provide a power adapter that ensures your neon sign runs smoothly and efficiently. With our remote and dimmer, you can adjust the brightness of your sign to create the perfect ambiance. At VitalNeon, we strive to offer the best quality neon signs that are both functional and aesthetically pleasing<span class="text-3xl inline-block">"</span></i></p>
        </div>
    </section>

    <x-f-a-q />
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