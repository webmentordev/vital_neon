@extends('layouts.apps')
@section('content')
    <section id="image-carousel max-h-[675px] overflow-hidden" class="splide w-full" aria-label="Beautiful Images">
        <div class="splide__track w-full">
            <ul class="splide__list w-full">
                <li class="splide__slide w-full">
                    <img src="{{ asset('assets/slides/slider_01.png') }}" class="w-full" alt="Slider 01">
                </li>
            </ul>
        </div>
    </section>
    
    <section>
        <div class="max-w-3xl m-auto py-[80px]">
            <div class="text-center mb-6">
                <h1 class="text-[34.5px] uppercase mb-3 text-gray-600 font-semibold flex justify-center items-center m-auto"><span>WHY CHOOSE</span> <img src="{{ asset('assets/images/v_logo.jpg') }}" width="140" class="ml-2" alt=""></h1>
                <p class="leading-7 text-sm">VitalNeon is an online store that specializes in selling high-quality neon signs. Our extensive range of products includes custom text line and size options to suit your specific needs. We offer a variety of backboard styles to complement your neon sign and ensure it stands out in any space. We also provide a power adapter that ensures your neon sign runs smoothly and efficiently. With our remote and dimmer, you can adjust the brightness of your sign to create the perfect ambiance. At VitalNeon, we strive to offer the best quality neon signs that are both functional and aesthetically pleasing</p>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="p-3 py-12 text-center rounded-lg border-r border-gray-200 mb-6">
                    <img src="https://api.iconify.design/emojione:airplane.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">Fast & Free Delivery</h2>
                    <p class="text-sm leading-6">We offer worldwide free shipping for all orders. Shipments are handled by DHL, FedEx or UPS.</p>
                </div>
                <div class="p-3 py-12 text-center rounded-lg mb-6">
                    <img src="https://api.iconify.design/fxemoji:fourleafclover.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">High Efficiency</h2>
                    <p class="text-sm leading-6">Our LED neon signs can sustain 100,000+ hours of usage while consuming 80% less power than traditional pieces.</p>
                </div>
                <div class="p-3 py-12 text-center rounded-lg border-r border-gray-200 mb-6">
                    <img src="https://api.iconify.design/noto-v1:shield.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">2-Year Guarantee</h2>
                    <p class="text-sm leading-6">Every product comes with a 2-year warranty on electrical components when used properly.</p>
                </div>
                <div class="p-3 py-12 text-center rounded-lg mb-6">
                    <img src="https://api.iconify.design/flat-color-icons:shipped.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">Easy Installation</h2>
                    <p class="text-sm leading-6">Every neon sign comes with screws and hanging kit for free.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-center bg-cover relative" style="background-image: url({{ asset('assets/images/background-create.png') }})">
        <div class="absolute top-0 left-0 w-full h-full bg-opacity-60 bg-black backdrop-blur-md"></div>
        <div class="max-w-6xl m-auto py-[120px] relative z-10">
            <div class="text-white mb-[100px]">
                <h2 class="text-4xl text-center uppercase mb-3 text-main font-semibold">Light of Neon, Power of Will</h2>
                <p class="max-w-2xl m-auto text-center">VitalNeon is an LED neon sign maker that designs and manufactures awesome LED neon signs for business, weddings, parties, events, home decor and so much more.</p>
            </div>
            <div class="grid grid-cols-2 gap-6 bg-white p-12 rounded-lg" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover rounded-lg overflow-hidden bg-center flex items-center justify-center" style="background-image: url({{ asset('assets/images/background-card.png') }})">
                    <span class="neonText text-7xl font-semibold text-white" x-text="text"></span>
                </div>
                <div class="p-6 flex flex-col my-6">
                    <i class="mb-3">Design your text</i>
                    <h3 class="text-7xl font-semibold uppercase mb-3 leading-[80px]">CREATE YOUR OWN <br> NEON SIGN</h3>
                    <p class="mb-3 leading-7">Design your unique neon sign with our online custom tool in less than 5 minutes and enjoy 20% OFF + Free Shipping worldwide! 
                    <p class="mb-3 leading-7">Our online tool simplifies the process of designing a custom neon sign and provides a visual preview so you can see how it will appear before placing an order.</p>
                    <p class="mb-3 leading-7">Whether you're looking for a text neon sign for your home, business, party, wedding, or event, our custom sign will make your special occasion stand out.<br>Now it's time to bring your ideas to life!</p>
                    <input type="text" class="bg-gray-100 border-gray-200 border rounded-lg text-gray-600" x-model="text" :placeholder="placeholder">
                </div>
            </div>
        </div>
    </section>
    <script>
        var splide = new Splide('.splide', {
            autoStart: true,
            autoScroll: {
                speed: 2,
            },
        } );
        splide.mount();
    </script>
@endsection