@extends('layouts.apps')
@section('content')
    <header class="h-screen bg-main flex items-center justify-center">
        <div class="bg-white rounded-md p-6 max-w-lg w-full text-sm">
            <div class="text-center mb-2">
                <img src="https://api.iconify.design/material-symbols:check-circle.svg?color=%2320975a" class="m-auto mb-3" width="50" alt="Checkmark icon">
                <h1 class="text-xl font-semibold mb-2">Congratulations!</h1>
                <p class="mb-2">Your order has been successfully placed</p>
                <p>OrderID# <strong>{{ $order_id }}</strong></p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg border border-gray-200">
                <h2 class="font-semibold mb-2 text-lg">What's NEXT?</h2>
                <p>Kindly proceed to the tracking section to check the status of your order.</p>
                <p>In addition, we have sent you an email containing your Order ID, so you can easily retrieve it in case of loss.</p>
            </div>
            <a href="{{ route('home') }}" class="w-full bg-main text-white p-3 rounded-md mt-3 inline-block text-center">Go To Home Page!</a>
        </div>
    </header>
@endsection