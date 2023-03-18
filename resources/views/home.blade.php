@extends('layouts.apps')
@section('content')
    <header class="min-h-[80vh] bg-cover bg-center" style="background-image: url({{ asset('assets/images/home.jpg') }})"></header>
    <section>
        <div class="max-w-6xl m-auto py-[80px]">
            <h2 class="text-4xl text-center uppercase mb-3 text-main">Light of Neon, Power of Will</h2>
            <p class="max-w-2xl m-auto text-center">NeonWill is an LED neon sign maker that designs and manufactures awesome LED neon signs for business, weddings, parties, events, home decor and so much more.</p>
            <div class="grid grid-cols-2 gap-6 py-[50px]" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover rounded-lg overflow-hidden bg-center flex items-center justify-center" style="background-image: url({{ asset('assets/images/wall.jpg') }})">
                    <span class="neonText text-7xl font-semibold" x-text="text"></span>
                </div>
                <div class="p-6 flex flex-col my-6">
                    <i class="mb-3">Design your text</i>
                    <h3 class="text-6xl font-semibold uppercase mb-3 leading-[60px]">CREATE YOUR OWN <br> NEON SIGN</h3>
                    <p class="mb-3 leading-7">Design your unique neon sign with our online custom tool in less than 5 minutes and enjoy 20% OFF + Free Shipping worldwide! 
                    <p class="mb-3 leading-7">Our online tool simplifies the process of designing a custom neon sign and provides a visual preview so you can see how it will appear before placing an order.</p>
                    <p class="mb-3 leading-7">Whether you're looking for a text neon sign for your home, business, party, wedding, or event, our custom sign will make your special occasion stand out.<br>Now it's time to bring your ideas to life!</p>
                    <input type="text" class="bg-gray-200 border-gray-400" x-model="text" :placeholder="placeholder">
                </div>
            </div>
        </div>
    </section>
@endsection