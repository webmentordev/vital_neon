<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/vn_favicon.png') }}" type="image/x-icon">
    <script src="https://unpkg.com/alpinejs" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
        integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @vite('resources/css/app.css')
        <meta name="google-site-verification" content="mZR7DrE9-dHwFk32nblpkGqD7wahIf1U4snevVBEFv4" />

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <meta name="p:domain_verify" content="c5203d5e2610ed6ebeddb5745ed3737f"/>
    
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QLMRNLQCJQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'AW-16465873503');
        gtag('config', 'G-QLMRNLQCJQ');
    </script>


    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MXZJWCNX');</script>
    <!-- End Google Tag Manager -->
    @livewireStyles()
</head>

<body class="antialiased">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MXZJWCNX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <section class="py-3 px-4 text-white text-center bg-gray-100">
        <p class="uppercase text-dark font-bold text-sm">💸 Free world wide 🌎 shipping in 5 Days 🚚</p>
    </section>
    @livewire('navbar')
    {{ $slot }}
    <x-footer />
    @guest
        <script>
            document.addEventListener('keydown', function (e) {
                // Check if F12 key is pressed
                if (e.keyCode == 123) {
                    e.preventDefault();
                    return false;
                }
            });
            document.addEventListener('contextmenu', function (e) {
                e.preventDefault();
            });
        </script>
    @endguest
    @livewireScripts()
</body>

</html>