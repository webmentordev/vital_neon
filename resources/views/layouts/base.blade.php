<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/vn_favicon.png') }}" type="image/x-icon">
    <script src="https://unpkg.com/alpinejs" defer></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @vite('resources/css/app.css')
    
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QLMRNLQCJQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-16465873503');
        gtag('config', 'G-QLMRNLQCJQ');
    </script>
    <script>
        function gtag_report_conversion(url) {
            var callback = function () {
                if (typeof(url) != 'undefined') {
                window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-16465873503/W_pKCJ-8k5YZEN-Uxas9',
                'event_callback': callback
            });
            return false;
        }
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MXZJWCNX');</script>
        <!-- End Google Tag Manager -->
    
    
    @livewireStyles()
</head>
<body class="antialiased">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MXZJWCNX"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
    <section class="py-4 px-4 text-white text-center bg-white">
        <p class="uppercase text-lg text-dark font-bold">💸 Free world wide 🌎 shipping in 5 Days 🚚</p>
    </section>
    @livewire('navbar')
    
    <a class="fixed bottom-[80px] 650px:bottom-2 right-2 z-50 opacity-50 hover:opacity-100 transition-all" href="https://wa.me/16476165799" target="_blank"><img src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" class="mr-2" width="50" alt="Social Media Icon"></a>
    
    {{ $slot }}
    <x-footer />
    @livewireScripts()
</body>
</html>