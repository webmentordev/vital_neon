<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/neon_favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    @livewire('navbar')
    <section class="h-screen bg-cover bg-center fixed w-full top-0 left-0" style="background-image: url('https://mir-s3-cdn-cf.behance.net/project_modules/1400/13465e72449867.5be82b98aea56.png')"></section>
    @livewireScripts
</body>
</html>