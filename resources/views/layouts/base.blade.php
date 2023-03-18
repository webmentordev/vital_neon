<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>
<body class="antialiased">
    <x-top />
    <x-navbar />
    {{ $slot }}
    <x-footer />
</body>
</html>