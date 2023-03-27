@extends('layouts.apps')
@section('content')
    <header class="h-screen bg-main flex items-center justify-center">
        <div class="bg-white rounded-md p-6 max-w-lg w-full text-sm">
            <div class="text-center mb-2">
                <img src="https://api.iconify.design/mdi:close-octagon.svg?color=%23f83c0d" class="m-auto mb-3" width="50" alt="Checkmark icon">
                <h1 class="text-xl font-semibold mb-2">Sad to See You Go!</h1>
                <p class="mb-2">Your order has been canceled</p>
            </div>
            <a href="{{ route('home') }}" class="w-full bg-main text-white p-3 rounded-md mt-3 inline-block text-center">Go To Home Page!</a>
        </div>
    </header>
@endsection