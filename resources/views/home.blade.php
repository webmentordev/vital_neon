@extends('layouts.apps')
@section('content')
    <header class="min-h-[80vh] bg-cover bg-center" style="background-image: url({{ asset('assets/images/home.jpg') }})"></header>
    <section>
        <div class="max-w-6xl m-auto py-[80px]">
            <h2 class="text-4xl text-center uppercase mb-3 text-main font-semibold">Light of Neon, Power of Will</h2>
            <p class="max-w-2xl m-auto text-center">VitalNeon is an LED neon sign maker that designs and manufactures awesome LED neon signs for business, weddings, parties, events, home decor and so much more.</p>
            <div class="grid grid-cols-2 gap-6 py-[50px]" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover rounded-lg overflow-hidden bg-center flex items-center justify-center" style="background-image: url({{ asset('assets/images/black-wall.png') }})">
                    <span class="neonText text-7xl font-semibold text-white" x-text="text"></span>
                </div>
                <div class="p-6 flex flex-col my-6">
                    <i class="mb-3">Design your text</i>
                    <h3 class="text-6xl font-semibold uppercase mb-3 leading-[60px] inter">CREATE YOUR OWN <br> NEON SIGN</h3>
                    <p class="mb-3 leading-7">Design your unique neon sign with our online custom tool in less than 5 minutes and enjoy 20% OFF + Free Shipping worldwide! 
                    <p class="mb-3 leading-7">Our online tool simplifies the process of designing a custom neon sign and provides a visual preview so you can see how it will appear before placing an order.</p>
                    <p class="mb-3 leading-7">Whether you're looking for a text neon sign for your home, business, party, wedding, or event, our custom sign will make your special occasion stand out.<br>Now it's time to bring your ideas to life!</p>
                    <input type="text" class="bg-gray-100 border-gray-200 border rounded-lg text-gray-600" x-model="text" :placeholder="placeholder">
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="max-w-7xl m-auto py-[80px]">
            <h2 class="text-4xl text-center uppercase mb-3 text-main font-semibold">Why Choose VitalNeon</h2>
            <div class="grid grid-cols-4 gap-6">
                <div class="p-6 text-center">
                    <img src="https://api.iconify.design/emojione:airplane.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">Fast & Free Delivery</h2>
                    <p class="text-sm">We offer worldwide free shipping for all orders. Shipments are handled by DHL, FedEx or UPS.</p>
                </div>

                <div class="p-6 text-center">
                    <img src="https://api.iconify.design/fxemoji:fourleafclover.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">High Efficiency</h2>
                    <p class="text-sm">Our LED neon signs can sustain 100,000+ hours of usage while consuming 80% less power than traditional pieces.</p>
                </div>

                <div class="p-6 text-center">
                    <img src="https://api.iconify.design/noto-v1:shield.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">2-Year Guarantee</h2>
                    <p class="text-sm">Every product comes with a 2-year warranty on electrical components when used properly.</p>
                </div>

                <div class="p-6 text-center">
                    <img src="https://api.iconify.design/flat-color-icons:shipped.svg?color=%234bcc14" class="m-auto mb-3" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold">Easy Installation</h2>
                    <p class="text-sm">Every neon sign comes with screws and hanging kit for free.</p>
                </div>
            </div>
        </div>
    </section>
@endsection