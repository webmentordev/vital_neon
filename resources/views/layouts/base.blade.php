<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/neon_favicon.png') }}" type="image/x-icon">
    <script src="https://unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    @livewireStyles()
</head>
<body class="antialiased">
    <x-top />
    <x-navbar />
    {{ $slot }}
    <x-footer />
    @livewireScripts()
</body>
</html>