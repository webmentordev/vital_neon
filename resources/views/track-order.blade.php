@extends('layouts.apps')
@section('content')
    <section class="w-full px-4">
        <div class="max-w-2xl m-auto py-[80px]">
            <form action="{{ route('track.search') }}" enctype="multipart/form-data" method="POST" class="p-12 575px:p-6 rounded-lg border-gray-700 border shadow-md bg-light">
                @csrf
                <h2 class="font-semibold text-4xl text-white">Track Your Order!</h2>
                <p class="py-2 text-gray-200 mb-2 text-sm">Use <strong>Order #ID</strong> we emailed you and email address you used with your shipping address</p>
                @if (session('success'))
                    <p class="success">{{ session('success') }}</p>
                @endif
                <div class="w-full">
                    <span class="text-white">OrderID</span>
                    <x-custom-input type="text" name="order" required />
                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                </div>
                <button type="submit" class="submit-btn mb-3">Track</button>
                
                @if ($order != null)
                    <div class="relative mb-5 pt-1 w-full">
                        <div class="mb-2 flex items-center justify-between text-xs">
                            <img width="30px" src="https://api.iconify.design/eos-icons:bubble-loading.svg?color=%232bd5f7" alt="Processing">
                            <img width="30px" src="https://api.iconify.design/tabler:shield-check-filled.svg?color=%232bd5f7" alt="Processed">
                            <img width="30px" src="https://api.iconify.design/fluent-emoji:delivery-truck.svg?color=%232bd5f7" alt="Transit">
                            <img width="30px" src="https://api.iconify.design/noto:check-mark-button.svg?color=%232bd5f7" alt="Completed">
                        </div>
                        <div class="mb-4 flex h-3 overflow-hidden rounded-lg border border-white/10 text-xs">
                            @if ($order->shipping == "Processing")
                                <div style="width: 10%" class="bg-green-500 rounded-lg"></div>
                            @elseif ($order->shipping == "Processed")
                                <div style="width: 35%" class="bg-green-500 rounded-lg"></div>
                            @elseif ($order->shipping == "Transit")
                                <div style="width: 65%" class="bg-green-500 rounded-lg"></div>
                            @else
                                <div style="width: 100%" class="bg-green-500 rounded-lg"></div>
                            @endif
                        </div>
                        <div class="mb-2 flex items-center justify-between text-xs">
                            <div class="text-gray-400">Processing</div>
                            <div class="text-gray-400">Processed</div>
                            <div class="text-gray-400">Transit</div>
                            <div class="text-gray-400">Completed</div>
                        </div>
                    </div>
                @else
                    <p class="py-2 text-white text-center">No Order found!</p>
                @endif
            </form>
        </div>
    </section>
@endsection