<footer class="w-full px-4 bg-dark text-white">
    <div class="max-w-4xl m-auto py-[60px] grid grid-cols-2 gap-6 border-b border-white/10 475px:grid-cols-1">
        <div class="flex flex-col">
            <img src="{{ asset('assets/neon_tranp_white.png') }}" width="148" alt="VitalNeon icon">
            <p class="mb-3 py-3 border-b border-white/5 text-sm">Welcome to VitalNeon, your one-stop-shop for buying and creating custom neon signs. We offer a wide variety of pre-made neon signs for purchase, as well as the option to create your own personalized neon sign</p>
            <address class="flex items-center mb-3"><img class="mr-2" src="https://api.iconify.design/material-symbols:add-location-alt-rounded.svg?color=%23dbdbdb" width="25" alt="Address Icon"> L6T 2K5, Brampton, ON, Canada, Ontario</address>
            <address class="flex items-center mb-3"><img class="mr-2" src="https://api.iconify.design/mdi:gmail.svg?color=%23dbdbdb" width="25" alt="Address Icon"> contact@vitalneon.com</address>
            <ul class="flex items-center">
                <a class="mr-4" href="https://www.instagram.com/vitalneon/" rel="nofollow" target="_blank"><img src="https://api.iconify.design/skill-icons:instagram.svg?color=%23f91a1a" width="25" alt="Social Media Icon"></a>
                <a class="mr-4" href="https://www.facebook.com/profile.php?id=100089690514265/" rel="nofollow" target="_blank"><img src="https://api.iconify.design/logos:facebook.svg?color=%23f91a1a" width="25" alt="Social Media Icon"></a>
                <a class="mr-4" href="https://www.pinterest.com/mobycarts/" target="_blank" rel="nofollow"><img src="https://api.iconify.design/logos:pinterest.svg?color=%23f72696" width="25" alt="Pinterest"></a>
                <a class="mr-2" href="https://wa.me/16476165799" target="_blank" rel="nofollow"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" width="25" alt="Pinterest"></a>
            </ul>
        </div>
       <div class="text-end 475px:text-start">
        <h3 class="text-2xl pb-3 border-b border-white/5 mb-3">Navigations</h3>
        <ul class="text-gray-200 links">
            <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
            <li class="mb-2"><a href="{{ route('create-design') }}">Design Your Own</a></li>
            <li class="mb-2"><a href="{{ route('upload-design') }}">Upload Design</a></li>
            <li class="mb-2"><a href="{{ route('products') }}">Products</a></li>
            <li class="mb-2"><a href="{{ route('support') }}">Support</a></li>
            <li class="mb-2"><a href="{{ route('about') }}">About</a></li>
            <li class="mb-2"><a href="{{ route('f.a.q') }}">FAQ</a></li>
            <li class="mb-2"><a href="{{ route('sitemap') }}">Sitemap</a></li>
        </ul>
       </div>
    </div>
    <p class="py-6 text-center">
        Copyrights &copy; {{ date('Y') }} VitalNeon All Reserved
    </p>
</footer>