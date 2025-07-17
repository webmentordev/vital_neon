@extends('layouts.apps')
@section('content')
    <title>Order Canceled</title>
    <header class="h-[600px] bg-dark flex items-center justify-center">
        <div class="bg-white rounded-md p-6 max-w-lg w-full text-sm">
            <div class="text-center mb-2">
                <img src="https://api.iconify.design/mdi:close-octagon.svg?color=%23f83c0d" class="m-auto mb-3" width="50"
                    alt="Checkmark icon">
                <h1 class="text-xl font-semibold mb-2">Sad to See You Go!</h1>
                <p class="mb-2">Your order has been canceled</p>
                <p>You're welcome to place the order again. If you need any help, please don't hesitate to contact us
                    via WhatsApp.</p>
                <a class="flex items-center m-auto w-fit mt-3 py-2 bg-green-600 rounded px-4"
                    href="https://wa.me/16476165799" target="_blank" rel="nofollow"><img
                        src="https://api.iconify.design/logos:whatsapp-icon.svg?color=%23ffd402" width="25"
                        alt="Whatsapp Icon"> <strong class="ml-2 text-white">+1 647-616-5799</strong> </a>
            </div>
            {{-- <a href="{{ route('home') }}"
                class="w-full bg-main text-white p-3 rounded-md mt-3 inline-block text-center">Go
                To Home Page!</a> --}}
        </div>
    </header>
@endsection