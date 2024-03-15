@extends('layouts.apps')
@section('content')
    {{-- <section id="max-h-[675px] overflow-hidden relative h-fit" class="w-full" aria-label="Beautiful Images">
        <a href="{{ route('products') }}"><img src="{{ asset('assets/slides/BANNER.gif') }}" class="w-full" alt="Slider 01"></a>
    </section> --}}

    <section class="w-full font-semibold">
        <div class="max-w-7xl m-auto py-12 px-4 grid grid-cols-3 gap-3 w-full 670px:grid-cols-1">
            <a href="{{ route('home') }}/products/search?search=art" class="relative w-full h-full col-span-2">
                <img class="h-full w-full rounded-lg border border-transparent hover:border-white" src="{{ asset('assets/banner/pop-art-artistic-neon-sign-banner.gif') }}" alt="Banner 1">
                <span class="absolute 1090px:hidden z-10 right-3 bottom-3 transition-all hover:bg-main bg-light/60 drop-shadow-lg border border-white/10 rounded-md text-white py-3 px-4">Shop Now</span>
            </a>
            <div class="grid grid-cols-1 gap-3 670px:grid-cols-2 w-full 575px:grid-cols-1">
                <a class="h-full w-full relative" href="{{ route('home') }}/products/search?search=rgb">
                    <img class="w-full rounded-lg border border-transparent hover:border-white" src="{{ asset('assets/banner/rgb-neon-sign-banner.gif') }}" alt="Banner 2">
                    <span class="absolute 1090px:hidden z-10 left-3 bottom-3 transition-all hover:bg-main bg-light/60 drop-shadow-lg border border-white/10 rounded-md text-white py-3 px-4">Shop Now</span>
                </a>
                <a class="h-full w-full relative" href="{{ route('home') }}/products/search?search=art">
                    <img class="w-full rounded-lg border border-transparent hover:border-white" src="{{ asset('assets/banner/acrylic-neon-sign-banner.gif') }}" alt="Banner 3">
                    <span class="absolute 1090px:hidden z-10 right-3 bottom-3 transition-all hover:bg-main bg-light/60 drop-shadow-lg border border-white/10 rounded-md text-white py-3 px-4">Shop Now</span>
                </a>
            </div>
        </div>
    </section>

    <x-listing />

    <x-reviews />

    <x-trust-pilot />

    <section class="bg-light">
        <div class="max-w-6xl m-auto py-12 px-4">
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
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">2-Year Warranty</h2>
                </div>
                <div class="p-3 py-12 text-center rounded-lg bg-dark hover:bg-white group transition-all">
                    <img data-src="https://api.iconify.design/flat-color-icons:shipped.svg?color=%234bcc14" class="m-auto mb-3 lazyload" loading="lazy" width="60" alt="Delivery Icon">
                    <h2 class="mb-3 font-semibold text-white group-hover:text-gray-700">Easy Installation</h2>
                </div>
            </div>
        </div>
    </section>
    
    <section class="w-full">
        <div class="py-[120px] relative z-10 overflow-x-hidden">
            <h4 class="text-4xl text-center uppercase font-bold text-main mb-12 choose 475px:text-2xl">Light of Neon - Power of Will</h4>
            <div class="grid grid-cols-2 1045px:grid-cols-1 1045px:max-w-xl m-auto gap-6 bg-light backdrop-blur-lg  600px:p-3 shadow-md text-white" x-data="{ placeholder: 'Type here...', text: 'Your Text' }">
                <div class="w-full bg-cover 1045px:h-[300px] overflow-hidden bg-center flex items-center justify-center">
                    <video src="{{ asset('videos/neon-sign-unboxing-video.MOV') }}" controls loop autoplay muted></video>
                </div>
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

    <section class="w-full">
        <div class="max-w-6xl m-auto py-6 px-4">
            <div class="flex items-center mb-12 800px:flex-col">
                <div class="w-full py-3 pr-12 800px:pr-0">
                    <h2 class="text-white font-semibold text-3xl mb-3 400px:text-2xl">Bright and Vivid Colors:</h2>
                    <p class="mb-6 text-gray-200 leading-8">Neon signs are known for their vibrant and eye-catching colors. The use of different gases, such as neon, argon, and mercury vapor, produces distinct hues. Neon emits a red-orange glow, while argon produces blues and purples. The combination of phosphor coatings on the glass tubes further enhances the color palette. This characteristic makes neon signs highly visible, especially in low-light environments, contributing to their popularity in signage and decorative displays.</p>
                </div>
                <img class="max-w-[350px] w-full rounded-md 670px:max-w-full" src="{{ asset('assets/designs/vibrant-and-bright-neon-signs.jpeg') }}" title="Buy Bright Neon Signs" alt="Buy Bright Neon Signs">
            </div>


            <div class="flex items-center mb-12 800px:flex-col">
                <img class="max-w-[350px] w-full rounded-md 800px:order-2 670px:max-w-full" src="{{ asset('assets/designs/neon-sign-glow.jpeg') }}" title="Buy Bright / Glowing Neon Signs" alt="Buy Bright / Glowing Neon Signs">
                <div class="w-full py-3 pl-12 800px:pl-0 800px:order-1">
                    <h2 class="text-white font-semibold text-3xl mb-3 400px:text-2xl">Glow and Illumination:</h2>
                    <p class="mb-6 text-gray-200 leading-8">Neon signs possess a distinctive radiant glow that sets them apart from other lighting sources. This glow is created through the ionization of gases within the sealed glass tubes when an electric current passes through them. The illumination is evenly distributed along the length of the tube, providing a consistent and attractive light output. This characteristic makes neon signs ideal for creating a warm and inviting ambiance in various settings, from storefronts and restaurants to entertainment venues.</p>
                </div>
            </div>


            <div class="flex items-center mb-12 800px:flex-col">
                <div class="w-full py-3 pr-12 800px:pr-0">
                    <h2 class="text-white font-semibold text-3xl mb-3 400px:text-2xl">Versatility in Design:</h2>
                    <p class="mb-6 text-gray-200 leading-8">Neon signs offer remarkable flexibility in design, allowing for intricate and artistic creations. Skilled artisans can shape the glass tubes into a wide range of forms, from simple letters and logos to complex and intricate designs. The malleability of the tubes enables the creation of custom shapes and symbols, making neon signs a popular choice for businesses seeking unique and personalized signage. This characteristic has contributed to the enduring appeal of neon signs as iconic elements in urban landscapes.</p>
                </div>
                <img class="max-w-[350px] w-full rounded-md 670px:max-w-full" src="{{ asset('assets/designs/different-versat-design-neon-signs.jpeg') }}" title="Buy Versatility In Design Neon Signs" alt="Buy Versatility In Design Neon Signs">
            </div>

            <div class="flex items-center 800px:flex-col">
                <img class="max-w-[350px] w-full rounded-md 800px:order-2 670px:max-w-full" src="{{ asset('assets/designs/neon-sign-durability.jpeg') }}" title="Buy Durability Neon Signs" alt="Buy Durability Neon Signs">
                <div class="w-full py-3 pl-12 800px:pl-0 800px:order-1">
                    <h2 class="text-white font-semibold text-3xl mb-3 400px:text-2xl">Longevity and Durability:</h2>
                    <p class="mb-6 text-gray-200 leading-8">Neon signs are known for their durability and long lifespan. The sealed glass tubes protect the gases from external elements, preventing oxidation and ensuring a consistent performance over time. When properly maintained, neon signs can last for many years, providing a cost-effective and reliable lighting solution. This longevity, coupled with their ability to withstand various weather conditions, makes neon signs a durable choice for both indoor and outdoor applications. Additionally, the lack of filaments or delicate components reduces the risk of damage due to vibrations or impacts, further enhancing their robustness.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full">
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